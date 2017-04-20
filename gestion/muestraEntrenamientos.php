<?php

	//Respuesta a llamada ajax que devuelve array de javascript con todos los registros de usuario

    require_once('Bd.php');

	header('Content-Type: application/json');


	$cadena = "";

	$resultado = Bd::obtenerEntrenamientos();


	$linea = $resultado->fetch();


	while($linea != null){

		$cadena .= "{\"id_entrenamiento\":\"" .$linea['id_entrenamiento']. "\",\"nombre\":\"" .$linea['nombre']. "\",\"funcion\":\"" .$linea['funcion']. "\",\"descripcion\":\"" .$linea['descripcion']. "\"},";

		$linea = $resultado->fetch(PDO::FETCH_BOTH);
	}

	print("[". substr($cadena, 0, strlen($cadena) - 1) ."]");


?>
