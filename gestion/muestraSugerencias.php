<?php

	//Respuesta a llamada ajax que devuelve array de javascript con todos los registros de usuario

    require_once('Bd.php');

	header('Content-Type: application/json');


	$cadena = "";

	$resultado = Bd::obtenerSugerencias();


	$linea = $resultado->fetch();


	while($linea != null){

		$cadena .= "{\"nombre_usuario\":\"" .Bd::obtenerNombreUsuario($linea['id_usuario']). "\",\"id_sugerencia\":\"" .$linea['id_sugerencia']. "\",\"asunto\":\"" .$linea['asunto']. "\",\"mensaje\":\"" .$linea['mensaje']. "\"},";

		$linea = $resultado->fetch(PDO::FETCH_BOTH);
	}

	print("[". substr($cadena, 0, strlen($cadena) - 1) ."]");


?>
