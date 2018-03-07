<!DOCTYPE html>
<html>
<head>
  <title>Confirmaci&oacuten de la cuenta</title>
  <?php include './inc/link.php'; ?>
</head>
<body>
<?php include 'inc/navbar.php'; ?>
  <section> 
  <div class="text-center" id="tutulo-activar">
    <?php
    //Validacion de sesion activada y cliente en la base de datos para validar que la transaccion economica quedo realizada correctamente en tanto al monto y descripcion como que sea al cliente correcto que se mostrara cuando seamos redireccionado desde paypal a la pagina nuevamente.
    header('Content-Type: text/html; charset=ISO-8859-1');
    include_once './library/lib/nusoap.php';
    $cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
    session_start();
    //Valida si estas inicido en la página

    if(isset($_SESSION['nombreUser'])){
       $nameClien = $_SESSION['nombreUser'];
       $passClien = $_SESSION['claveUser'];
    }
    //Busca si el usuario pertenece a la lista de clientes
    $parametros = array('usuario' => $nameClien, 'contrasena' => $passClien);
    $resultado = $cliente->call("iniciarSesion", $parametros);
    if($resultado == true){
      //Busca con el cliente, la última compra que hizo
      $verID = $cliente->call("seleccionarConsulta", array('campos' => '*', 'tabla' => 'Pedido', 'cond' => "WHERE Nombre_Cliente LIKE '".$nameClien."' ORDER BY PedidoID ASC"));
      foreach ($verID as $fila) {
        $Numpedido = $fila['PedidoID']; //Es el numero de pedido de la ultima compra
      }
      //Cambia a pagado tu última compra realizada
      $tabla = "Pedido";
      $datosUpdate = "Estado_Pago = 1";
      $idCambio = "PedidoID = ".$Numpedido."";
      //Validamos primero si el valor dado es igual a este
      if ($_GET['Numpedido'] == md5($Numpedido)) {
        $parametros2 = array('tabla' => $tabla , 'datosUpdate' => $datosUpdate, 'idCambio' => $idCambio);
        $resultado2 = $cliente->call("modificarTupla", $parametros2);
          if ($resultado2 == "si") {
            echo "<h2><p>Pago Realizado</p><h2>";
            //Si el pago se realiza, se eliminan los productos que se tiene en el carrito, de lo contrario seguiran ahi para volver a pagar
            $tabla = "Carrito_Temp";
            $cond = "WHERE Usuario_reg LIKE '".$nameClien."'";
            $parametros = array('tabla' => $tabla, 'cond' => $cond);
            $resultado = $cliente->call("eliminarTupla", $parametros);
          }else{
            echo "Error en pago";
          }
      }else {
        echo "No es el mismo pedido";
      }
    }else{
      echo 'No has iniciado sesi&oacuten';
    }
    ?>
  </div>
  </section>
  <?php include 'inc/footer.php'; ?>
</body>
</html>