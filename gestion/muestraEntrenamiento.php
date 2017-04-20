<?php

	//Respuesta a llamada ajax que devuelve un objeto con los datos de un usuario

    require_once('Bd.php');

	header('Content-Type: application/json');

	$id = $_REQUEST['id'];

	$cadena = "";

	$resultado = Bd::obtenerEntrenamiento($id);


	$linea = $resultado->fetch();

	

	print(json_encode($linea));


?>
