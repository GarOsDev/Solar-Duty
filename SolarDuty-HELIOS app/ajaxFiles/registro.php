<?php
session_start();

require_once("../db.php");
$db = new HeliosDB();
$res = "";

if (!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = "";
    $_SESSION['idInstalacion'] = "";
}

if(isset($_GET['prov'])){

    $res = $db->municipiosEspana($_GET['prov']);

    foreach($res as $r){
        echo "<option value='$r[Municipio]'>$r[Municipio]</option>";
    }
}


if (isset($_POST['nom']) && isset($_POST['ape']) && isset($_POST['nomUsu']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['prov']) && isset($_POST['munic'])) {

    $fecha_registro = date("Y-m-d");
    $res = $db->signInUsuario($_POST['nomUsu'], $_POST['pass'], $_POST['email'], $_POST['nom'], $_POST['ape'], $_POST['prov'], $_POST['munic'], $fecha_registro);
    
    if ($res) {
        $_SESSION['usuario'] = $_POST['nomUsu'];
        
        echo $res;
    }else{
        echo false;
    }
}

if (isset($_GET['usu'])) {

    $resUsu = $db->comprobarUsuario($_GET['usu']);

    if ($resUsu) {
        $mensajeUsu = [
            "mensaje1" => "Nombre de usuario existente"
        ];

        echo json_encode($mensajeUsu);
    }else{
        $mensajeUsu = [
            "mensaje2" => "Usuario disponible"
        ];

        echo json_encode($mensajeUsu);
    }
}
