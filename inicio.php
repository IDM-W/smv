<?php

session_start();
if (ISSET($_SESSION["email"])) {

    }
  else {
      header('location:index.php');
      }
 ?>

<!DOCTYPE html>
<html>
   <head>
    <meta charset="utf-8"></meta>
	<title>Se armo el viaje</title>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDur_r4IxJEKDAmXLY8bMC3wFS7T5i8t78&v=3.exp&sensor=false&libraries=places"></script>
<link rel="stylesheet" href="/css/master.css" media="screen" title="no title" charset="utf-8">

<link rel="stylesheet" type="text/css" href="font_icon/style.css" >
<link rel="stylesheet" type="text/css" href="user.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="js/js.js">  </script>

	<script type="text/javascript" src="js/jquery-2.2.3.min.js">    </script>
  <script type="text/javascript">
  var map = null;
  var directionsDisplay = null;
  var directionsService = null;

  function initial() {

     var myLatlng = new google.maps.LatLng(10.9642, -74.7970);
     var myOptions = {
         zoom: 4,
         center: myLatlng,
         mapTypeId: google.maps.MapTypeId.ROADMAP
     };
     map = new google.maps.Map($("#mapa").get(0), myOptions);
  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsService = new google.maps.DirectionsService();
  }

  function getDirections(s,l){
  var start =$("#"+s).val();
  var end = $("#"+l).val();
  if(!start || !end){
  alert("Lugar de salida o llegada estan vacios");
  return;
  }

  var request = {
         origin: start,
         destination: end,
   travelMode: google.maps.TravelMode.DRIVING,
   unitSystem: google.maps.UnitSystem.METRIC,
         provideRouteAlternatives: true
     };
  directionsService.route(request, function(response, status) {
         if (status == google.maps.DirectionsStatus.OK) {
             directionsDisplay.setMap(map);
             
             directionsDisplay.setDirections(response);
             if (s.id=="ls") {
               publicar();
             }else{
               solicitar();
             }
         } else {
             alert("There is no directions available between these two points");
         }
     });
  }

  //$('#search').on('click', function(){ getDirections(); });

  $(document).ready(function() {
     initial();
  });
  function b(id) {
   var s;
  var l;
  if (id.id=="sl") {
    s="lls";
    l="lll"


  }else{
    s="ls";
    l="ll";

  }
  getDirections(s,l);
  }
  </script>
  <script type="text/javascript" src="js/ajax.js"></script>
  <script type="text/javascript" src="js/maps/map.js"></script>
  <script >
  function init1() {
      var input = document.getElementById('lls');
      var options = {
            types: ['(cities)'],
        };
      var autocomplete = new google.maps.places.Autocomplete(input, options);

      }
      function init2() {

        var input = document.getElementById('lll');
       var options = {
             types: ['(cities)'],
         };
       var autocomplete = new google.maps.places.Autocomplete(input, options);
      }
      function init3() {
          var input = document.getElementById('ls');
          var options = {
                types: ['(cities)'],
            };
          var autocomplete = new google.maps.places.Autocomplete(input, options);

          }
          function init4() {

            var input = document.getElementById('ll');
           var options = {
                 types: ['(cities)'],
             };
           var autocomplete = new google.maps.places.Autocomplete(input, options);
          }
google.maps.event.addDomListener(window, 'load', init1);
google.maps.event.addDomListener(window, 'load', init2);
google.maps.event.addDomListener(window, 'load', init3);
google.maps.event.addDomListener(window, 'load', init4);

  </script>

   </head>
   <body  >
	   <input id="user_menu" type="checkbox"></input>
       <header role="navegation">
        <nav class="menu">
            <ul>
				<li><a  id="">Logo</a></li>
				<li><a id="">Documentación</a></li>
				<li><a  id="">Contactanos</a></li>
				<div class="user_my">
				  <!--<li class="no_select"><label class="icon-user fs"  id="login"><a></a></label></li>-->
				  <li class="no_select"><label for="user_menu" id="User"><label class="icon-user fs"  id="login"></label><a style=""><?php echo $_SESSION['nombre'];
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

	  <center>
	 <div id="pub_soli">
	    <div  id="viaje_arm">

		 <form  action="" data="">
           <input name="salida" type="text" id="ls"  placeholder="lugar de salida">
           <input name="llegada" type="text" id="ll"  placeholder="lugar de llegada">
           <input type="date" id="date" name="name" value="" placeholder="Fecha" onFocus="calendario(this)">
           <input type="time" name="hora" id="hora" placeholder="Hora de salida">
           <input type="number" id="cupo" placeholder="Cantidad de psajeros">
           <input type="text" id="precio" name="name" value="" placeholder="Precio">
           <input type="text" id="marca" name="name" value="" placeholder="Marca">
           <input type="text" id="modelo" name="name" value="" placeholder="Modelo">
           <!--Idioma: <select id="locale" name="locale">
              <option value="es" selected>Castellano</option>
              <option value="en">English</option>
              <option value="fr">French</option>
              <option value="de">German</option>
              <option value="ja">Japanese</option>
            </select>-->
           <button id="pb" type="button"  onclick="b(this),publicar()">Publicar Viaje</button>
		 </form>
		</div>
	    <div  id="solic_arm">
          <input type="text" id="lls" placeholder="lugar de salida" autocomplete="on"><br>
          <input type="text" id="lll" placeholder="lugar de llegada"><br>
          <input type="date" id="ddate" name="name" value="" placeholder="Fecha" onFocus="calendario(this)">
          <br><br>
          <button id="sl" type="button" onclick="b(this)" >Solicitar</button>
		</div>
		<div class="option_">
		  <div id="arm_v" class="arm_v ac_b" onclick="p_v(this)"> <a > ARMAR UN VIAJE</a></div>
		  <div id="arm_s" class="arm_s azul ac_w d_b" onclick="p_v(this)"> <a >SOLICITAR UN VIAJE</a></div>
		</div>
      </div>
      <div  id="viaje_publico" class="muestras">
        <center><div id="mapa">
        </div><br>
        <br>
        <br>
        <br>
        <div id="response"></div>
        </center>

		</div>
   <!-- <div id="viaje_solicitado" class="muestras">
           <center><div id="mapa">
           </div></center>

    </div>-->
	  </center>
      <script type="text/javascript">
	    function p_v(obe){

		  if( obe.id=="arm_v"){
		    obe.setAttribute("class","arm_v azul ac_w");
			document.getElementById("arm_s").setAttribute("class","arm_s ac_b");
			document.getElementById("solic_arm").setAttribute("style","display:none");
			document.getElementById("viaje_arm").setAttribute("style","display:block");
		  }
		  if( obe.id=="arm_s"){
		    obe.setAttribute("class","arm_s azul ac_w");
			document.getElementById("arm_v").setAttribute("class","arm_v ac_b");
			document.getElementById("viaje_arm").setAttribute("style","display:none");
			document.getElementById("solic_arm").setAttribute("style","display:block");
		  }
		}
	  </script>
	  <footer class="pie_pag">
            <center><a>Copyright © 2016-2016</a></center>

	  </footer>
  <script type="text/javascript">

  </script>
   </body>
</html>
