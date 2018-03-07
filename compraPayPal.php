<!DOCTYPE html>
<html lang="es">
<head>
  <title>Actualizar</title>
  <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index" >
<section> 
<?php
header('Content-Type: text/html; charset=ISO-8859-1');
include_once './process/lib/nusoap.php';
$cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
session_start();
/*Esto va a ser una explicacion en general
Primeramente, por la sesion iniciada buscara que se tiene guardado por el usuario
Despues se pregunta si saliio null o  si esta en default los datos que se sacaron de la bd
Si entra a esa comprobacion y tienes algo en default, te pedira que llenes un formulario para esos datos, y al finalizar, se redireccionara a esta misma pantalla
Para finalizar, habra un if que preguntara si hay datos pendientes de obtener (el formulario estaba en POST, asi que pregunta si hay datos POST)
si es asi, solo los registra y ya se redirecciona a confirmCompra*/
if(isset($_SESSION['nombreUser'])){
  $parametros = array('campos' => '*', 'tabla' => 'RegCarrito', 'cond' => "WHERE Usuario_reg LIKE '".$_SESSION["nombreUser"]."'");
  $resultado = $cliente->call("seleccionarConsulta", $parametros);
  if ($resultado) {
    foreach ($resultado as $fila) {
      $rfcB = $fila['RFC'];
      $NombreB = $fila['Nombre_Cliente'];
      $ApellidoB = $fila['Apellido_Cliente'];
      $PuestoB = $fila['Puesto'];
    }
  }

  if (isset($_POST['rfc']) && isset($_POST['nom']) && isset($_POST['ape']) && isset($_POST['puesto'])){
    $rfcR = $_POST['rfc'];
    $NombreR = $_POST['nom'];
    $ApellidoR = $_POST['ape'];
    $PuestoR = $_POST['puesto'];
    $tabla = "RegCarrito";
    $datosUpdate = "RFC = '".$rfcR."', Nombre_Cliente = '".$NombreR."', Apellido_Cliente = '".$ApellidoR."', Puesto = '".$PuestoR."'";
    $idCambio = "Usuario_reg LIKE '".$_SESSION['nombreUser']."'";
    $parametros2 = array('tabla' => $tabla , 'datosUpdate' => $datosUpdate , 'idCambio' => $idCambio);
    $resultado2 = $cliente->call("modificarTupla", $parametros2);
    if ($resultado2 == "si") {
      echo '<script>
        setTimeout(function(){
        url = "confirmCompra.php";
        $(location).attr("href",url);
        },100);
        </script>';
      }

    }elseif ($rfcB == "-" || $NombreB == "-" || $ApellidoB == "-" || $PuestoB == "-"){
      echo '<div class="container">
      <div class="panel">
      <div class="text-center">
            <h2 class="tittles-pages-logo">Terminar pago</h2>
            <a style="color: #000000"><h4>Por favor, llene los siguientes datos con los datos de la persona que se encargara del uso de la licencia<h4></a>
            <div class="container-page-index">
            <form action="#" method="post" role="form" style="margin: 20px;" class="FormCatElec" data-form="registro">
              <div class="input-group">
                <div class="input-group-addon" style="size:24px"><i class="fa fa-key"></i></div>
                <input class="form-control all-elements-tooltip" style="text-transform:uppercase;" type="text" placeholder="Ingrese su RFC" required name="rfc" data-toggle="tooltip" data-placement="top" title="Ingrese su RFC" maxlength="13" pattern="[a-zA-Z0-9_-]{12,13}">
              </div><br>
              <div class="input-group">
                <div class="input-group-addon" style="size:24px"><i class="fa fa-drivers-license-o"></i></div>
                <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese el nombre del encargado" required name="nom" data-toggle="tooltip" data-placement="top" title="Ingrese el nombre de la persona encargada.">
              </div><br>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-drivers-license"></i></div>
                <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese los apellidos del encargado" required name="ape" data-toggle="tooltip" data-placement="top" title="Ingrese los apellidos de la persona encargado">
              </div><br>
              <div class="input-group">
                <div class="input-group-addon"><i class=" fa fa-folder-o"></i></div>
                <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese su puesto" required name="puesto" data-toggle="tooltip" data-placement="top" title="Ingrese su puesto de la persona encargada">
              </div><br>
              <div class="form-group" align="right">
                <p><button href="confirmCompra.php" type="submit" action="navbar-auto-hidden" class="btn btn-success btn-block"><i class="fa fa-cc-paypal"style="font-size:48px;"></i>&nbsp; </button></p>
                <div class="ResForm" style="width: 100%; color: #00000; text-align: center; margin: 0;"></div>
              </div>
            </form>
            </div>
            </div>
            </div>';
  }elseif ($rfcB != "-" && $NombreB != "-" && $ApellidoB != "-" && $PuestoB != "-") {
    echo '<script>
      setTimeout(function(){
      url = "confirmCompra.php";
      $(location).attr("href",url);
      },100);
      </script>';
  }

}elseif (!isset($_SESSION['nombreUser'])) {
  echo '<script>
    setTimeout(function(){
    url = "index.php";
    $(location).attr("href",url);
    },100);
    </script>';
}
?>
</section>
</body>
</html>
<!--SERVICIOs INTERNACIONALES DEL NOROESTE S.A de C.V    LO QUE VA DEL AÑ<O-->
    