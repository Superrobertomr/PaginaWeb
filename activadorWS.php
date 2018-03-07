<!DOCTYPE html>
<html>
<head>
	<title>Confirmaci&oacuten de la cuenta</title>
	<?php include './inc/link.php'; ?>
</head>
<body>
<?php include './inc/navbar.php'; ?>
	<section>
	<div class="text-center" id="tutulo-activar">
		<?php
		include_once './library/lib/nusoap.php';
		$cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
		$email = $_GET['email'];
		$tabla = "RegCarrito";
		$cond = "";
		$param = array('campos' => '*', 'tabla' => $tabla, 'cond' => $cond);
		$resultado0 = $cliente->call("seleccionarConsulta", $param);
		foreach ($resultado0 as $fila){
			/*Aqui valida solo si el correo electronico dado en el link activador que se otorgo
			al momento de registrarse es el mismo que alguno que se registro*/
			if ($email == md5($fila['Correo_electronico'])) { //Ojo, es un link personal
				if (1 == $fila['Status']) {
					echo '<h2>Este link es &uacute;nico para este correo electr&oacute;nico</h2>
					 <p>Este link ya se uso</p>';
				}else {
					$datosUpdate = "Status = 1";
					$idCambio = "Correo_electronico LIKE '".$fila['Correo_electronico']."'";
					$parametros = array('tabla' => $tabla, 'datosUpdate' => $datosUpdate, 'idCambio' => $idCambio);
					$resultado = $cliente->call("modificarTupla", $parametros);
					if ($resultado == "si") {
					  echo '<h1>Ya esta activado, inicie sesi&oacute;n para empezar a comprar</h1>';
					}
				}
			}
		}
		?>
	</div>
	</section>
	<?php include './inc/footer.php'; ?>
</body>
</html>