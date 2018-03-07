<?php
include_once './lib/nusoap.php';
$cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");

session_start();
$usuario = $_POST['nombre-login']; //Aqui se obtiene el usuario del formulario
$contrasena = md5($_POST['clave-login']); //Aqui tambien se obtiene del formulario, pero se encripta con md5
$parametros = array('usuario' => $usuario, 'contrasena' => $contrasena);
$resultado = $cliente->call("iniciarSesion", $parametros);
if ($resultado == true) { //Si encuentra, regresa true y guarda el resultado en variables temporales
	$tabla = "RegCarrito";
	$cond = "WHERE Usuario_reg LIKE '".$usuario."' OR Correo_electronico LIKE '".$usuario."'";
	$parametros2 = array('campos' => '*', 'tabla' => $tabla, 'cond' => $cond);
	$resultado2 = $cliente->call("seleccionarConsulta", $parametros2);
	foreach ($resultado2 as $fila) {
		$usuario = $fila['Usuario_reg'];
	}
	$_SESSION['nombreUser'] = $usuario;
	$_SESSION['claveUser'] = $contrasena;
	$_SESSION['Status'] = $resultado;
	echo '<script> location.href="index.php"; </script>'; //refresca la pagina al index
}elseif($resultado == false) {
	$resultado1 = $cliente->call("iniciarSesionA", $parametros);
	if ($resultado1 == true) {
		$_SESSION['nombreAdmin'] = $usuario;
		$_SESSION['claveAdmin'] = $contrasena;
		echo '<script> location.href="index.php"; </script>';
	}else {
	echo "Usuario o contrase&ntildea incorrectos";
	}
}
?>