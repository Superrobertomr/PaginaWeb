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
      <p>
          Bienvenido a nuestra tienda en linea, aquí encontrara una gran variedad de servicios a su medida.
      </p>
    </div>
    <section id="new-prod-index">
         <div class="container">
            <div class="page-header">
      <h1>Novedades <small>productos</small></h1><br><br>
        <div class="container col-sm-4">
          <h2>Contabilidad Web</h2>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Facturación</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Cuentas por cobrar</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Contabilidad</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Bancos</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Impuestos</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Discrepancia Fiscal</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Otros</h4></label></div>
        </div>
        <div class="container col-sm-8" align="center">
          <video controls="play" class="" style="width: 100%; height: 75%; padding-bottom: 26px; padding-top: 1px">
            <source src="assets/videos/la-contabilidad.mp4" type="video/mp4">
          </video>
        </div>



           <div class="container col-sm-8" align="center" id="new-prod-index2">
          <video controls class="" style="width: 100%; height: 50%; padding-bottom: 26px; padding-top: 1px">
            <source src="assets/videos/Nietzsche.mp4" type="video/mp4">
          </video>
        </div>
        <div class="container col-sm-4">
          <h2>Contabilidad Escritorio</h2>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Facturación</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Cuentas por cobrar</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Contabilidad</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Bancos</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Impuestos</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Discrepancia Fiscal</h4></label></div>
          <div class="checkbox"><label><h4><input type="checkbox" value="">Otros</h4></label></div>
        </div>
        <button value="'.$fila['CodigoProd'].'" class="btn btn-success  btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
            </div><br><br>
      </div>

    <class id="reg-info-index">
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
            <div class="col-xs-12 col-sm-6">

            </div>
            <div class="col-xs-12 col-sm-6">

            </div>
            <div class="col-xs-12">
            </div> 
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>