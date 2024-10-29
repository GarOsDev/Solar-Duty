<?php

session_start();

require_once("../db.php");
$db = new HeliosDB();
$res = "";


if(isset($_POST['email1']) && isset($_POST['email2'])){

    $res = $db->actualizarEmail($_POST['email1'], $_SESSION['usuario']);
    echo $res;
}

if(isset($_POST['pass1']) && isset($_POST['pass2'])){

    $res = $db->actualizarContrasena($_POST['pass1'], $_SESSION['usuario']);
    echo $res;
}

if(isset($_GET['del'])){

    $res = $db->eliminarInstalacion($_SESSION['idInstalacion']);
    echo $res;
}

if(isset($_GET['account'])){

    $res = $db->eliminarCuentaHELIOS($_SESSION['usuario']);
    session_destroy();
    echo $res;
}

