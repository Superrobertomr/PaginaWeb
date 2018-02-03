<?php
    session_start();
    include '../library/configServer.php';
    include '../library/consulSQL.php';
    sleep(2);
    $nombre=$_POST['nombre-login'];
    $clave=md5($_POST['clave-login']);
    //$radio=$_POST['optionsRadios'];
    if(!$nombre==""&&!$clave==""){
        //verUser=ejecutarSQL::consultar("select * from cliente where Nombre='$nombre' and Clave='$clave'");
        //verAdmin=ejecutarSQL::consultar("select * from administrador where Nombre='$nombre' and Clave='$clave'");
        $isesion1=ejecutarSQL::consultar("select * from cliente where Nickname='$nombre' and Clave='$clave'");
        $i1 = mysqli_num_rows($isesion1);
        if ($i1>0) {
            $_SESSION['nombreUser']=$nombre;
            $_SESSION['claveUser']=$clave;
            echo '<script> location.href="index.php"; </script>';
        }else{
            $isesion2=ejecutarSQL::consultar("select * from proveedor where RFCProveedor='$nombre' and Clave='$clave'");
            $i2 = mysqli_num_rows($isesion2);
            if ($i2>0) {
                $_SESSION['nombreAdmin']=$nombre;
                $_SESSION['claveAdmin']=$clave;
                echo '<script> location.href="index.php" </script>';
            }else{
                echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error campo vacío<br>Intente nuevamente';
            }
        }
    //     if($radio=="option2"){
    //         $AdminC=mysqli_num_rows($verAdmin);
    //         if($AdminC>0){
    //             $_SESSION['nombreAdmin']=$nombre;
    //             $_SESSION['claveAdmin']=$clave;
    //             echo '<script> location.href="index.php"; </script>';
    //         }else{
    //           echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error nombre o contraseña invalido'; 
    //         }
    //     }
    //     if($radio=="option1"){
    //         $UserC=mysqli_num_rows($verUser);
    //         if($UserC>0){
    //             $_SESSION['nombreUser']=$nombre;
    //             $_SESSION['claveUser']=$clave;
    //             echo '<script> location.href="index.php"; </script>';
    //         }else{
    //             echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error nombre o contraseña invalido';
    //         }
    //     }

    // }else{
    //    echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error campo vacío<br>Intente nuevamente';
    }