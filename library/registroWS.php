<?php
include_once './lib/nusoap.php';
$cliente = new nusoap_client("http://192.168.1.74/WebService/servicio.php?wsdl");

$usuario = $_POST['clien-name'];
$contrasena = md5($_POST['clien-pass']);
$correo = $_POST['clien-email'];
$contConf = md5($_POST['clien-pass-confir']);
if($contrasena = $contConf){
	$contrasenaF = true;
	echo 'su contraseña coincide con la anterior';
}else echo 'la contraseña no coincide';

$parametros = array('usuario' => $usuario, 'contrasena' => $contrasena, 'correo' => $correo );
$resultado = $cliente->call("registrarse", $parametros);
if ($resultado == "si") {
	echo '<script> location.href="../index.php"; </script>';
}else {
	echo "Ha ocurrido un error<br>";
}
//Aqui ya ponemos su carrito en funcionamiento
$resultado1 = $cliente->call("seleccionarConsulta", array('tabla' => 'RegCarrito', 'cond' => "WHERE Usuario_reg LIKE '".$usuario."'" ));
$uID = "";
foreach ($resultado1 as $fila) {
	$uID = $fila['RegCarritoID'];
}
//Después crearemos el carrito
$parametros3 = array('datoUno' => $uID);
$resultado3 = $cliente->call("crearCarrito", $parametros3);
if ($resultado3 == "si") {
	echo "Carrito creado correctamente<br>";
}

?>