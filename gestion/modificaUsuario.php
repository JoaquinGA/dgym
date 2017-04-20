<?php

	//Respuesta a llamada ajax para modificar un usuario.
	//Modifica el usuario con el id pasado como parametro

    require_once('Bd.php');

	$id = $_REQUEST['id'];
	$nombre = $_REQUEST['nombre'];
	$contrasenna = $_REQUEST['contrasenna'];
	$permiso = $_REQUEST['permiso'];

	$dni = $_REQUEST['dni'];
	$email = $_REQUEST['email'];
	$nacimiento = $_REQUEST['nacimiento'];
	$telefono = $_REQUEST['telefono'];
	$peso = $_REQUEST['peso'];
	$altura = $_REQUEST['altura'];	

	if(Bd::comprobarNombreExistente($nombre) && $nombre != Bd::obtenerNombre($id)){

		echo("0");//Si el usuario ya existe en la bbdd

	}else{


	Bd::modificaUsuario($id,$nombre,$contrasenna,intval($permiso),$dni,$email,$nacimiento,$telefono,$peso,$altura);

	echo("1");//Si se ha modificado correctamente

	}




?>