<?php
include_once './lib/nusoap.php';
$cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
$id = $_GET['id'];
$Usuario = $_GET['user'];
$tabla = "Carrito_Temp";
$cond = "WHERE Usuario_reg LIKE '".$Usuario."' AND Carrito_TempID = '".$id."'";
$parametros = array('tabla' => $tabla, 'cond' => $cond);
$resultado = $cliente->call("eliminarTupla", $parametros);
?>
<script>
    history.go(-1);
</script>
