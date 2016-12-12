<?php
session_start();
require 'conexion.php';
$con=new Database();
if (isset($_FILES["foto"]))
{
    $file = $_FILES["foto"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "img/";
    $carpeta2="php/img/";

    $src = $carpeta.$nombre;
    $src2=$carpeta2.$nombre;
    move_uploaded_file($ruta_provisional, $src);
      $stmt = $con->prepare("UPDATE usuarios SET fope=:ruta WHERE email=:email");
      $stmt->bindParam("ruta", $src2);
      $stmt->bindParam("email", $_SESSION["email"]);
      $stmt->execute();

        echo $src2;

}else{
  print_r( $_FILES);
}

 ?>
