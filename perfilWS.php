<!DOCTYPE html>
<html lang="es">
<head>
  <title>Perfil</title>
  <?php include './inc/link.php';
  include_once './library/lib/nusoap.php';
  $cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
  include './inc/navbar.php';?>
</head>
<body  id="container-page-index">
  <section>
    <div class="row">
      <div class="container col-md-12">
        <div class="container text-center col-lg-5">
          <div class="panel panel-info">
            <div class="panel-heading text-center"><i class="fa-2x"></i><h3>Datos del cliente</h3></div>
              <div class="table-responsive">
              <?php
              //Para mostrar los datos de usuario en el menu de perfil.
              $usuario = $_SESSION['nombreUser']; //Aqui se obtiene el usuario del navbar
              if (isset($usuario)) {
                $parametros = array('campos' => '*', 'tabla' => 'RegCarrito', 'cond' => "WHERE Usuario_reg LIKE '".$usuario."'");
                $resultado = $cliente->call("seleccionarConsulta", $parametros);
                foreach ($resultado as $fila) {
                  echo "<div class='container-page-index'>
                          <br><h4><small>Usuario: </small>".$fila['Usuario_reg']."</h4> 
                          <br><h4><small>Correo Eletr&oacute;nico: </small>".$fila['Correo_electronico']."</h4>
                          <br><h4><small>RFC: </small>".$fila['RFC']."</h4>
                          <br><h4><small>Nombre(s): </small>".$fila['Nombre_Cliente']."</h4>
                          <br><h4><small>Apellidos: </small>".$fila['Apellido_Cliente']."</h4>
                          <br><h4><small>Puesto: </small>".$fila['Puesto']."</h4>
                        </div>";
                }
              }else {
                echo "No has iniciado sesi&oacuten";
              }
              ?>
              </div>
          </div>
      </div>
        <div class="container text-center col-lg-7">
          <div class="panel panel-info">
            <div class="panel-heading text-center"><i class="fa-2x"></i><h3>Licencias</h3></div>
              <div class="table-responsive">
              <table class="table table-bord0ered">
                <thead class="">
                  <tr>
                    <th class="text-center">Licencia</th>
                    <th class="text-center">Link</th>
                  </tr>
                </thead>
              <tbody>
              <?php
              //Busca con el cliente, la última compra que hizo
              $verID = $cliente->call("seleccionarConsulta", array('campos' => '*', 'tabla' => 'Pedido', 'cond' => "WHERE Nombre_Cliente LIKE '".$usuario."' AND Estado_Pago = 0 ORDER BY PedidoID DESC"));
              if ($verID) {
                foreach ($verID as $fila) {
                  $Numpedido = $fila['PedidoID']; //Es el numero de pedido de la ultima compra
                  $paramD = array('tabla' => 'DetallePedido', 'cond' => "WHERE PedidoID LIKE '".$Numpedido."' AND Nombre_Cliente LIKE '".$usuario."'");
                  $borrarNoPagadosD = $cliente->call("eliminarTupla", $paramD);
                }
              }
              $param = array('tabla' => 'Pedido', 'cond' => "WHERE Nombre_Cliente LIKE '".$usuario."' AND Estado_Pago = 0");
              $borrarNoPagados = $cliente->call("eliminarTupla", $param);
              // Aqui borre los pedidos no pagados con todo y los productos

              $parametros3 = array('campos' => 'DISTINCT(Nombre_TipoLicencias_Comprado)', 'tabla' => 'DetallePedido', 'cond' => "WHERE Nombre_Cliente LIKE '".$usuario."'");
              $resultado3 = $cliente->call("seleccionarConsulta", $parametros3);
              if ($resultado3) {
                foreach ($resultado3 as $fila3) {
                  echo "<tr>
                          <td><h5 class='text-center'>".$fila3['Nombre_TipoLicencias_Comprado']."</h5></td>
                          <td><a href='http://72.51.41.8/WD150AWP/WD150Awp.exe/CONNECT/Contabilidad'><button class='btn btn-info' type='button'><i class='fa fa-chain'></i>  ".$fila3['Nombre_TipoLicencias_Comprado']."</button></a></td>
                        </tr>";
                }
              }?>
              </tbody>
            </table>
            <?php
            if (!$resultado3) {
              echo "No se ha comprado nada";
            }
            ?>
            </div>
          </div>
        </div>
  </section>

    <div class="panel panel-info">
      <div class="panel-heading text-center"><i class="fa-2x"></i><h3>Pedidos</h3></div>
        <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="">
            <tr>
              <th class="text-center">PedidoID</th>
              <th class="text-center">Fecha Compra</th>
              <th class="text-center">Estado de Pago</th>
              <th class="text-center">Total</th>
              <th class="text-center">Factura</th>
            </tr>
          </thead>
          <tbody>
          <?php
          //Para mostrar los datos de usuario en el menu de perfil.
          $parametros4 = array('campos' => '*', 'tabla' => 'Pedido', 'cond' => "WHERE Nombre_Cliente LIKE '".$usuario."' AND Estado_Pago = 1 ORDER BY PedidoID ASC");
          $resultado4 = $cliente->call("seleccionarConsulta", $parametros4);
          if ($resultado4) {
            foreach ($resultado4 as $fila4) {
              $fecha = date_create($fila4['Fecha_Compra']);
              echo' <tr class="text-center">
                      <td>'.$fila4['PedidoID'].'</td>
                      <td>'.$fecha->format("Y-m-d").'</td>
                      <td>';
                      if ($fila4["Estado_Pago"] == 1) {
                        echo '<input type="checkbox" class="form-check-input" disabled checked>';
                      }
                      echo '</td>
                      <td>$'.number_format($fila4["Total_Pagar"],2).'<br></td>
                      <td>
                        <form action="./library/reporteWS.php" method="POST">
                          <input type="text" name="pid" value="'.$fila4['PedidoID'].'" style="display: none">
                          <input type="image" src="assets/icons/pdf.ico" class="img-responsive">
                        </form>
                      </td>
                    </tr>';                      
            }
          }?>  
          </tbody>
        </table>
        <?php
        if (!$resultado4){
          echo "<hr /><p style='text-align: center'>No se ha comprado nada</p>";
        }
        ?>
        </div>
      </div>
  </section>
</body>
<?php include './inc/footer.php'; ?>
</html>