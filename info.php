<?php
  session_start();
  $disable="";
  if(isset($_SESSION["presesion"])){
    $disable='style="display:none;"';
    $script="<script> document.getElementById('en').setAttribute('onclick','inset_tel()')</script>";
  }
  session_start();
  if (ISSET($_SESSION["email"])) {
    header('Location:http://localhost/smv/inicio.php');
  }else {
  }  
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Se Armo el Viaje</title>
    	<link rel="stylesheet" type="text/css" href="style.css">
      <script type="text/javascript" src="js/sdk_js/fa.js">
      </script>
      <script type="text/javascript" src="js/enviar.js"></script>
      <script type="text/javascript" src="js/jquery-2.2.3.min.js">    </script>
       <script type="text/javascript" src="js/google_login/tel.js"></script>
  </head>

  <body>
    <header role="navegation">
     <nav class="menu">
         <ul>
     <center><a  id="">Registro</a></center>
     </ul>
     </nav>
   </header>
   <div id="lf">
     <input  <?php echo $disable; ?> type="text" placeholder="Correo" id="email">
     <input type="text" placeholder="Telefono" id="tele">
    <input type="button"id="en" value="Enviar" onclick="agr()">
   </div>
   <?php echo $script ?>
  </body>
</html>
