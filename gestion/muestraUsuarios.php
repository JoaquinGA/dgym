<?php

	//Respuesta a llamada ajax que devuelve array de javascript con todos los registros de usuario

    require_once('Bd.php');

	header('Content-Type: application/json');


	$cadena = "";

	$resultado = Bd::obtenerUsuarios();


	$linea = $resultado->fetch();


	while($linea != null){

		$cadena .= "{\"id_usuario\":\"" .$linea['id_usuario']. "\",\"nombre\":\"" .$linea['nombre']. "\",\"contrasenna\":\"" .$linea['contrasenna']. "\",\"permiso\":\"" .$linea['permiso']. "\",\"dni\":\"" .$linea['dni']. "\",\"telefono\":\"" .$linea['telefono']. "\",\"email\":\"" .$linea['email']. "\",\"peso\":\"" .$linea['peso']. "\",\"altura\":\"" .$linea['altura']. "\",\"nacimiento\":\"" .$linea['nacimiento']. "\"},";

		$linea = $resultado->fetch(PDO::FETCH_BOTH);
	}

	print("[". substr($cadena, 0, strlen($cadena) - 1) ."]");


?>
