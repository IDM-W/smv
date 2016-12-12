<?php
  require 'php/conexion.php';
  $con=new Database();
session_start();
$img="";
if (ISSET($_SESSION["email"])) {
      $stmt = $con->prepare("SELECT * FROM usuarios where email=:email" );
      $stmt->bindParam(':email',$_SESSION['email']);
      $stmt->execute();
      while ($row=$stmt->fetch()) {
        $img=$row[6];
      }
    }
  else {
      header('location:http://localhost/AJAX/Dropbox/Proyecto_Empresarial/Proyectos_web/smv/smv');
      }
 ?>

<!DOCTYPE html>
<html>
   <head>

	<title>Se armo el viaje</title>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!--<script src="http://maps.google.com/maps?file=api&amp;v=2&oe=ISO-8859-1;&amp;key=AIzaSyDur_r4IxJEKDAmXLY8bMC3wFS7T5i8t78"
type="text/javascript"></script>-->
	<link rel="stylesheet" type="text/css" href="font_icon/style.css" >
    <link rel="stylesheet" type="text/css" href="user.css">
    <link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src=js/js.js></script>

	<script type="text/javascript" src="js/jquery-2.2.3.min.js">    </script>
  <script type="text/javascript" src="js/ajax.js">
  </script>
   <!-- <script type="text/javascript" src="js/maps/map.js"></script>-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDur_r4IxJEKDAmXLY8bMC3wFS7T5i8t78&v=3.exp&sensor=false&libraries=places"></script>
    <script type="text/javascript">
    function init1() {
        var input = document.getElementById('lds');
        var options = {
              types: ['(cities)'],
          };
        var autocomplete = new google.maps.places.Autocomplete(input, options);

        }
        function init2() {

          var input = document.getElementById('ldl');
         var options = {
               types: ['(cities)'],
           };
         var autocomplete = new google.maps.places.Autocomplete(input, options);
        }
        google.maps.event.addDomListener(window, 'load', init1);
        google.maps.event.addDomListener(window, 'load', init2);
    </script>
   </head>
   <body onload="mostrarv()" ><!--onload="mostrarv()"-->
	   <input id="user_menu" type="checkbox"></input>
       <header role="navegation">
        <nav class="menu">
            <ul>
				<li><a href="inicio.php" id="">Logo</a></li>
				<li><a  id="">Documentación</a></li>
				<li><a  id="">Contactanos</a></li>
				<li><a href="buscar.php" id="">Buscar viaje</a></li>
				<div class="user_my">
				  <!--<li class="no_select"><label class="icon-user fs"  id="login"><a></a></label></li>-->
				  <li class="no_select"><label for="user_menu" id="User"><img id="fope" src="<?php echo $img ?>" alt="" /><a style=""><?php echo $_SESSION['nombre'];
           ?></a></label></li>
				</div>
		    </ul>
        </nav>
      </header>
      <div class="inp" id="menu_user">
	   <center>
	    <form>
		    <center><input  type="button" id="logout" onclick="window.location.href='php/logout.php';" value="Cerrar Sesion"></center>
		</form>
	   </center>
	  </div>
	       <div id="Viajes_p_b">

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
