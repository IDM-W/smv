<?php
require_once("exephp/subirme.php");
require_once("saneo.php");
require_once("conexion.php");
session_start();
if(!isset($_SESSION["email"])){

}else{
 $data=$_POST;
 $subi=new subirme();
 $subi->subir($data);
}
//echo $_SESSION["email"];


?>
