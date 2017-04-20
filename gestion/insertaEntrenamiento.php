<?php

	//Respuesta a llamada ajax para insertar un nuevo usuario.
	//Añade el usuario si no existe uno con el mismo nombre en la base de datos y devuelve si se ha realizado con exito


    require_once('Bd.php');


    session_start();


	$nombre = $_REQUEST['nombre'];
	$funcion = $_REQUEST['funcion'];
	$descripcion = $_REQUEST['descripcion'];
	$tabla = $_REQUEST['tabla'];



	if(Bd::comprobarEntrenamientoExistente($nombre)){

		echo("0");//Si la dieta ya existe en la bbdd

	}else{

		Bd::annadeEntrenamiento($nombre,$funcion,$descripcion,$tabla);
		
		echo("1");//Si el usuario se ha añadido correctamente

	}






?>