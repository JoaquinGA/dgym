<?php

	//Respuesta a llamada ajax para eliminar un usuario.
	//Elimina el usuario con el id pasado como parametro

    require_once('Bd.php');

    session_start(); 

	$id = $_REQUEST['id'];


	$usuarioEliminado = Bd::obtenerNombreUsuario($id);

	Bd::eliminaUsuario($id);
	Bd::annadir_historial_usuarios("2",$_SESSION['usuario'],$_SESSION['id_usuario'],$usuarioEliminado);	

	echo("Usuario ".$id." eliminado correctamente.");

?>