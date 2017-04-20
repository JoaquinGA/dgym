<?php

	//Respuesta a llamada ajax que devuelve array de javascript con todos los registros de usuario

    require_once('Bd.php');

	header('Content-Type: application/json');


	$nombre = $_REQUEST['nombre'];


	$cadena = "";

	$resultado = Bd::buscaUsuariosPagos($nombre);


	$linea = $resultado->fetch();


	while($linea != null){

		$cadena .= "{\"id_usuario\":\"" .$linea['id_usuario']. "\",\"nombre\":\"" .$linea['nombre']. "\",\"dni\":\"" .$linea['dni']. "\",\"activo\":\"" .$linea['activo']. "\",\"fecha_pago\":\"" .$linea['fecha_pago']. "\",\"fecha_vencimiento\":\"" .$linea['fecha_vencimiento']. "\"},";

		$linea = $resultado->fetch(PDO::FETCH_BOTH);
	}

	print("[". substr($cadena, 0, strlen($cadena) - 1) ."]");


?>
