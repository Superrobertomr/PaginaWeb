<?php
header('Content-Type: text/html; charset=ISO-8859-1');
include_once './lib/nusoap.php';
$cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
error_reporting(E_PARSE);
session_start();
$suma;
$prod;
$iva;
$carrito = $_SESSION['carrito'];
if(isset($_GET['precio'])) {
  $_SESSION['producto'][$_SESSION['contador']] = $_GET['precio'];
  $_SESSION['contador']++;
}
/*Aqui se crea una tabla de los productos a comprar para que el cliente vea siempre que tiene
o que cuesta el iva de todo esto y administrarse*/
echo '<table class="table table-bordered table-responsive" style="padding-left: -50px; color: #fff">
<th>Nombre del producto</th><th>Cantidad de productos</th><th>Costo del producto</th><th>IVA 16%</th><th>Total por producto</th>';
if ($_SESSION['contador'] == 0) {
  $tabla = "Carrito_Temp";
  $cond = "WHERE Usuario_reg LIKE '".$_SESSION['nombreUser']."' ORDER BY Nombre_producto";
  $parametros2 = array('campos' => '*', 'tabla' => $tabla, 'cond' => $cond);
  $resultado2 = $cliente->call("seleccionarConsulta", $parametros2);
  if ($resultado2) {
    foreach ($resultado2 as $productos) {
      $ivaC += $productos['Costo_producto'];
      $ivaS2 += ($productos['Costo_producto'] * 0.16);
      $totalP = ($productos['Costo_producto'] + ($productos['Costo_producto'] * 0.16));
      $ivaS = ($productos['Costo_producto'] * 0.16);
      echo "<tr><td>".$productos['Nombre_producto']."</td>
      <td>".$productos['Cantidad']."</td>
      <td> $".number_format($productos['Costo_producto'],2)."</td>
      <td> $".number_format($ivaS,2)."</td>
      <td> $".number_format($totalP,2)."</td>
      <td><a href='process/vaciarCarritoInd.php?id=".$productos['Carrito_TempID']."&user=".$productos['Usuario_reg']."' class='btn btn-danger btn-block'><i class='fa fa-trash'></i>   </a></td></tr>";
    }
  }
}
for($i = -1;$i< $_SESSION['contador'];$i++){
  $resultado = $cliente->call("seleccionarConsulta", array('campos' => '*', 'tabla' => 'TiposLicencias', 'cond' => "WHERE TipoLicenciasID LIKE '".$_SESSION['producto'][$i]."'" ));
  foreach ($resultado as $fila) {
          //Aqui compararé si hay datos iguales ingresados
    $tablaCar = "Carrito_Temp";
    $condCar = "WHERE Usuario_reg LIKE '".$_SESSION['nombreUser']."' AND Nombre_producto LIKE '".$fila['Nombre']."'";
    $parametrosCar = array('campos' => '*', 'tabla' => $tablaCar, 'cond' => $condCar);
    $resultadoCar = $cliente->call("seleccionarConsulta", $parametrosCar);

    foreach ($resultadoCar as $productosCar) {
      $cantidaNew = $productosCar['Cantidad'] + 1;
      $costoNew = $productosCar['Costo_producto'] + $fila['Costo'];
      $nombreProd = $productosCar['Nombre_producto'];
      if ($nombreProd == $fila['Nombre']) {

        $tablaM = "Carrito_Temp";
        $datosUpdate = "Cantidad = ".$cantidaNew.", Costo_producto = '".$costoNew."'";
        $idCambio = "Usuario_reg LIKE '".$_SESSION['nombreUser']."' AND Nombre_producto LIKE '".$nombreProd."'";
        $parametrosM = array('tabla' => $tablaM , 'datosUpdate' => $datosUpdate, 'idCambio' => $idCambio);
        $resultadoM = $cliente->call("modificarTupla", $parametrosM);
      }
    }

    if ($nombreProd != $fila['Nombre']) {
            //Aqui agrega tuplas del producto
      $tablaColumnas = "Carrito_Temp(Usuario_reg, Nombre_producto, Cantidad, Costo_producto)";
      $datosInsertar = "'".$_SESSION['nombreUser']."', '".$fila['Nombre']."', ".isset($fila['Costo']).", '".$fila['Costo']."'";
      $parametros = array('tablaColumnas' => $tablaColumnas , 'datosInsertar' => $datosInsertar);
      $resultado = $cliente->call("insertarTupla", $parametros);
    }

    $tabla = "Carrito_Temp";
    $cond = "WHERE Usuario_reg LIKE '".$_SESSION['nombreUser']."'";
    $parametros2 = array('campos' => '*', 'tabla' => $tabla, 'cond' => $cond);
    $resultado2 = $cliente->call("seleccionarConsulta", $parametros2);

    if ($resultado2) {
      foreach ($resultado2 as $productos) {
        //Aqui nomas se concatenan los valores para hacerlo mas facil
        $ivaC += $productos['Costo_producto'];
        $ivaS2 += ($productos['Costo_producto'] * 0.16);
        $totalP = ($productos['Costo_producto'] + ($productos['Costo_producto'] * 0.16));
        $ivaS = ($productos['Costo_producto'] * 0.16);
        echo "<tr><td>".$productos['Nombre_producto']."</td>
        <td>".$productos['Cantidad']."</td>
        <td> $".number_format($productos['Costo_producto'],2)."</td>
        <td> $".number_format($ivaS,2)."</td>
        <td> $".number_format($totalP,2)."</td>
        <td><a href='process/vaciarCarritoInd.php?id=".$productos['Carrito_TempID']."&user=".$productos['Usuario_reg']."' class='btn btn-danger btn-block'><i class='fa fa-trash'></i>   </a></td></tr>";
      }
    }
  }
}
$_SESSION['contador'] = 0;
echo "<tr class='table-responsive'><td></td><td></td><td></td><td></td><td></td></tr>";
echo "<tr><td>Subtotal</td><td></td><td>$".number_format($ivaC,2)."</td><td> $".number_format($ivaS2,2)."</td></tr>";
echo "<tr><td></td><td></td><td></td></tr>";
echo "<tr><td></td><td>Total</td><td> $".number_format($ivaC + $ivaS2,2)."</td></tr>";
echo "</table>";
$_SESSION['sumaTotal'] = $ivaC + $ivaS2;