<?php

    require_once('Bd.php');



    $linea = Bd::obtenerInfoFactura($_REQUEST['id_pago']);


	$html = "


<!DOCTYPE html>
<html>
	<head>
		<title>TITULO</title>
<meta charset='utf-8' />


		<style type='ext/css'>

			#datos{
				position: absolute;
				right: 10%;
				top: 10%;
				text-align: right;
			}

			#logo{
				width:30%;
			}

			table{
				margin-top:50px;
				border:1px solid black;
				width:100%;
				text-align:center
			}

			#info_gym{
				position:absolute;
				bottom:50px;
				right:10%;
				text-align:right;
			}

		</style>


	</head>
	<body>
		<img id='logo' src='img/logo_negro.png'>
		<div id='datos'>

			<h3>Factura Nº ".$_REQUEST['id_pago']."</h3>
			<h5>".$linea['nombre']."</h5>
			<h5>".$linea['email']."</h5>
			<h5>".$linea['dni']." - ".$linea['telefono']."</h5>


		<table>

			<tr>
				<td>Fecha de pago</td>
				<td>Fecha vencimiento</td>
				<td>Importe</td>
			</tr>

			<tr>
				<td>".$linea['fecha_pago']."</td>
				<td>".$linea['fecha_vencimiento']."</td>
				<td>".$linea['precio']."€</td>
			</tr>


		</table>


		</div>

		<div id='info_gym'>
			<span>Daw Gym</span><br>
			<span>c/ Francisco Carrión Mejías</span><br>
			<span>Tel: 954000000</span><br>


		</div>




		
	</body>
</html>


	";
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream("nombre.pdf");


?>