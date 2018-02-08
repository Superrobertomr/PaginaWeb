
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Productos</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-product">
    <?php include './inc/navbar.php'; ?>
    <section id="store">
<        <br>
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
               <!-- ==================== Fin lista categorias =============== -->
                         </ul>
                      </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade" id="all-product" aria-labelledby="all-product-tab">
                          <br><br>
                        <div class="row">
<?php
include_once './library/lib/nusoap.php';
include './library/mostrarWS.php';
?>
                        </div>
                      </div><!-- Fin del contenedor de todos los productos -->
                       
                      <!-- ==================== Contenedores de categorias =============== -->
                       <?php
                        $consultar_categorias= ejecutarSQL::consultar("select * from categoria");
                        while($categ=mysqli_fetch_array($consultar_categorias)){
                            echo '<div role="tabpanel" class="tab-pane fade active in" id="'.$categ['CodigoCat'].'" aria-labelledby="'.$categ['CodigoCat'].'-tab"><br>';
                                $consultar_productos= ejecutarSQL::consultar("select * from producto where CodigoCat='".$categ['CodigoCat']."'");
                                $totalprod = mysqli_num_rows($consultar_productos);
                                if($totalprod>0){
                                   while($prod=mysqli_fetch_array($consultar_productos)){
                                      echo '
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                             <div class="thumbnail">
                                               <img src="assets/img-products/'.$prod['Imagen'].'">
                                               <div class="caption">
                                                 <h3>'.$prod['NombreProd'].'</h3>
                                                 <p>'.$prod['Descripcion'].'</p>
                                                 <p>$'.$prod['Precio'].'</p><br>';
                                                 $por = $fila['Descuento'] * 100;
                                                 echo '<p>El descuento a obtener es del: '.$por.'%</p>
                                                 <p class="text-center">
                                                     <a href="infoProd.php?CodigoProd='.$prod['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;';
                                                    if(!$_SESSION['nombreUser']=="" &&!$_SESSION['claveUser']==""){
                                                     echo '<button value="'.$fila['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>';
                                                   }
                                                 echo '</p>

                                               </div>
                                             </div>
                                         </div>     
                                         ';    
                                   } 
                                } else {
                                   echo '<h2>No hay productos en esta categoría</h2>'; 
                                }
                            echo '</div>'; 
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




