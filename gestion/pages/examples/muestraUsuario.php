<?php

	//Respuesta a llamada ajax que devuelve un objeto con los datos de un usuario

    require_once('Bd.php');

	header('Content-Type: application/json');

	$id = $_REQUEST['id'];

	$cadena = "";

	$resultado = Bd::obtenerUsuario($id);


	$linea = $resultado->fetch();


		$cadena = "{\"id_usuario\":\"" .$linea['id_usuario']. "\",\"nombre\":\"" .$linea['nombre']. "\",\"contrasenna\":\"" .$linea['contrasenna']. "\",\"permiso\":\"" .$linea['permiso']. "\"}";


	print($cadena);


?>
