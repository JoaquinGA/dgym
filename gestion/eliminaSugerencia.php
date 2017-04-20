<?php

	//Respuesta a llamada ajax para eliminar una sugerencia.
	//Elimina la sugerencia con el id pasado como parametro

    require_once('Bd.php');

    session_start(); 

	$id = $_REQUEST['id_sugerencia'];



	Bd::eliminaSugerencia($id);
	


?>