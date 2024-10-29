
<?php
session_start();

require_once("../db.php");
require_once("../PHPMailer/helios_phpMailer.php");
$db = new HeliosDB();
$res = "";

if (isset($_GET['installation'])) {

    $existe = $db->existeInstalacion($_SESSION['idInstalacion']);
    
    echo json_encode($existe);
}

if (isset($_GET['placas'])) {

    $archivos = glob('../imagenes/placas_solares/*.svg'); // Obtener solo archivos con extensión .svg

    echo json_encode($archivos);
}

if (isset($_GET['baterias'])) {

    $archivos = glob('../imagenes/baterias/*.svg'); // Obtener solo archivos con extensión .svg

    echo json_encode($archivos);
}

if (isset($_GET['inversores'])) {

    $archivos = glob('../imagenes/inversores/*.svg'); // Obtener solo archivos con extensión .svg

    echo json_encode($archivos);
}

if (isset($_GET['reguladores'])) {

    $archivos = glob('../imagenes/reguladores/*.svg'); // Obtener solo archivos con extensión .svg

    echo json_encode($archivos);
}

if(isset($_POST['datosReg'])){

    $datos_post = json_decode($_POST['datosReg'], true);
    $resRegistro = $db->registrarValoresInstalacion($datos_post['idInst'],$datos_post['75'],$datos_post['160'],$datos_post['200'],$datos_post['300'],$datos_post['450'],$datos_post['600'],$datos_post['cantidadPlacas'],$datos_post['potenciaTotal'],$datos_post['cantidadBaterias'],$datos_post['capacidadBaterias'],$datos_post['regulador'],$datos_post['inversor']);
    echo $resRegistro;
}

if (isset($_GET['datosInstalacion'])) {

    $idInstalacion = $_SESSION['idInstalacion'];
    $datosInstalacion = $db->datosInstalacion($idInstalacion); 

    echo json_encode($datosInstalacion);
}

if (isset($_GET['alert'])) {

    $idInstalacion = $_SESSION['idInstalacion'];
    $valorAlerta = $_GET['alert'];
    $datosInstalacion = $db->registrarValorAlerta($valorAlerta, $idInstalacion); 

    echo json_encode($datosInstalacion);
}

if (isset($_GET['compare'])) {

    $idInstalacion = $_SESSION['idInstalacion'];
    $valorproduccion = $_GET['compare'];

    $valorArray = $db->obtenerValorAlerta($idInstalacion);
    $valorAlerta = $valorArray[0]['valoralerta'];

    $correoUsuario = $db->datosUsuario($_SESSION['usuario']);
    $correoValor = $correoUsuario[0]['email'];
    $nombre = $correoUsuario[0]['nombre'];
    $apellidos = $correoUsuario[0]['apellidos'];
    $nombreCompleto = $nombre." ".$apellidos;

    if($valorArray){
        if($valorproduccion < $valorAlerta){
          
            phpmailer("Alerta nivel bajo de produccion", "Este es un mensaje automatico para alertarte que la produccion solar de tu instalación esta por debajo del limite $valorAlerta Watts establecido. Porfavor revise su instalacion",$correoValor, $nombreCompleto);
            echo "Se ha enviado correo de alerta: Valores registrados: ".$valorproduccion."---".$valorAlerta."------".$correoValor;
        }
    }else{
        echo "No existe alerta de produccion configurada";
    }
    
}

if(isset($_GET['exists'])){

    $valorArray = $db->obtenerValorAlerta($_SESSION['idInstalacion']);
    $valorAlerta = $valorArray[0]['valoralerta'];

    echo json_encode($valorAlerta);
}
