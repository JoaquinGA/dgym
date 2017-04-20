<?php

    require_once('Bd.php');

    session_start(); 

	$precio = $_REQUEST['precio'];

	Bd::actualizaPrecio($precio);


?>