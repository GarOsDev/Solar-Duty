<?php
session_start();

require_once("../db.php");
$db = new HeliosDB();
$res = "";

if (!isset($_SESSION['usuario'])) {
	$_SESSION['usuario'] = "";
	$_SESSION['idInstalacion'] = "";
}


if (isset($_POST['user']) && isset($_POST['contra'])) {


	$resUsu = $db->comprobarUsuario($_POST['user']);
	$res = $db->loginUsuario($_POST['user'], $_POST['contra']);
	$id_instalacion = $db->idInstalacion($_POST['user']);


	if (!empty($resUsu)) {
		if (!empty($res)) {
			$mensajes = [
				"mensaje2" => "Logueado exitosamente"
			];
			echo json_encode($mensajes);

			$_SESSION['usuario'] = $_POST['user'];
			$_SESSION['idInstalacion'] = $id_instalacion[0]['id_instalacion'];
		} else {
			$mensajes = [
				"mensaje" => "Contraseña incorrecta"
			];

			echo json_encode($mensajes);
		}
	} else {
		$mensajes = [
			"mensaje" => "Usuario no encontrado"
		];
		echo json_encode($mensajes);
	}
}

if (isset($_POST['usuario']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {


	$resUsu = $db->comprobarUsuario($_POST['usuario']);


	if (!empty($resUsu)) {

		if ($db->actualizarContrasena($_POST['pass1'], $_POST['usuario'])) {
			$mensajes = [
				"mensaje2" => "Contraseña cambiada"
			];
			echo json_encode($mensajes);
		}
	} else {
		$mensajes = [
			"mensaje" => "Usuario no encontrado"
		];
		echo json_encode($mensajes);
	}
}
