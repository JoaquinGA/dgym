<?php

	//Respuesta a llamada ajax para eliminar una dieta.
	//Elimina la dieta con el id pasado como parametro

    require_once('Bd.php');

    session_start(); 

	$id = $_REQUEST['id'];




	Bd::eliminaDieta($id);


	echo("Dieta ".$id." eliminada correctamente.");

?>