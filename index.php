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
      <p>
          Bienvenido a nuestra tienda en linea, aquí encontrara una gran variedad de servicios a su medida.
      </p>
    </div>
    <section id="new-prod-index">
         <div class="container">
            <div class="page-header">
                <h1>Novedades <small>productos</small></h1>
              <?php
                  include 'library/configServer.php';
                  include 'library/consulSQL.php';
                  echo "<div class='jumbotron'><h2>Recibe <b></b>un descuento en la compra de cualquier producto disponible aquí</h2></div>";
                  $consulta= ejecutarSQL::consultar("select * from producto where CodigoCat like 'C1'");
                  $i1 = mysqli_num_rows($consulta);
                  if($i1>0){
                      while($fila=mysqli_fetch_array($consulta)){
                         echo '
                        <div class="col-xs-12 col-sm-6 col-md-3">
                             <div class="thumbnail">
                               <img src="assets/img-products/'.$fila['Imagen'].'" style="widht:100px; heigth:100px">
                               <div class="caption">
                                 <h3>'.$fila['NombreProd'].'</h3>
                                 <p>'.$fila['Descripcion']. '</p>
                                 <p>$'.$fila['Precio'].'</p>';
                                 $por = $fila['Descuento'] * 100;
                                 echo '<p>El descuento a obtener es del: '.$por.'%</p>
                                 <p class="text-center">
                                     <a href="infoProd.php?CodigoProd='.$fila['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;';
                                      if($_SESSION['nombreUser']==$fila['RFCProveedor']){
                                        echo '';
                                      }elseif(!$_SESSION['nombreUser']=="" &&!$_SESSION['claveUser']==""){
                                        echo '<button value="'.$fila['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>';
                                      }                                    
                                    echo '</p>
                               </div>
                             </div>
                         </div>     
                         ';
                     }  
                  }else{
                  } 
                  echo "<br><p>-------------------------------------------------------------------------------------";
                  //---------------------------------------------------------------------------------------------
                  echo "<div class='row'><div class='col-xs-12'>";
                  $consulta= ejecutarSQL::consultar("select * from producto where CodigoCat like 'C2'");
                  $i2 = mysqli_num_rows($consulta);
                  if($i2>0){
                      while($fila=mysqli_fetch_array($consulta)){
                         echo '
                        <div class="col-xs-12 col-sm-6 col-md-3">
                             <div class="thumbnail" type="checkbox">
                               <img src="assets/img-products/'.$fila['Imagen'].'" style="widht:100px; heigth:100px">
                               <div class="caption">
                                 <h3>'.$fila['NombreProd'].'</h3>
                                 <p>'.$fila['Descripcion'].'</p>
                                 <p>$'.$fila['Precio'].'</p>';
                                 $por = $fila['Descuento'] * 100;
                                 echo '<p>El descuento a obtener es del: '.$por.'%</p>                                 
                                 <p class="text-center">
                                     <a href="infoProd.php?CodigoProd='.$fila['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;';
                                      if(!$_SESSION['nombreUser']=="" &&!$_SESSION['claveUser']==""){
                                        echo '<button value="'.$fila['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>';
                                      }                                     
                                    echo '</p>
                               </div>
                             </div>
                         </div>
                         ';
                     }   
                  }else{
                  }  
                  echo "<br><p>-------------------------------------------------------------------------------------";
                  //---------------------------------------------------------------------------------------------
                  echo "<div class='row'><div class='col-xs-12'>";
                  $consulta= ejecutarSQL::consultar("select * from producto where CodigoCat like 'C3'");
                  $i3 = mysqli_num_rows($consulta);
                  if($i3>0){
                      while($fila=mysqli_fetch_array($consulta)){
                         echo '
                        <div class="col-xs-12 col-sm-6 col-md-3">
                             <div class="thumbnail">
                               <img src="assets/img-products/'.$fila['Imagen'].'" style="widht:100px; heigth:100px">
                               <div class="caption">
                                 <h3>'.$fila['NombreProd'].'</h3>
                                 <p>'.$fila['Descripcion'].'</p>
                                 <p>$'.$fila['Precio'].'</p>';
                                 $por = $fila['Descuento'] * 100;
                                 echo '<p>El descuento a obtener es del: '.$por.'%</p>
                                 <p class="text-center">
                                     <a href="infoProd.php?CodigoProd='.$fila['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;';
                                      if(!$_SESSION['nombreUser']=="" &&!$_SESSION['claveUser']==""){
                                        echo '<button value="'.$fila['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>';
                                      }                                     
                                    echo '</p>
                               </div>
                             </div>
                         </div>     
                         ';
                     }   
                  }else{
                  }  
                  echo "<br><p>-------------------------------------------------------------------------------------";
                  //---------------------------------------------------------------------------------------------
                  echo "<div class='row'><div class='col-xs-12'>" ;
                  $consulta= ejecutarSQL::consultar("select * from producto where CodigoCat like 'C4'");
                  $i4 = mysqli_num_rows($consulta);
                  if($i4>0){
                      while($fila=mysqli_fetch_array($consulta)){
                         echo '
                        <div class="col-xs-12 col-sm-6 col-md-3">
                             <div class="thumbnail">
                               <img src="assets/img-products/'.$fila['Imagen'].'" style="widht:100px; heigth:100px">
                               <div class="caption">
                                 <h3>'.$fila['NombreProd'].'</h3>
                                 <p>'.$fila['Descripcion'].'</p>
                                 <p>$'.$fila['Precio'].'</p>';
                                 $por = $fila['Descuento'] * 100;
                                 echo '<p>El descuento a obtener es del: '.$por.'%</p>
                                 <p class="text-center">
                                     <a href="infoProd.php?CodigoProd='.$fila['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;';
                                      if(!$_SESSION['nombreUser']=="" &&!$_SESSION['claveUser']==""){
                                        echo '<button value="'.$fila['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>';
                                      }                                     
                                    echo '</p>
                               </div>
                             </div>
                         </div><br><br><br>     
                         ';
                     }   
                  }else{
                  }  
                  echo "<br><p>-------------------------------------------------------------------------------------"
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