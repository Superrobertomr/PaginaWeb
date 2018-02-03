<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);

$codeOldProdUp=$_POST['code-old-prod'];
$codeProdUp=$_POST['code-prod'];
$nameProdUp=$_POST['prod-name'];
$catProdUp=$_POST['prod-category'];
$priceProdUp=$_POST['price-prod'];
$descProdUp=$_POST['prod-desc'];
$descuProdUp=$_POST['prod-descu'];
$IVA__ProdUp=$_POST['prod-iva'];
$proveProdUp=$_POST['prod-Prove'];

if(consultasSQL::UpdateSQL("producto", "CodigoProd='$codeProdUp',NombreProd='$nameProdUp',CodigoCat='$catProdUp',Precio='$priceProdUp',Descripcion='$descProdUp', Descuento='$descuProdUp',IVA='$IVA__ProdUp',RFCProveedor='$proveProdUp'", "CodigoProd='$codeOldProdUp'")){
    echo '
    <br>
    <img class="center-all-contens" src="assets/img/Check.png">
    <p><strong>Hecho</strong></p>
    <p class="text-center">
    </p>';
}else{
    echo '
    <br>
    <img class="center-all-contens" src="assets/img/cancel.png">
    <p><strong>Error</strong></p>
    <p class="text-center">
    </p> ';
}
echo'<script>
    setTimeout(function(){
    url ="configAdmin.php";
    $(location).attr("href",url);
    },100);
    </script>';