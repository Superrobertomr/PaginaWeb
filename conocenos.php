<!DOCTYPE html>
<html lang="es">
<head>
  <title>Conocenos</title>
  <?php include './inc/link.php'; ?>
</head>
<body id="container-page-registration">
  <?php include './inc/navbar.php'; ?>
<!--Vista de la mision y la vision de la empresa mediante un carousel que contiene solamente texto y con una imagen de fondo-->Su
<section id="form-registration">
  <!-- <div class="container text-left col-md-6"></div> -->
  <div class="container text-right">
    <div id="text-carousel" class="carousel slide" data-ride="carousel" data-slide-to="">
        <!-- Wrapper for slides -->
      <div class="row col-xl-6">
        <div class="carousel-inner">
          <div class="item active">
            <div class="carousel-content">
              <div>
                <div class="tittles-pages-logo"><h1>Misi&oacuten</h1></div>  
                  <h3><p>Sapiente, ducimus, voluptas, mollitia voluptatibus <br> nemo explicabo sit blanditiis laborum dolore illum fuga veniam quae<br> expedita libero accusamus quas harum ex numquam <br> necessitatibus provident deleniti tenetur iusto officiis <br> recusandae corporis culpa quaerat?</p></h3>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="carousel-content">
              <div>
                <div class="tittles-pages-logo"><h1>Visi&oacuten</h1></div>  
                  <h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Animi, sint fuga temporibus nam saepe delectus expedita vitae <br>magnam necessitatibus dolores tempore consequatur dicta <br> cumque repellendus eligendi ducimus placeat! </p></h3>
              </div>
            </div>
            </div>
              <div class="item">
                <div class="carousel-content">
                  <div> 
                    <div class="tittles-pages-logo"><h1>Valores de la empresa</h1></div>                         
                      <h3><p>Sapiente, ducimus, voluptas, mollitia voluptatibus <br>nemo explicabo sit blanditiis laborum dolore illum fuga veniam <br> quae expedita libero accusamus quas harum ex numquam necessitatibus <br> provident deleniti tenetur iusto officiis recusandae corporis culpa quaerat?</p></h3>
                  </div>
                </div>
              </div>         
        </div>
      </div>
    </div>  
    </div>
    <!-- Controls --> 
    <a class="left carousel-control" style="height: 920px" href="#text-carousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" style="height: 920px" href="#text-carousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</section>
<?php include './inc/footer.php'; ?>
</body>
</html>