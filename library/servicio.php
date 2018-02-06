<?php

include_once './lib/nusoap.php';
$servicio = new soap_server();

$ns = "urn:administrador_de_usuarios";
$servicio->configureWSDL("WebService",$ns);
$servicio->schemaTargetNamespace = $ns;

$servicio->register("seleccionarConsulta", array('tabla' => 'xsd:string', 'cond' => 'xsd:string'), array('return' => 'xsd:Array'), $ns );
$servicio->register("suma", array('num1' => 'xsd:integer', 'num2' => 'xsd:integer'), array('return' => 'xsd:string'), $ns );

function seleccionarConsulta($tabla, $cond){

 include_once './backIn/conexion.php';
 $con = new Conexion();
 $conn = $con->conectarse();

 $query = "SELECT * FROM ".$tabla;
 $datos = odbc_exec($conn, $query);	
 return $datos;
 
}
function suma($num1, $num2)
{
    $r1 = $num1 + $num2;
    $res = "El resultado es: " + $r1;
    return $res;
}

$servicio->service(file_get_contents("php://input")); 
?>