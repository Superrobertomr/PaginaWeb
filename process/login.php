
<!-- <?php
//     session_start();
//     include '../library/configServer.php';
//     include '../library/consulSQL.php';
//     sleep(2);
//     $nombre=$_POST['nombre-login'];
//     $clave=$_POST['clave-login'];
//     $usuario=0;
//     if(!$nombre==""&&!$clave==""){
//         $pass_cifradra=  ejecutarSQL::consultar("select Clave from cliente where Nickname='$nombre'");
//         $clave1 = "";
//         while($fila=mysqli_fetch_array($pass_cifradra)){
//             $clave1 = $fila['Clave'];
//           }
//           if(password_verify($clave, $clave1)){
//             $usuario= TRUE;
//             }
// if($usuario==TRUE){
//         $isesion1=ejecutarSQL::consultar("select * from cliente where Nickname LIKE '$nombre' and Clave LIKE '$clave1'");
//         echo var_dump($isesion1);
//         $i1 = mysqli_num_rows($isesion1);
//         if ($i1>0) {
//             $_SESSION['nombreUser']=$nombre;
//             $_SESSION['claveUser']=$clave;
//             echo '<script> location.href="index.php"; </script>';
//         }else{
//             $isesion2=ejecutarSQL::consultar("select * from proveedor where RFCProveedor='$nombre' and Clave='$clave1'");
//             $i2 = mysqli_num_rows($isesion2);
//             if ($i2>0) {
//                 $_SESSION['nombreAdmin']=$nombre;
//                 $_SESSION['claveAdmin']=$clave;
//                 echo '<script> location.href="index.php" </script>';
//             }else{
//                 echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error campo vacío<br>Intente nuevamente';
//             }
//         }
//     }
//  }
