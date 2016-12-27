<?php
require_once("exephp/embarcar.php");
require_once("saneo.php");
require_once("conexion.php");
session_start();
//echo $_SESSION["email"];*/
$data=$_POST;
$subi=new embarcarme();
//print_r($data) ;
$subi->embarcar($data);

?>
