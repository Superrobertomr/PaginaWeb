<?php
include_once './lib/nusoap.php';
$cliente = new nusoap_client("http://192.168.1.77/WebService/servicio.php?wsdl");

session_start();
$usuario = $_POST['nombre-login'];
$contrasena = md5($_POST['clave-login']);
$parametros = array('usuario' => $usuario, 'contrasena' => $contrasena );
$resultado = $cliente->call("iniciarSesion", $parametros);
if ($resultado == "cliente") {
	$_SESSION['nombreUser']=$usuario;
	$_SESSION['claveUser']=$contrasena;
	echo '<script> location.href="index.php"; </script>';
}else {
	$resultado1 = $cliente->call("iniciarSesionA", $parametros);
	if ($resultado1 == "administrador") {
		$_SESSION['nombreAdmin']=$usuario;
		$_SESSION['claveAdmin']=$contrasena;
		echo '<script> location.href="index.php"; </script>';
	}else {
	echo "Usuario o contrase&ntildea incorrectos";
	}
}
?>