<?php
  /*require_once __DIR__.'/php/google/vendor/autoload.php';
  require_once __DIR__.'/php/google/bin/clases/google_auth.php';
  require_once __DIR__.'/php/google/bin/init.php';



  $googleClient = new Google_Client();
  $auth = new GoogleAuth($googleClient);

  if($auth->checkRedirectCode()){
      //die($_GET['code']);
      header('Location:htt://localhost/smv/index.php');
  }*/
  require_once('php/twitteroauth/OAuth.php');
require_once('php/twitteroauth/twitteroauth.php');
require_once('php/conexion.php');
define('CONSUMER_KEY', 'TDIa1K09apRML1Px8IrwSGbBU');
define('CONSUMER_SECRET', 'vKAjm1c1f9nuEIOdsBFab3CTRIussZkgcSGiTGgY6y6DU8MBbJ');
define('OAUTH_CALLBACK', 'http://localhost/smv');
    session_start();
    if (ISSET($_SESSION["email"])) {
      header('Location:http://localhost/smv/inicio.php');
    }else {
    }
?>

<!DOCTYPE html>
<html>
   <head>

	<title>Se armo el viaje</title>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


          <!--<script type="text/javascript" src="js/maps/map.js"></script>-->
          <script type="text/javascript" src="js/sdk_js/sdk.js"></script>
          <script type="text/javascript" src="js/ajax.js"></script>
        	<link rel="stylesheet" type="text/css" href="font_icon/style.css" >
        	<link rel="stylesheet" type="text/css" href="style.css">



   </head>
   <body onload="mostrarv()" >

	    <!--<input id="loger" type="chec>>>>>>> 4462b9f0b9a81ac9c4c9c1d072304dab84123c8ckbox"></input>-->
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
      <a href="#" onclick="initfa()"><div class="twitter_loging">Con Facebook</div></a>
      <?php
if(isset($_GET['logout'])){
	session_unset();
	$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}
if(!isset($_SESSION['data']) && !isset($_GET['oauth_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
	if($request_token){
		$token = $request_token['oauth_token'];
		$_SESSION['request_token'] = $token ;
		$_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
		$login_url = $connection->getAuthorizeURL($token);
	}
}
if(isset($_GET['oauth_token'])){
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($access_token){
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$params =array('include_entities'=>'false');
		$data = $connection->get('account/verify_credentials',$params);
		if($data){
			$_SESSION['data']=$data;
      $_SESSION['v']=$data;
			$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  			header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		}
	}
}
if(isset($login_url) && !isset($_SESSION['data'])){
	echo "<a id='hh' href='$login_url'><div class='twitter_loging'>Con twitter</div></a>";
 ?>
      <a  id="login_google"><div class="google_loging">Con goolge</div></a>
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
		  <div class="facebook_loging" onclick="initfa();">Con f facebook</div><?php
      	echo "<a id='hh' href='$login_url'><div class='twitter_loging'>Con twitter</div></a>"; } else{
  $data = $_SESSION['data'];
	$_SESSION['tn']=$data->name;
	$_SESSION['tf']=$data->profile_image_url;
  $_SESSION['tid']=$data->id;

                $con=new Database();

  $stmt = $con->prepare("SELECT id_twiter FROM twitter WHERE id_twiter=:id" );
  $stmt->bindParam(":id", $_SESSION['tid']);
  $stmt->execute();

   $row_cnt = mysqli_num_rows($stmt);
     if ($row_cnt==0) {
       unset($_SESSION['data']);
       header('location:info.php');
     }else{
       $c=$stmt->fetchAll();
       $_SESSION['id']=$c[0][1];
       header('location:inicio.php');
     }



}?>
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

    <div id="notificaciones">
         <center><p id="noti"></p></center>
    </div>
    <script type="text/javascript" src=js/js.js></script>
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>


    <!-- <script type="text/javascript" src="js/maps/map.js"></script>-->
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDur_r4IxJEKDAmXLY8bMC3wFS7T5i8t78&v=3.exp&libraries=places"></script>


          <script type="text/javascript">
          function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail());
          }
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

      <script src="https://apis.google.com/js/api:client.js"></script>
      <script type="text/javascript" src="js/enviar.js"></script>
      <script type="text/javascript" src="js/google_login/login_g.js"></script>


   </body>
</html>
