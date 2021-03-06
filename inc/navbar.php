<?php
session_start(); 
error_reporting(E_PARSE);
if(!isset($_SESSION['contador'])){
  $_SESSION['contador'] = 0;
        echo "<script>
             $(document).ready(function()
             {
                $('#myModaregistro').modal('show');
             });
          </script>";
  }else{
          echo "<script>
             $(document).ready(function()
             {
                $('#myModaregistro').modal('hide');
             });
          </script>";
}
?>
<style>
.dropdown {
  position: relative;
  display: inline-block;
}
</style>
<section id="container-carrito-compras">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div id="carrito-compras-tienda"></div>
      </div><br><br><br><br><br><br><br><br><br>
    <div class="container">
      <div class="col-xs-12 col-sm-6">
        <p class="text-center" style="font-size: 80px;">
        <i class="fa fa-shopping-cart"></i></p>
        <p class="text-center"> 
        <a href="compraPaypal.php" class="btn btn-success btn-block"><i class="fa fa-dollar"></i>   Confirmar pedido</a>
        <a href="process/vaciarCarrito.php" class="btn btn-danger btn-block"><i class="fa fa-trash"></i>   Vaciar carrito</a></p>
      </div>
    </div>
  </div>
</section>
<nav id="navbar-auto-hidden">
<!--=============================================================Menu computadoras y tablets============================================================-->
<!-- El dropdown es para acceder mas facil y rapido a cualquier de detalle de cualquier sistema en cualquier parte de la pagina -->
  <div class="row hidden-xs">
    <div class="col-xs-4">
    <!-- <figure class="logo-navbar"></figure> -->
    <p class="text-navbar tittles-pages-logo"></p>
    </div>
    <div class="col-xs-8">
      <div class="contenedor-tabla pull-right">
        <div class="contenedor-tr">
          <a href="index.php" class="table-cell-td">Inicio</a>
          <div class="table-cell-td dropdown"><!-- En esta parte se hace un dropdown para la pestaña de productos-->
            <a style="color: white; padding-left: 40px;"  data-toggle="dropdown" href="#">Productos</a>
            <div class="dropdown-menu" type="bottom">
              <?php //En esta parte solo es el menu del dropdown, solo se recolecta el sistema que se quiere buscar en la pestaña de productos
              include_once './library/lib/nusoap.php';
              $cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
              $tabla = "Sistemas";
              $cond = "";
              $parametros = array('campos' => '*', 'tabla' => $tabla, 'cond' => $cond );
              $resultado = $cliente->call("seleccionarConsulta", $parametros);
              foreach ($resultado as $fila) {
                  echo'<li><a style="color: black;" href="infoProdWS.php?CodigoProd='.$fila['TipoSistema'].'">'.$fila['TipoSistema'].'</a></li>';
              }
              ?>
            </div>
          </div>
          <?php //En esta parte solo es la validacion de iniciar sesion
          if(!$_SESSION['nombreAdmin'] == ""){
            echo '<a href="conocenos.php" class="table-cell-td">Conocenos</a>
             <a href="configAdmin.php" class="table-cell-td">Administraci&oacuten</a>
             <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-logout">
             <i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreAdmin'].'</a>
             <a href="">
             <a>';
          }else if(!$_SESSION['nombreUser'] == ""){
            echo '<a href="perfilWS.php" class="table-cell-td">Perfil</a>
             <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Ver carrito de compras"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i></a>
             <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-logout"><i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreUser'].'</a>';
          }else{
            echo '<a href="conocenos.php" class="table-cell-td">Conocenos</a>
             <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Ver carrito de compras"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i></a>
             <a href="#" class="table-cell-td" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".modal-login"><i class="fa fa-user"></i>&nbsp;&nbsp;Iniciar Sesi&oacuten</a>
            ';
           }
           ?>
        </div>
      </div>
    </div>
  </div>
<!--=============================================================Mobile menu navbar===================================================================-->
  <div class="row visible-xs">
    <div class="col-xs-12">
      <button class="btn btn-default pull-left button-mobile-menu" id="btn-mobile-menu">
        <i class="fa fa-th-list"></i>&nbsp;&nbsp;Men&uacute
      </button>
      <a href="#" id="button-shopping-cart-xs" class="elements-nav-xs all-elements-tooltip carrito-button-nav" data-toggle="tooltip" data-placement="bottom" title="Ver carrito de compras">
        <i class="fa fa-shopping-cart" aling="center"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
      </a>
      <!--aqui me quede para mañana-->
      <?php
      if(!$_SESSION['nombreAdmin']==""){
        echo '<a href="#"  id="button-login-xs" class="elements-nav-xs" data-toggle="modal" data-target=".modal-logout">
         <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreAdmin'].'</a>';
      }else if(!$_SESSION['nombreUser']==""){
        echo '<a href="#"  id="button-login-xs" class="elements-nav-xs" data-toggle="modal" data-target=".modal-logout">
         <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreUser'].'</a>';
      }else{
        echo '<a href="#" data-toggle="modal" data-target=".modal-login" id="button-login-xs" class="elements-nav-xs">
         <i class="fa fa-user"></i>&nbsp; Iniciar Sesi&oacuten</a>';
      }
      ?>
    </div>
  </div>
</nav>
<!--=================================================================Modal login========================================================================-->
<div class="modal fade modal-login" tabindex="-1" style="overflow-y: hide" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="false" data-keyboard="false
" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="modal-form-login">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center text-primary" id="myModalLabel">Iniciar sesi&oacuten en Contador Virtual</h4>
      </div>
      <form action="library/loginWS.php" method="post" role="form" style="margin: 20px;" class="FormCatElec" data-form="login">
        <div class="form-group">
          <label><span class="glyphicon glyphicon-user"></span>&nbsp;Nombre</label>
          <input type="text" class="form-control" id="nombre-login" name="nombre-login" placeholder="Escribe tu nombre" required=""/>
        </div>
        <div class="form-group">
          <label><span class="glyphicon glyphicon-lock"></span>&nbsp;Contrase&ntildea</label>
          <input type="password" class="form-control" name="clave-login" placeholder="Escribe tu contrase&ntilde;a" required=""/>
<!-- Modal dentro de otro modal en este caso de querer recuperar su contraseña por el boton que lo llamara en el modal de inicio-->
          <!--button aling="right" type="button" class="btn btn-link" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModaRecPass"><h6>Olvidaste la contrase&ntildea</h6></button-->
          <div class="ResFormL" style="width: 100%; text-align: center; margin: 0;"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-block">Iniciar sesi&oacuten</button>
        </div>
        <h6><p class="text-center">Si aun no eres miembro que estas esperando</p></h6>
<!-- Modal dentro de otro modal en este caso es el modal de registro comenzando por el boton que lo llamara en el modal de inicio-->
        <button aling="right" type="button" class="btn btn-link .btn-sm" data-toggle="modal" data-target="#myModaregistro">Registrarse</button>
        </script>
      </form>
    </div>
  </div>
</div>
<!--==================================================================Modal Registro==============================================================-->
<div class="modal fade" id="myModaregistro" data-backdrop="static" data-keyboard="false" role="dialog"  aria-labelledby="mySmallModalLabel" aria-hidden="false">
<style>
  input:valid, text:valid{
    border-color: green;
}
  input:invalid, text:invalid{
    border-color: red;
}
  input: ne
</style>
  <div class="modal-dialog">
<!-- Modal de registro-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center text-primary" id="myModalregistro" style="color:  #28878e">Registrate a Contador Virtual.</h4>
      </div>
      <div class="modal-body" align="text-center">Complete el formulario.</div>
      <div>
        <form action="library/registroWS.php" method="post" role="form" style="margin: 20px;" class="FormCatElec" data-form="registro">
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
          <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese su nombre de usuario." minlength="5" maxlength="20" required name="clien-name" data-toggle="tooltip" data-placement="top" title="Ingrese el nombre del usuario.">
          </div><br>
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-at"></i></div>
          <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese su Email." required name="clien-email" data-toggle="tooltip" data-placement="top" title="Ingrese la direcci&oacute;n de su email." multiple="" maxlength="50">
          </div><br>
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-lock"></i></div>
          <input class="form-control all-elements-tooltip" type="password" placeholder="Introdusca una contrase&ntilde;a." required pattern="[A-Za-z0-9]{5,15}" name="clien-pass" data-toggle="tooltip" data-placement="top" title="Contrase&ntilde;a minima de 5 car&aacute;cteres alternando min&uacute;sculas, may&uacute;sculas y n&uacute;mero.">
          </div><br>
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-lock"></i></div>
          <input class="form-control all-elements-tooltip" type="password" placeholder="Confirme su contrase&ntilde;a." required="[A-Za-z0-9]{5,15}" name="clien-pass-confir" data-toggle="tooltip" data-placement="top" title="Confirme su contrase&ntilde;a que anteriormente ingreso.">
          </div>
          <div class="form-group">
            <div class="ResForm" style="width: 100%; color: #00000; text-align: center; margin: 0;"></div>
        </div>
        <div class="text-center">Al dar click en el bot&oacuten, aceptar&aacute los<a data-toggle="modal" data-backdrop="static" data-keyboard="false" href="#myModal"> T&eacuterminos y Condiciones</a> y <a data-toggle="modal" data-backdrop="static" data-keyboard="false" href="#myModal2"> Aviso de Privacidad de la empresa.</a> el de la empresa.</div><br>
          <div class="form-group" align="right">    
            <p><button type="submit" action="navbar-auto-hidden" class="btn btn-success btn-block"><i class="fa fa-pencil"></i>&nbsp; Registrarse</button></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--============================================================Modal Recuperar Contraseña============================================================-->
<div class="modal fade" id="myModaRecPass" role="dialog">
  <div class="modal-dialog">
<!-- Modal contenido del modal de Recuperar Contrase&ntildea-->
    <div class="modal-content">
      <div class="modal-header" align="text-center">
        <button  type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center text-primary" id="myModalLabel" style="color:  #28878e">Recuperar contrase&ntildea</h4>
      </div>
      <div class="modal-body" align="text-center">Ingrese su correo electr&oacutenico</div>
      <div>
        <form action="process/regclien.php" method="post" role="form" style="margin: 20px;" class="" data-form="registro">
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-at"></i></div>
            <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese su Email" required name="clien-email" data-toggle="tooltip" data-placement="top" title="Ingrese la direcci&oacute;n de su email" maxlength="50" >
          </div><br>
        </form>
<!--Aqui se colocara el reCatchap de google-->
      </div>
      <div class="modal-footer" align="right">
        <p><button type="submit" class="btn btn-success btn-block"><i class="fa fa-pencil"></i>&nbsp; Recuperar Contrase&ntildea</button></p>
      </div>
    </div>
  </div>
</div>
<!--===================================================================Fin de moldales================================================================-->
<div id="mobile-menu-list" class="hidden-sm hidden-md hidden-lg"><br>
  <h3 class="text-center tittles-pages-logo">Contador Virtual</h3>
  <button class="btn btn-default button-mobile-menu" id="button-close-mobile-menu">
    <i class="fa fa-times"></i>
  </button><br><br>
  <ul class="list-unstyled text-center">
    <li><a href="index.php">Inicio</a></li>
    <?php
    if(!$_SESSION['nombreUser'] == ""){
      echo '<li><a href="perfilWS.php">Perfil</a></li>';
    }else{
      echo '<li><a href="conocenos.php">Conocenos</a></li>';
     }
    ?>
    <div class="panel-group" id="accordion"> <!-- Este es otro navbar pero del lado del celular o movil -->
      <div class="panel" style="background-color: transparent;">
        <div class="panel-heading">
          <h4 class="panel-title">
            <li><a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="color: white;">Productos</a></li>
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
          <div class="panel-body">
            <?php //Igual, aqui solo se agarra el nombre del sistema para el menu del dropdown
            include_once './library/lib/nusoap.php';
            $cliente = new nusoap_client("http://servidor/Roberto/WebService/servicio.php?wsdl");
            $tabla = "Sistemas";
            $cond = "";
            $parametros = array('campos' => '*', 'tabla' => $tabla, 'cond' => $cond );
            $resultado = $cliente->call("seleccionarConsulta", $parametros);
            foreach ($resultado as $fila) {
              echo'<li><a style="text-align: left; color: white;" href="infoProdWS.php?CodigoProd='.$fila['TipoSistema'].'">'.$fila['TipoSistema'].'</a></li>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
      <?php 
      if(!$_SESSION['nombreAdmin']==""){
        echo '<li><a href="configAdmin.php">Administraci&oacuten</a></li>';
      }
      ?>
  </ul>
</div>
<!-- Modal carrito -->
<div class="modal fade modal-carrito" style="overflow-y: scroll" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content"><br>
      <p class="text-center"><i class="fa fa-shopping-cart fa-5x"></i></p>
      <p class="text-center">El producto se a&ntildeadio al carrito</p>
      <p class="text-center"><button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button></p>
    </div>
  </div>
</div>
<!-- Fin Modal carrito -->
<!-- Modal logout -->
<div class="modal fade modal-logout" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="overflow-y: scroll"  data-backdrop="hidden" data-keyboard="true" aria-hidden="true" style="padding: 20px;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content"><br>
      <p class="text-center"> &#191;Quieres cerrar la sesi&oacuten?</p>
      <p class="text-center"><i class="fa fa-exclamation-triangle fa-5x"></i></p>
      <p class="text-center">
        <a href="process/logout.php" class="btn btn-primary btn-sm">Cerrar la sesi&oacuten</a>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
      </p>
    </div>
  </div>
</div>
<!-- Fin Modal logout -->