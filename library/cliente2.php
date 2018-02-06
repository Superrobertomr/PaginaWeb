<?php
include_once './lib/nusoap.php';
$cliente = new SoapClient("http://localhost/WebService/servicio.php?wsdl");

//$resultado1 = $cliente->__soapCall("seleccionarConsulta", array("tabla" => "Carrito_Temp", "cond" => "nada"));
$num1 = 1;
$num2 = 3;
$parametro = array("num1" => "1", "num2" => "3");
$resultado1 = $cliente->__soapCall("suma", $parametro);


print_r($resultado1);
?>