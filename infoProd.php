<?php
include './library/configServer.php';
include './library/consulSQL.php';
?>
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
                    $CodigoProducto=$_GET['CodigoProd'];
                    $productoinfo=  ejecutarSQL::consultar("select * from producto where CodigoProd='".$CodigoProducto."'");
                    while($fila=mysqli_fetch_array($productoinfo)){
                        echo '
                            <div class="col-xs-12 col-sm-6">
                                <h2 class="text-center">Información de producto</h2>
                                <br><br>
                                <h3><strong>Nombre: </strong>'.$fila['NombreProd'].'</h3><br>
                                <h4><strong>Descripción: </strong>'.$fila['Descripcion'].'</h4><br>
                                <h4><strong>Precio: </strong>$'.$fila['Precio'].'</h4><br>';
                               $por = $fila['Descuento'] * 100;
                                $ventaLic = $fila['Precio'].  'cantidad_lic';
                               echo '<p>El descuento a obtener es del: <h3>'.$por.'%<h3></p>';
                               echo '<p>Precio <h3>'.$ventaLic.'<h3></p>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <br><br><br>
                                <img class="img-responsive" src="assets/img-products/'.$fila['Imagen'].'">
                            </div>
                            <br><br><br><br>
                            <div class="col-xs-12 text-center">
                                <select class="form-control" required name="cantidad_lic" style="width: 150px">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option></select>
                                <a href="product.php" class="btn btn-lg btn-primary"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Regresar a la tienda</a> &nbsp;&nbsp;&nbsp; 
                                <button value="'.$fila['CodigoProd'].'" class="btn btn-lg btn-success botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; Añadir al carrito</button>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>