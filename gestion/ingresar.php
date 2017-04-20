<?php

	require_once('Bd.php');

	$nombre = $_REQUEST['nombre'];
	$contrasenna = $_REQUEST['contrasenna'];




	if(Bd::verificaUsuario($nombre,$contrasenna)){

		session_start();
		$_SESSION['usuario'] = $nombre;
		$_SESSION['bloqueado'] = false;

		echo("true");
		
	}else{

		echo("false");

	}	

?>