<?php
include_once './lib/nusoap.php';
$cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
session_start();
unset($_SESSION['producto']);
unset($_SESSION['contador']);
unset($_SESSION['sumaTotal']);
//Al mismo tiempo se borra todo del carrito
$tabla = "Carrito_Temp";
$cond = "WHERE Usuario_reg LIKE '".$_SESSION['nombreUser']."'";
$parametros = array('tabla' => $tabla, 'cond' => $cond);
$resultado = $cliente->call("eliminarTupla", $parametros);
?>
<script>
    history.go(-1);
</script>