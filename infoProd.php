<!DOCTYPE html>
<html lang="es">
<head>
  <title>Productos</title>
  <?php include './inc/link.php'; ?>
</head>
<body id="container-page-product">
  <?php include './inc/navbar.php'; ?>
  <section id="infoproduct">
    <div class="container">
      <div class="row">
        <div class="page-header">
          <h1>Tienda <small class="tittles-pages-logo">Contador Virtual</small></h1>
        </div>
<?php
include_once './library/lib/nusoap.php';
$cliente = new nusoap_client("http://192.168.1.77/WebService/servicio.php?wsdl");
$tabla1 = "TiposLicencias";
$cond1 = "WHERE TipoSistema LIKE '".$_GET['CodigoProd']."'";
$parametros1 = array('tabla' => $tabla1, 'cond' => $cond1 );
$resultado1 = $cliente->call("seleccionarConsulta", $parametros1);
echo "<h2 class='text-center'>".$_GET['CodigoProd']."</h2>";
echo '<div class="form">
 <div class="container">';
  foreach ($resultado1 as $fila) {
    echo "<br><div class='container col-sm-3 text-center' style='background-color: #8521'>".$fila['Nombre']."</div>
     <div class='container text-justify' style='background-color: white;'>
       <br><h4>Descripcion: </h4><p>".$fila['Descripcion']."</p>
      <div class='col-sm-2 text-center'>
       <h4>Meses disponibles: </h4><p>".$fila['Meses']."</p>
      </div>
      <div class='col-sm-2 text-center'>
       <h4>Horas de soporte brindadas: </h4><p>".date("s:i", $fila['Horas_Soporte_Licencia'])."</p>
      </div>
      <div class='col-sm-2 text-center'>";
    echo "<h4>Este sistema comprende pagos por: </h4>";
    if ($fila['fecha'] == 1) {
      echo "<p>Fecha</p>";
    }elseif ($fila['version'] == 1) {
      echo "<p>Version de software</p>";
    }
    echo "</div>
     <div class='col-sm-2 text-center'></div>
     <div class='col-sm-2 text-center'>
      <br><br><p class='text-center'><a href='infoProd.php?CodigoProd='".$fila['TipoSistema']."' class='btn btn-success'><i class='fa fa-plus'></i>&nbsp; Agregar al carrito</a>&nbsp;&nbsp;<br>
     </div>
    </div>";
  }
?>
      </div>
    </div>
  </section>
  <?php include './inc/footer.php'; ?>
</body>
</html>