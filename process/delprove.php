<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);
$nitProve= $_POST['nit-prove'];
$cons=  ejecutarSQL::consultar("select * from proveedor where RFCProveedor='$nitProve'");
$totalprove = mysqli_num_rows($cons);

if($totalprove>0){
    if(consultasSQL::DeleteSQL('proveedor', "RFCProveedor='".$nitProve."'")){
        echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Proveedor eliminado éxitosamente</p>';
    }else{
       echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
    }
}else{
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código de proveedor no existe</p>';
}
echo'<script>
setTimeout(function(){
url ="configAdmin.php";
$(location).attr("href",url);
},100);
</script>
';