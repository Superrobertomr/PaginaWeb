<!DOCTYPE html>
<html>
<head>
  <title>Confirmar Compra</title>
  <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
<?php include 'inc/navbar.php'; ?>
  <section id="new-prod-index">
    <div class="container text-center">
      <div class="tittles-pages-logo"><h1>Completa tu compra de manera segura<br> <small>Click en el boton y te redireccionaremos a paypal</small></h1></div>
      <div class="row col-sm-12">
        <?php
        //Registra la venta de cualquiera de nuestros servicios en la base de datos para posteriormente redireccionar al cliente a la pagina de pago.
        header('Content-Type: text/html; charset=ISO-8859-1');
        include_once './lib/nusoap.php';
        $cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
        session_start();
        if(isset($_SESSION['nombreUser'])){
          $nameClien = $_SESSION['nombreUser'];
          $passClien = $_SESSION['claveUser'];
          sleep(2);
          $parametros = array('usuario' => $nameClien, 'contrasena' => $passClien);
          $resultado = $cliente->call("iniciarSesion", $parametros);
          if($resultado == true){
            if($_SESSION['sumaTotal'] > 0){
              $StatusV = 0;
              //Insertando datos en tabla Pedido (que viene siendo venta)
              $tablaColumnas = "Pedido(Fecha_Compra, Nombre_Cliente, Estado_Pago, Total_Pagar)";
              $datosInsertar = "".date('Ymd').", '".$nameClien."', ".$StatusV.", '".$_SESSION['sumaTotal']."'";
              $parametros2 = array('tablaColumnas' => $tablaColumnas , 'datosInsertar' => $datosInsertar);
              $resultado2 = $cliente->call("insertarTupla", $parametros2);
              if ($resultado2 == "si") {
                //Busca con el cliente, la última compra que hizo
                $verID = $cliente->call("seleccionarConsulta", array('campos' => '*', 'tabla' => 'Pedido', 'cond' => "WHERE Nombre_Cliente LIKE '".$nameClien."' ORDER BY PedidoID ASC"));
                foreach ($verID as $fila) {
                  $Numpedido = $fila['PedidoID']; //Es el numero de pedido de la ultima compra
                }
                //Insertando datos en detalle de la venta
                $verProd = $cliente->call("seleccionarConsulta", array('campos' => '*', 'tabla' => 'Carrito_Temp', 'cond' => "WHERE Usuario_reg LIKE '".$nameClien."'"));
                foreach ($verProd as $produID) {
                  $totalP = ($produID['Costo_producto'] + ($produID['Costo_producto'] * 0.16));
                  $tablaColumnas2 = "DetallePedido(PedidoID, Nombre_TipoLicencias_Comprado, Nombre_Cliente, Cantidad, Costo)";
                  $datosInsertar2 = "'".$Numpedido."', '".$produID['Nombre_producto']."', '".$nameClien."', ".$produID['Cantidad'].", '".$totalP."'";
                  $parametros3 = array('tablaColumnas' => $tablaColumnas2 , 'datosInsertar' => $datosInsertar2);
                  $resultado3 = $cliente->call("insertarTupla", $parametros3);
                }
              }
              //Aqui solo esta el boton de pagar ahora de PayPal
              echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                      <input type="hidden" name="cmd" value="_xclick">
                      <input type="hidden" name="item_name" value="Compra de articulos en un solo cobro">
                      <input type="hidden" name="business" value="arturo@delcampomorenoyasociados.com">
                      <input type="hidden" name="amount" value="'.$_SESSION['sumaTotal'].'">
                      <input type="hidden" name="currency_code" value="MXN">
                      <input type="hidden" name="return" value="http://192.168.1.68/PaginaWeb/compraSuccessWS.php?Numpedido='.md5($Numpedido).'">
                      <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                      <img alt="" border="0" href="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
                    </form>';
            }else{
              echo'<img src="assets/img/error.png" class="center-all-contens"><br>No ha seleccionado ning&uacuten producto, revisa el carrito de compras';
              echo '<meta http-equiv="Refresh" content="2;url=index.php">';
            }
          }else{
            echo '<img src="assets/img/error.png" class="center-all-contens"><br>No ha seleccionado ning&uacuten producto, revisa el carrito de compras';
            echo '<meta http-equiv="Refresh" content="2;url=index.php">';
          }
        }else{
          echo '<img src="assets/img/error.png" class="center-all-contens"><br>El nombre o contrase&ntildea invalidos<br>';
          echo '<meta http-equiv="Refresh" content="1;url=index.php">';
        }
        ?> 
      </div>
    </div>
  </section>
  <section> 
    <div class="container"> </div>
  </section><?php include './inc/footer.php'; ?>
</body>

</html>
