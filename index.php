<!DOCTYPE html>
<html lang="es, en">
<head>
  <title>Inicio</title>
  <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
  <?php include './inc/navbar.php'; ?>
  <div class="jumbotron" id="jumbotron-index"> 
  <h1><span class="tittles-pages-logo">Contador Virtual</span> <small style="color: #fff;"></small></h1>
  <p>Bienvenido a nuestra tienda en linea, aquí encontrara una gran variedad de servicios a su medida.</p>
  </div>
    <section id="new-prod-index">
      <div class="container">
        <div class="page-header">
          <h1>Novedades <small>productos</small></h1>
          <div class="container col-sm-4">

<?php
include_once './library/lib/nusoap.php';
$cliente = new nusoap_client("http://192.168.1.74/WebService/servicio.php?wsdl");
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
  foreach ($resultado1 as $fila) {
    echo "<div class='checkbox'><label><h4><input type='checkbox' value=''>".$fila['Nombre']."</h4></label></div>";
  }
  echo "<br>";
}
?>
        </div>
      </div>
    </div>
  </section>
  <section id="reg-info-index">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 text-center">
          <article style="margin-top:20%;">
            <p><i class="fa fa-users fa-4x"></i></p>
              <h3>Registrate</h3>
                <p>Registrese y hagase cliente de <span class="tittles-pages-logo">Contador Virtual</span> para recibir las mejores ofertas y descuentos especiales de nuestros productos.</p>
                <p><a href="registration.php" class="btn btn-info btn-block">Registrarse</a></p>   
          </article>
        </div>
        <div class="col-xs-12 col-sm-6">
          <img src="assets/img/ofi.png" alt="Eoficinista" class="img-responsive">
        </div>
      </div>
    </div>
  </section>
  <section id="distribuidores-index">
    <div class="container">
      <div class="col-xs-12 col-sm-6"></div>
      <div class="col-xs-12 col-sm-6"></div>
      <div class="col-xs-12"></div> 
    </div>
  </section>
  <?php include './inc/footer.php'; ?>
</body>
</html>