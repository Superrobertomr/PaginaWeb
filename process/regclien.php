<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(3);
$rfcCliente= $_POST['clien-rfc'];
$nameCliente= $_POST['clien-name'];
$fullnameCliente= $_POST['clien-fullname'];
$apeCliente= $_POST['clien-lastname'];
$passCliente= md5($_POST['clien-pass']);
$dirCliente= $_POST['clien-dir'];
$phoneCliente= $_POST['clien-phone'];
$emailCliente= $_POST['clien-email'];

$pass_cifrado=password_hash($passCliente, PASSWORD_DEFAULT, array("$cost"=>12));

if(!$rfcCliente=="" && !$nameCliente=="" && !$apeCliente=="" && !$dirCliente=="" && !$phoneCliente=="" && !$emailCliente=="" && !$fullnameCliente==""){
            $verificar=  ejecutarSQL::consultar("select * from cliente where RFC='".$rfcCliente."'");
            $verificaltotal = mysqli_num_rows($verificar);
    if($verificaltotal<=0){
        if(consultasSQL::InsertSQL("cliente", "RFC, Nickname, NombreCompleto, Apellido, Direccion, Clave, Telefono, Email", "'".$rfcCliente."','$nameCliente','$fullnameCliente','$apeCliente','$dirCliente', '$pass_cifrado','$phoneCliente','$emailCliente'")){
            echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El registro se completo con éxito';
        }else{
           echo '<img src="assets/img/error.png" class="center-all-contens"><br>Ha ocurrido un error.<br>Por favor intente nuevamente'; 
        }
    }else{
        echo '<img src="assets/img/error.png" class="center-all-contens"><br>El RFC que ha ingresado ya esta registrado.<br>Por favor ingrese otro número de RFC';
    }
}else {
    echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error los campos no deben de estar vacíos';
}


echo "<script>
        setTimeout(function(){
        url ='registration.php';
        $(location).attr('href',url);
        },100);
    </script>";