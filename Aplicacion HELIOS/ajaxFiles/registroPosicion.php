
<?php

session_start();

require_once("../db.php");
$db = new HeliosDB();
$res = "";

if (isset($_POST['lat']) && isset($_POST['lon'])) {

    $usuario = $_SESSION['usuario'];
    $latitud = $_POST['lat'];
    $longitud = $_POST['lon'];

    $datosUsu = $db->datosUsuarioPosicion($usuario);
    $estadoReg = $db->siExiste($usuario);


    if ($datosUsu) {
        if (!$estadoReg) {
            $idUsu = $datosUsu[0]['idUsu'];
            $usr = $datosUsu[0]['nombreUsuario'];
            $prov = $datosUsu[0]['provincia'];
            $municipio = $datosUsu[0]['municipio'];
            $reg = 1;

            $res = $db->registrarPosicionUsu($idUsu, $usr, $prov, $municipio, $latitud, $longitud, $reg);
            $IdInstalacion = $db->idInstalacion($usuario);
            $_SESSION['idInstalacion'] = $IdInstalacion[0]['id_instalacion'];;
        }
    }
} else {
    echo ("sin datos");
}
