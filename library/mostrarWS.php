<?php
$cliente = new nusoap_client("http://192.168.1.74/WebService/servicio.php?wsdl");

echo "<br>Esta parte corresponde al las 3 categorias o sistemas disponibles<br>";
$tabla = "Sistemas";
$cond = "";
$parametros = array('tabla' => $tabla, 'cond' => $cond );
$resultado = $cliente->call("seleccionarConsulta", $parametros);
foreach ($resultado as $fila) {
	echo "Un valor integer: ".$fila['SistemasID']."<br>";
	echo "Un valor string: ".$fila['TipoSistema']."<br>";
	echo "Un valor string: ".$fila['NombreSistema']."<br>";
	echo "Un valor string: ".$fila['Descripcion']."<br>";
	echo "Un valor booleano: ".$fila['Activo']."<br>";
	echo "Un valor date: ".$fila['FechaAlta']."<br>";
	echo "Un valor booleano: ".$fila['TimbradoActivo']."<br>";
	echo "Un valor booleano: ".$fila['ActualizacionesActivas']."<br><br>";
}

echo "<br>Esta parte dan todos los modulos de categorias<br>";
$tabla1 = "TiposLicencias";
$cond1 = "ORDER BY TipoSistema DESC";
$parametros1 = array('tabla' => $tabla1, 'cond' => $cond1 );
$resultado1 = $cliente->call("seleccionarConsulta", $parametros1);
foreach ($resultado1 as $fila) {
	echo "Un valor integer: ".$fila['TipoLicenciasID']."<br>";
	echo "Un valor string: ".$fila['Nombre']."<br>";
	echo "Un valor string: ".$fila['TipoSistema']."<br>";
	echo "Un valor booleano: ".$fila['fecha']."<br>";
	echo "Un valor booleano: ".$fila['version']."<br>";
	echo "Un valor integer: ".$fila['Meses']."<br>";
	echo "Un valor real: ".$fila['Horas_Soporte_Licencia']."<br>";
	echo "Un valor text: ".$fila['Descripcion']."<br><br>";
}


?>