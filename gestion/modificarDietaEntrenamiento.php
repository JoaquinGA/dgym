<?php

	//Respuesta a llamada ajax para modificarla dieta y el entrenamiento de un usuario.


    require_once('Bd.php');

	$id = $_REQUEST['id'];
	$dieta = $_REQUEST['dieta'];
	$entrenamiento = $_REQUEST['entrenamiento'];		
	




	Bd::modificaDietaEntrenamiento($id,$dieta,$entrenamiento);

	echo("Dieta y entrenamiento modificados correctamente");//Si se ha modificado correctamente





?>