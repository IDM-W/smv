<?php

require_once 'app/start.php';

  if (ISSET($_SESSION["email"])) {
    header('location:inicio.php');
      }
    else {
        }
?>

<!DOCTYPE html>
<html>
   <head>
    <meta charset="utf-8"></meta>
	<title>Se armo el viaje</title>
	<script src="http://maps.google.com/maps?file=api&amp;v=2&oe=ISO-8859-1;&amp;key=AIzaSyDur_r4IxJEKDAmXLY8bMC3wFS7T5i8t78"
type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="font_icon/style.css" >
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src=js/js.js></script>
	<script type="text/javascript" src="js/jquery-2.2.3.min.js">    </script>
  <script type="text/javascript" src="js/ajax.js">
  </script>
    <script type="text/javascript" src="js/maps/map.js"></script>

<script type="text/javascript">
   function lo() {
     document.getElementById('l').style.display="block";
     document.getElementById('r').style.display="none";
   }
   function re() {
     document.getElementById('r').style.display="block";
     document.getElementById('l').style.display="none";
   }
   function auto() {
     // configuramos el control que hemos de utilizar para la busqueda de productos
       $("#txtProducto").autocomplete({
           source: "json.json",
           minLength: 1,
           select: productoSeleccionado,
           focus: productoFoco
       });
   }
  </script>
   </head>
   <body onload="mostrarv()" >
	    <input id="loger" type="checkbox"></input>
		<input id="regis" type="checkbox"></input>
       <header role="navegation">
        <nav class="menu">
            <ul>
        <li><a  id="">Logo</a></li>
				<li><a id="">Documentación</a></li>
				<li><a  id="">Contactanos</a></li>
				<div class="regis_login">
				  <li class="no_select"><label class="icon-user fs"  id="login"><a></a></label></li>
				  <li class="no_select"><label for="regis" id="registrar"><a>Registrate</a></label></li>
				</div>
		    </ul>
        </nav>
      </header>
      <div class="inp" id="logout">
	   <center>
	    <form id="l"  name="l" action="php/login.php" method="post">
		<label>Inicio de sesión</label>
		 <input type="text" placeholder="Usuario" name="us" id="us"></input>
		 <input type="password" placeholder="Contraseña" id="p" name="p"></input>
		 <a href="#" class="fs" onclick="login()"><div  class="icon-user " id="loguearme"><span>Entrar<span></div></a>
		<!-- -->

            <a href="#"><div class="twitter_loging">Con Facebook</div></a>
		  <a href="#"><div class="twitter_loging">con twitter</div></a>
		  <a href="#"><div class="google_loging">Con goolge</div></a>
		</form>
	   </center>
	  </div>
      <div class="inp " id="registro">
	   <center>
	    <form name="r" id="r" action="php/registrar.php" method="post">
		<label>Registrarme</label>
          <input type="text" name="nombre" id="nombre" value="" placeholder="Nombre y Apellidos">
          <input type="text" name="email" id="email" value="" placeholder="E-mail">
          <input type="password" name="contrasena" id="contrasena" value="" placeholder="Clave">
          <input type="password" name="ccon"  id="ccon" value="" placeholder="Confirmar Clave">
          <input type="text" name="telefono" id="telefono" value="" placeholder="Telefono">
          <a href="#"><div id="registrarme" onclick="registro()"><span>Registrarme</span></div>	</a>
		  <div class="facebook_loging">Con facebook</div>
		  <div class="twitter_loging">con twitter</div>
		  <div class="google_loging">Con goolge</div>
		</form>
	   </center>
	  </div>



	       <div id="Viajes_p">
            <a>Buscar viaje</a><br>
	       	<input id="lds" placeholder="Salida" class="search" type="search" /><input id="ldl" placeholder="Llegada" class="search" type="search" /><input id="ivp" class="btn azul cur_p1" type="button" value="Buscar" onclick="buscar(),mapdirec()"/><br>
	       	<br>
		       <a>Viajes populares</a><br>
               <div class="hnm" id="v_populares">
               	
               </div>

	       </div>

	  <footer class="pie_pag">
            <center><a>Copyright © 2016-2016</a></center>

	  </footer>

   </body>
</html>
