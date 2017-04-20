<?php

    require_once('Bd.php');


    session_start();


	$id = $_REQUEST['id'];

	Bd::annadePago($id);
	Bd::activarUsuario($id);




?>