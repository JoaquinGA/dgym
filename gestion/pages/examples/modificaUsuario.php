<?php

	//Respuesta a llamada ajax para modificar un usuario.
	//Modifica el usuario con el id pasado como parametro

    require_once('Bd.php');

	$id = $_REQUEST['id'];
	$nombre = $_REQUEST['nombre'];
	$contrasenna = $_REQUEST['contrasenna'];
	$permiso = $_REQUEST['permiso'];


	echo($id);

	if(Bd::comprobarNombreExistente($nombre)){

		echo("0");//Si el usuario ya existe en la bbdd

	}else{

	Bd::modificaUsuario($id,$nombre,$contrasenna,$permiso);

	echo("1");//Si se ha modificado correctamente

	}




?>