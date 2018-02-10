<!DOCTYPE html>
<html lang="es">
<head>
  <title>Productos</title>
  <?php include './inc/link.php'; ?>
</head>
<body id="container-page-product">
  <?php include './inc/navbar.php'; ?>
  <section id="store">
    <br>
    <div class="container">
      <div class="page-header">
        <h1>Tienda <small class="tittles-pages-logo">Contador Virtual</small></h1>
          </div>
          <br><br>
          <h2>Recuerda: Recibe un descuento en la compra de cualquier producto disponible aquí</h2>
          <br><br>
          <div class="row">
            <div class="col-xs-12">
              <ul id="store-links" class="nav nav-tabs" role="tablist">
                  <li role="presentation"><a href="#all-product" role="tab" data-toggle="tab" aria-controls="all-product" aria-expanded="false">Todos los productos</a></li>
                  <li role="presentation" class="dropdown active">
                  <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Categorías <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
               <!-- ==================== Lista categorias =============== -->
<?php
include_once './library/lib/nusoap.php';
$cliente = new nusoap_client("http://192.168.1.74/WebService/servicio.php?wsdl");
$tabla0 = "Sistemas";
$cond0 = "";
$parametros0 = array('tabla' => $tabla0, 'cond' => $cond0 );
$resultado0 = $cliente->call("seleccionarConsulta", $parametros0);
foreach ($resultado0 as $fila) {
  echo '<li><a href="#'.$fila['SistemasID'].'" tabindex="-1" role="tab" id="'.$fila['SistemasID'].'-tab" data-toggle="tab" aria-controls="'.$fila['SistemasID'].'" aria-expanded="false">'.$fila['TipoSistema'].'</a></li>';
}
?>
               <!-- ==================== Fin lista categorias =============== -->
              </ul>
              </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade" id="all-product" aria-labelledby="all-product-tab">
                <br><br>
                  <div class="row">
<?php
$tabla = "Sistemas";
$cond = "";
$parametros = array('tabla' => $tabla, 'cond' => $cond );
$resultado = $cliente->call("seleccionarConsulta", $parametros);
foreach ($resultado as $fila) {
  $sisID = $fila['TipoSistema'];
  echo "<h2>".$sisID."</h2>";
  $tabla1 = "TiposLicencias";
  $cond1 = "WHERE TipoSistema LIKE '".$sisID."'";
  $parametros1 = array('tabla' => $tabla1, 'cond' => $cond1 );
  $resultado1 = $cliente->call("seleccionarConsulta", $parametros1);
echo '<div class="form">
  <div class="container">
    <div class="page-header">';
  foreach ($resultado1 as $fila) {
    echo '<div class="container col-md-4 text-center" style="background-color: #8521">'.$fila['Nombre'].'<p class="text-justify" style="background-color: white; height: 150px"><br>'.$fila['Descripcion'].'</p></div>';
  }
  echo "</div></div></div>";
}
?>
                  </div>
                </div><!-- Fin del contenedor de todos los productos -->     
                      <!-- ==================== Contenedores de categorias =============== -->
<?php
$tabla2 = "Sistemas";
$cond2 = "";
$parametros2 = array('tabla' => $tabla2, 'cond' => $cond2 );
$resultado2 = $cliente->call("seleccionarConsulta", $parametros2);
foreach ($resultado2 as $fila) {
  echo '<div role="tabpanel" class="tab-pane fade active in" id="'.$fila['SistemasID'].'" aria-labelledby="'.$fila['SistemasID '].'-tab"><br>';
  $sisID = $fila['TipoSistema'];
  echo "<h2>".$sisID."</h2>";
  $tabla1 = "TiposLicencias";
  $cond1 = "WHERE TipoSistema LIKE '".$sisID."'";
  $parametros1 = array('tabla' => $tabla1, 'cond' => $cond1 );
  $resultado1 = $cliente->call("seleccionarConsulta", $parametros1);
  foreach ($resultado1 as $fila) {
    echo "<div class='checkbox'><label><h4><input type='checkbox' value=''>".$fila['Nombre']."</h4></label></div>";
  }
  echo "</div>";
}
?>
                      <!--   =================== Fin contenedores de categorias =============== -->
<!-- <div class="form">
  <div class="container">
    <div class="page-header">
    <div class="container col-md-4 text-center" style="background-color: #8521">Mision</div>
    <div class="contain col-md-4 text-center">Vision</div>
    <div class="contain col-md-4 text-center">Valore</div>
    </div>
  </div>
</div>   -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
    <script>
        $(document).ready(function() {
            $('#store-links a:first').tab('show');
        });
    </script>
</body>
</html>




