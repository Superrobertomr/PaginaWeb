<?php
error_reporting(E_PARSE);
include '../library/configServer.php';
include '../library/consulSQL.php';
session_start();
$suma = 0;
$prod = 0;
$iva = 0;
$cantidad='$suma';
if(isset($_GET['precio'])){
    $_SESSION['producto'][$_SESSION['contador']] = $_GET['precio'];
    $_SESSION['contador']++;
}
echo '<table class="table table-bordered">';
for($i = 0;$i< $_SESSION['contador'];$i++){
    $consulta=ejecutarSQL::consultar("select * from producto where CodigoProd='".$_SESSION['producto'][$i]."'");
    while($fila = mysqli_fetch_array($consulta)) {
        $iva0 = ($fila['Precio']*$fila['Descuento'])* $fila['IVA'];
    	$SubTotal = $fila['Precio']-($fila['Precio']*$fila['Descuento']);
    	$Total = $SubTotal + (($fila['Precio']*$fila['Descuento'])* $fila['IVA']);
        echo "<tr><td>".$fila['NombreProd']."</td><td> $".number_format($SubTotal, 2)."</td></tr>";
    $iva += $iva0;
    $suma += $Total;
    $prod += isset($fila['Precio']);
    }
}
echo "<tr><td>IVA incluido del 16%</td><td>$".number_format($iva,2)."</td></tr>";
echo "<tr><td></td><td></td></tr>";
echo "<tr><td>Subtotal</td><td>$".number_format($suma,2)."</td></tr>";
echo "</table>";
$_SESSION['sumaTotal']=$suma;
$_SESSION['productosTotales'] = $prod;