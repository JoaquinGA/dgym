<?php

	//Respuesta a llamada ajax para insertar un nuevo usuario.
	//Añade el usuario si no existe uno con el mismo nombre en la base de datos y devuelve si se ha realizado con exito


    require_once('Bd.php');


    session_start();


	$nombre = $_REQUEST['nombre'];
	$contrasenna = $_REQUEST['contrasenna'];
	$permiso = $_REQUEST['permiso'];



	

	if(Bd::comprobarNombreExistente($nombre)){

		echo("0");//Si el usuario ya existe en la bbdd

	}else{

		Bd::annadeUsuario($nombre,$contrasenna,$permiso);
		Bd::annadir_historial_usuarios("1",$_SESSION['usuario'],$_SESSION['id_usuario'],$nombre);

		echo("1");//Si el usuario se ha añadido correctamente

	}






?>