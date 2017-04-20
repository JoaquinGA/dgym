<?php

    require_once('Bd.php');
    session_start();



	if(isset($_REQUEST['id'])){
		echo(Bd::funcionEntrar($_REQUEST['id']));
	}else{
		echo("No se recibio ningun identificador.");
	}






?>