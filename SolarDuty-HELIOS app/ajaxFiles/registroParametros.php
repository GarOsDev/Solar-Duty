<?php

session_start();

require_once("../db.php");
$db = new HeliosDB();
$res = "";

if (isset($_POST['parametroSolares'])) {

    $usuario = $_SESSION['usuario'];
    $parametros = $_POST['parametroSolares'];

    $res = $db->registroParametroSolares($usuario, $parametros);

    if ($res) {
        echo "registro exitoso";
    } else {
        echo "no pudieron registrarse los datos";
    }
}

if (isset($_GET['getTime'])) {

    $usuario = $_SESSION['usuario'];
    $tiempoRegistro = $db->ultimoParametroRegistrado($usuario);

    $valor = $tiempoRegistro[0]['fechaRegistro'];
    echo (strtotime($valor));
    
}

if (isset($_GET['params'])) {

    $usuario = $_SESSION['usuario'];
    $datosSolares = $db->ultimoRegistroSolar($usuario);

    
    echo (json_decode($datosSolares,true));
    
}
