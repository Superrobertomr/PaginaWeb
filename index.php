<!DOCTYPE html>
<html lang="es">
<head>
  <title>Inicio</title>
  <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
  <?php include './inc/navbar.php'; ?>
  <div class="jumbotron" id="jumbotron-index"> 
  <h1><span class="tittles-pages-logo">Contador Virtual</span> <small style="color: #fff;"></small></h1>
  <p>Bienvenido a nuestra tienda en linea, aqu&iacute encontrara una gran variedad de servicios a su medida.</p>
  </div>
    <section id="new-prod-index">
      <div class="container">
        <div class="page-header">
          <h1>Novedades <small>productos</small></h1></div>
          <div class="row col-sm-12">

<?php
include_once './library/lib/nusoap.php';
$cliente = new nusoap_client("http://192.168.1.77/WebService/servicio.php?wsdl");
$tabla = "Sistemas";
$cond = "";
$parametros = array('tabla' => $tabla, 'cond' => $cond );
$resultado = $cliente->call("seleccionarConsulta", $parametros);
foreach ($resultado as $fila) {
    echo'
    <div class="continer col-sm-4">
          <h2><div class="" style >'.$fila['TipoSistema'].'<br></div></h2>
          <a href="infoProd.php?CodigoProd='.$fila['TipoSistema'].'"><img src="assets/img-products/place.jpg" class="img-responsive" alt="prueba"><br></a>
    </div>';
} 
   
?>
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
                <p> <button aling="right" type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModaregistro">Registrarse</button></p>   
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