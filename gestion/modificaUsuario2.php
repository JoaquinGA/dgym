<?php

	//Respuesta a llamada ajax para modificar un usuario.
	//Modifica el usuario con el id pasado como parametro

    require_once('Bd.php');


	$id = $_REQUEST['id'];

	$contrasenna = $_REQUEST['contrasenna'];
	
	$email = $_REQUEST['email'];
	$telefono = $_REQUEST['telefono'];
	$peso = $_REQUEST['peso'];
	$altura = $_REQUEST['altura'];	




	Bd::modificaUsuario2($id,$contrasenna,$email,$telefono,$peso,$altura);


	




?>