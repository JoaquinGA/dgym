<?php
    require_once('/Bd.php');
    echo(Bd::obtenerFotoUsuario($_REQUEST['id']));
?>