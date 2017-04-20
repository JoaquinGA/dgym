<?php

	//Respuesta a llamada ajax para enviar una sugerencia.
	


    require_once('Bd.php');


    session_start();


	$id = $_REQUEST['id'];
	$asunto = $_REQUEST['asunto'];
	$mensaje = $_REQUEST['mensaje'];


	Bd::insertaSugerencia($id,$asunto,$mensaje);








?>