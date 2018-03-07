<html lang="es">
<!DOCTYPE html>
<head>
  <title>Inicio</title>
  <?php include './inc/link.php' ?>
</head>
<body id="container-page-index">
<?php include './inc/navbar.php'; ?>
  <div class="jumbotron" id="jumbotron-index"> 
  <h1><span class="tittles-pages-logo">Contador Virtual</span> <small></small></h1>
  <p>Bienvenido a nuestra tienda en linea, aqu&iacute encontrara una gran variedad de servicios a su medida.</p>
  </div>
  <section id="new-prod-index">
    <div class="container">
      <div class="page-header"><h1>Novedades <small>servicios</small></h1></div>
        <div class="row col-sm-12">
          <!--Conexion al WEBSERVICE para mostrar los diferentes sistemas que tenemos a la venta en recuadros con una imagen para cada uno de ellos como simbolo unico -->
          <?php
          include_once './library/lib/nusoap.php';
          $cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
          $tabla = "Sistemas";
          $cond = "";
          $parametros = array('campos' => '*', 'tabla' => $tabla, 'cond' => $cond );
          $resultado = $cliente->call("seleccionarConsulta", $parametros);
          foreach ($resultado as $fila) {
            echo'<div class="continer col-sm-4 col-xs-12 col-lg-4">
                  <h2><div class="" style >'.$fila['TipoSistema'].'<br><br></div></h2>
                  <a href="infoProdWS.php?CodigoProd='.$fila['TipoSistema'].'"><img src="'.$fila['Imagen_URL'].'" class="img-responsive" alt="prueba" style="width: 340px; height: 195px")><br></a>
                  </div>';
          } 
          ?>
        </div>
    </div>
  </section>
  <?php include './inc/footer.php'; ?>
</body>
</html>