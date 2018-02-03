<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);

$nitOldProveUp=$_POST['nit-prove-old'];
$RFCProveUp=$_POST['RFC-prove'];
$nameProveUp=$_POST['prove-name'];
$dirProveUp=$_POST['prove-dir'];
$telProveUp=$_POST['prove-tel'];
$webProveUp=$_POST['prove-web'];
$claProveUp=md5($_POST['admin-pass']);

if(consultasSQL::UpdateSQL("proveedor", "RFCProveedor='$RFCProveUp',NombreProveedor='$nameProveUp', Clave='$claProveUp',Direccion='$dirProveUp',Telefono='$telProveUp',PaginaWeb='$webProveUp'", "RFCProveedor='$nitOldProveUp'")){
    echo '
    <br>
    <img class="center-all-contens" src="assets/img/Check.png">
    <p><strong>Hecho</strong></p>
    <p class="text-center">
    </p>
    <script>
        setTimeout(function(){
        url ="configAdmin.php";
        $(location).attr("href",url);
        },100);
    </script>
 ';
}else{
    echo '
    <br>
    <img class="center-all-contens" src="assets/img/cancel.png">
    <p><strong>Error</strong></p>
    <p class="text-center">
    </p>
    <script>
        setTimeout(function(){
        url ="configAdmin.php";
        $(location).attr("href",url);
        },100);
    </script>
 ';
}