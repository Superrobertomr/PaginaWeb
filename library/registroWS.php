<?php
include_once './lib/nusoap.php';
require_once './Email/class.phpmailer.php';
require_once './Email/class.smtp.php';
$cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");

$usuario = $_POST['clien-name'];
$contrasena = md5($_POST['clien-pass']);
$correo = $_POST['clien-email'];
$contConf = md5($_POST['clien-pass-confir']);
$resultado1 = $cliente->call("seleccionarConsulta", array('campos' => '*', 'tabla' => 'RegCarrito', 'cond' => "WHERE Usuario_reg LIKE '".$usuario."' LIMIT 1" ));
$verificadorNombre = "";
if ($resultado1) {
	foreach ($resultado1 as $fila) {
		$verificadorNombre = $fila['Usuario_reg'];
	}
}
$resultado2 = $cliente->call("seleccionarConsulta", array('campos' => '*', 'tabla' => 'RegCarrito', 'cond' => "WHERE Correo_electronico LIKE '".$correo."' LIMIT 1" ));
$verificadorCorreo = "";
if ($resultado2) {
	foreach ($resultado2 as $fila) {
		$verificadorCorreo = $fila['Correo_electronico'];
	}
}
//Envio de codigo por correo electrónico para verificar si el correo existe pero ya se registraron los datos
if ($verificadorNombre != $usuario) {
	if($contrasena == $contConf && $verificadorCorreo != $correo){
		$parametros = array('usuario' => $usuario, 'contrasena' => $contrasena, 'correo' => $correo, 'Status'=> 0);
		$resultado = $cliente->call("registrarse", $parametros);
		if ($resultado == "si") {
			echo '<img src="../assets/img/ok.png" class="center-all-contens"><br>El registro se completo con &eacutexito<br>';
			$mail = new PHPMailer();//crear un objeto de tipo PHPMailer.
			$mail->CharSet = "utf-8";//tipo de caracteres permitidos esto es mas que nada para los carácteres de acentos.
			$mail->IsSMTP();//protocolo SMTP.
			$mail->SMTPDebug = 1;
			$mail->SMTPAuth = true;//autentificacion en el SMTP.
			$mail->SMTPSecure = "ssl";//Security Socket layer.
			$mail->Host = "smtp.gmail.com";//servidor SMTP de gmail.
			$mail->Port = 465;//Puerto seguro del servidor SMTP de Gmail.
			$mail->From = $correo;//remitente del correo.
			$mail->AddAddress($correo);//destinatario.
			$mail->Subject = 'Validador de correo';//Asunto del correo eletrónico.
			$mail->Username = "contadorvirtual99@gmail.com";//Correo del que envia el msj en este caso nosotros como empresa.
			$mail->Password = "roberto20171106";//password del correo del que se enviara el msj.
			$mail->IsHTML(true);//Permita a PHPMailer interpretar HTML para la vista del msj  
			$mail->Body = '<body id="container-page-correo">
							  <div class="jumbotron" id="jumbotron-verificacion"> 
								  <h1><span class="tittles-pages-verificacio">GRACIAS POR REGISTRARTE</span> <small style="color: #fff;"></small></h1></div>
								  <section id="reg-info-carta">
								    <div class="container">
								      <div class="text-center"><br></div>
								      <div class="text-center">Tu contador Virtual ON LINE te permite armar paquetes contables enfocados a tus necesidades y a tu presupuesto asi mismo cuenta con servicio de soporte para cualquier duda que le pueda surgir utilizando nuestros de sarrollos o simplemente para informarce de dichos</div><br>
								      <div class="text-left">  <h2>En este link confirmar&aacute; su direcci&oacute;n de correo electr&oacute;nico</h2>
								      <a href="http://192.168.1.68/PaginaWeb/activadorWS.php?email='.md5($correo).'">'.md5($correo).md5($usuario).'</a>
								    </div>
								</div>';
			if($mail->Send()){
				echo 'Se ha enviado un correo de verificacion, por favor revice su correo';
				echo '<script>
			  setTimeout(function(){
			  url = "index.php";
			  $(location).attr("href",url);
			  },100);
				</script>';
			}else{
				echo'el msj no se envio';
			}
		}else{
			echo '<img src="../assets/img/error.png" class="center-all-contens"><br>Algo esta mal<br>';
		}
	}else {
		echo "Error en la verificacion de correo ".$correo;
	}
}else {
	echo "Error en la verificacion de usuario ".$usuario;
}
?>