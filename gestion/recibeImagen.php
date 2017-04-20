<?php


require_once('/Bd.php');

$id_usuario = $_POST['id_usuario_oculto'];







						if(is_uploaded_file($_FILES['archivo1']['tmp_name'])){
							$nombreDirectorio = "fotos_perfil/";
							$nombreFichero = $_FILES['archivo1']['name'];

							$nombreCompleto = $nombreDirectorio.$nombreFichero;

							if(is_file($nombreCompleto)){
								$idUnico = time();
								$nombreFichero = $idUnico . "-" . $nombreFichero;
							}

							move_uploaded_file($_FILES['archivo1']['tmp_name'], $nombreDirectorio . $nombreFichero);
						

							Bd::annadeFoto($id_usuario,$nombreFichero);


							echo("1");




						}else{
							print("0");
						}












?>