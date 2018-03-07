<!DOCTYPE html>
<html lang="es">
<head>
  <title>Productos</title>
  <?php include './inc/link.php'; ?>
  </style>
</head>
<body id="container-page-product">
  <?php include './inc/navbar.php'; ?>
  <section id="infoproduct">
    <div class="container">
      <div class="row">
        <div class="page-header">
          <h1>Tienda <small class="tittles-pages-logo">Contador Virtual</small></h1><br>
        </div>
        <div class="container" align="center">
          <video controls="" class="" style="width: 1000px; height:  500px; padding-bottom: 26px; padding-top: 1px">
            <source src="assets/video/Diogenes.mp4" type="video/mp4"></source>
          </video>
        </div>
<?php
//Proceso para mostrar los tipos de licencias que tiene cada sistema conectandose a un webservice mostrandose en columnas cada uno de ellas con su respectiva informacion y su boton de agregar al carrito
include_once './library/lib/nusoap.php';
$cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
$tabla1 = "TiposLicencias";
$cond1 = "WHERE TipoSistema LIKE '".$_GET['CodigoProd']."'";
$parametros1 = array('campos' => '*', 'tabla' => $tabla1, 'cond' => $cond1 );
$resultado1 = $cliente->call("seleccionarConsulta", $parametros1);
echo "<h2 class='text-center'>".$_GET['CodigoProd']."</h2>";
echo '<div class="form">
 <div class="container">';
  foreach ($resultado1 as $fila) {
    echo "<br><div class='panel text-justify' style='background-color: #cbff00'>
     <div class='col-sm-12 text-left' ><h2>".$fila['Nombre'].".</h2></div>
     <div class='col-md-10'>
     <br><h4>Descripcion: </h4><p>".$fila['Descripcion']."</p>
     </div>
       <div class='col-md-2 text-center'>
        <br><h4>Cosas incluidas: </h4>";
          $tabla2 = "Modulos";
          $cond2 = "WHERE Nombre_TiposLicancias LIKE '".$fila['Nombre']."' AND Modulo_Activo LIKE '1'";
          $parametros2 = array('campos' => '*', 'tabla' => $tabla2, 'cond' => $cond2 );
          $resultado2 = $cliente->call("seleccionarConsulta", $parametros2);
          foreach ($resultado2 as $fila2) {
            echo "<p>-".$fila2['Nombre_Modulo']."</p>";
          }
          echo "</div>
                 <div class='container'>
                  <div class='col-sm-3 text-center'>
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
       <h4>Costo: </h4><p>$".number_format($fila['Costo'], 2)."</p><p>m&aacutes IVA</p>
       <br><button value='".$fila['TipoLicenciasID']."' class='btn btn-success btn-sm botonCarrito'><i class='fa fa-shopping-cart'></i>&nbsp; A&ntildeadir</button><br><br>
      </div>
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