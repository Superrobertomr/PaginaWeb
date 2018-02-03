<?php
session_start(); 

include '../library/configServer.php';
include '../library/consulSQL.php';
$num = $_POST['clien-number'];
if($num == 'notlog'){
   $nameClien=$_POST['clien-name'];
   $passClienX = ejecutarSQL::consultar("select Clave from cliente where Nickname='".$nameClien."' limit 1");
   $passClien0 = mysqli_fetch_array($passClienX);
   $passClien = $passClien0['Clave'];
   //$passClien =  md5($_POST['clien-pass']); 
}
if($num == 'log'){
   $nameClien=$_POST['clien-name'];
   $passClienX = ejecutarSQL::consultar("select Clave from cliente where Nickname='".$nameClien."' limit 1");
   $passClien0 = mysqli_fetch_array($passClienX);
   $passClien = $passClien0['Clave'];
   //$passClien = md5($_POST['clien-pass']); 
   $_SESSION['productosTotales'];
}
$idProd = 0;
$cantXprod = 0;
sleep(3);
$verdata=  ejecutarSQL::consultar("select * from cliente where Nickname='".$nameClien."' and Clave='".$passClien."'");
$num=  mysqli_num_rows($verdata);
if($num>0){
  if($_SESSION['sumaTotal']>0){


  $data= mysqli_fetch_array($verdata);
  $nitC=$data['RFC'];
  $StatusV="Pendiente";
  
  /*Insertando datos en tabla venta*/
  
  consultasSQL::InsertSQL("venta", "Fecha, RFC, TotalPagar, Estado", "'".date('Y-m-d')."','".$nitC."','".$_SESSION['sumaTotal']."','".$StatusV."'");
  
  /*recuperando el número del pedido actual*/
  $verId=ejecutarSQL::consultar("select * from venta where RFC='$nitC' order by NumPedido desc limit 1");
  while($fila=mysqli_fetch_array($verId)){
     $Numpedido=$fila['NumPedido'];
  }
  
  /*Insertando datos en detalle de la venta*/
  for($i = 0;$i< $_SESSION['contador'];$i++){
    $produ = $_SESSION['producto'][$i];
      consultasSQL::InsertSQL("detalle", "NumPedido, CodigoProd, CantidadProductos", "'$Numpedido', '".$produ."', '1'");

      /*Restando un stock a cada producto seleccionado en el carrito*/
    /*$prodStock=ejecutarSQL::consultar("select * from producto where CodigoProd='".$_SESSION['producto'][$i]."'");
    while($fila = mysqli_fetch_array($prodStock)) {
        $existencias = $fila['Stock'];
        consultasSQL::UpdateSQL("producto", "Stock=('$existencias'-1)", "CodigoProd='".$_SESSION['producto'][$i]."'");
    }*/
  }
  /*for($i = 0;$i< $_SESSION['contador'];$i++){
    $produ = $_SESSION['producto'][$i];
    if ($produ != $idProd) {
      $cantidad = ejecutarSQL::consultar("select * from detalle where CodigoProd = '".$produ."' and NumPedido = '".$Numpedido."'");
      $cantXprod = mysqli_num_rows($cantidad);
      echo $cantXprod;
      $idProd = $produ;
    }
  }*/
    
    /*Vaciando el carrito*/
    unset($_SESSION['producto']);
    unset($_SESSION['contador']);
    
    echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El pedido se ha realizado con éxito';
  }else{
    echo '<img src="assets/img/error.png" class="center-all-contens"><br>No has seleccionado ningún producto, revisa el carrito de compras';
  }

}else{
    echo '<img src="assets/img/error.png" class="center-all-contens"><br>El nombre o contraseña invalidos<br>'.$nameClien.$passClien.'';
}
    echo'<script>
    setTimeout(function(){
    url ="configAdmin.php";
    $(location).attr("href",url);
    },50);
    </script>
    ';


