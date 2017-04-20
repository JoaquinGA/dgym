<?php

	//Respuesta a llamada ajax que devuelve array de javascript con todos los registros de usuario

    require_once('Bd.php');

	header('Content-Type: application/json');


	$nombre = $_REQUEST['nombre'];


	$cadena = "";

	$resultado = Bd::buscaUsuarios($nombre);


	$linea = $resultado->fetch();


	while($linea != null){

		$cadena .= "{\"id_usuario\":\"" .$linea['id_usuario']. "\",\"nombre\":\"" .$linea['nombre']. "\",\"contrasenna\":\"" .$linea['contrasenna']. "\",\"permiso\":\"" .$linea['permiso']. "\",\"dni\":\"" .$linea['dni']. "\",\"nacimiento\":\"" .$linea['nacimiento']. "\",\"telefono\":\"" .$linea['telefono']. "\",\"email\":\"" .$linea['email']. "\",\"altura\":\"" .$linea['altura']. "\",\"peso\":\"" .$linea['peso']. "\",\"nombre_entrenamiento\":\"" .(Bd::obtenerNombreEntrenamiento($linea['entrenamiento'])). "\",\"nombre_dieta\":\"" .(Bd::obtenerNombreDieta($linea['dieta'])). "\",\"activo\":\"" .$linea['activo']. "\"},";

		$linea = $resultado->fetch(PDO::FETCH_BOTH);
	}

	print("[". substr($cadena, 0, strlen($cadena) - 1) ."]");


?>
