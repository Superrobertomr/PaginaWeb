<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);
$nitProve= $_POST['prove-nit'];
$nameProve= $_POST['prove-name'];
$dirProve= $_POST['prove-dir'];
$telProve= $_POST['prove-tel'];
$webProve= $_POST['prove-web'];
$claProve= $_POST['admin-pass'];

if(!$nitProve=="" && !$nameProve=="" && !$dirProve=="" && !$telProve=="" && !$webProve=="" && !$claProve==""){
    $pass_cifrado=password_hash($claProve, PASSWORD_DEFAULT, ['cost'=>12]);
    $verificar=  ejecutarSQL::consultar("select * from proveedor where RFCProveedor='".$nitProve."'");
    $verificaltotal = mysqli_num_rows($verificar);
    if($verificaltotal<=0){
        if(consultasSQL::InsertSQL("proveedor", "RFCProveedor, NombreProveedor, Clave, Direccion, Telefono, PaginaWeb", "'$nitProve','$nameProve','$pass_cifrado','$dirProve','$telProve','$webProve'")){
            echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Proveedor añadido éxitosamente</p>';
        }else{
           echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
        }
    }else{
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El número de RFC que ha ingresado ya existe.<br>Por favor ingrese otro número de RFC</p>';
    }
}else {
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
}
echo'<script>
    setTimeout(function(){
    url ="configAdmin.php";
    $(location).attr("href",url);
    },100);
    </script>';
