<?php 
require_once("exephp/subirme.php");
require_once("saneo.php");
require_once("conexion.php");
session_start();
//echo $_SESSION["email"];*/
$data=$_POST;
$subi=new subirme();
$subi->subir($data);

?>