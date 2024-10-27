<?php

session_start();

require_once("../db.php");
$db = new HeliosDB();
$res = "";



if (isset($_GET['getTime'])) {

$idInstalacion = $_SESSION['idInstalacion'];
$ultimoRegistro = $db->ultimoParametroProduccion($idInstalacion);

$valor = $ultimoRegistro[0]['fecha_registro'];
echo (strtotime($valor));

}

if(isset($_POST['produccionesSolares'])){

    $res = $db->registrarProduccioneSolares($_SESSION['idInstalacion'],$_POST['produccionesSolares']);
    echo $res;
}

if(isset($_GET['producciones'])){

    $idInstalacion = $_SESSION['idInstalacion'];
    $ultimaProduccion= $db->ultimaProduccionSolar($idInstalacion);

    echo (json_decode($ultimaProduccion,true));

}