<?php
require_once("../saneo.php");
require_once("../conexion.php");
require_once("bin/login_google.php");
session_start();
//echo $_SESSION["email"];*/
if(isset($_SESSION["presesion"])){
    $sql="INSERT INTO `google`(`id_google`, `gmail_google`, `telefono`, `nombre`) VALUES (:id,:email,:telefono,:nombre)";
    $tel=$_POST;
    $data=$_SESSION["presesion"];
    array_push($data,$tel["telefono"]);
    $c_login=new login();
    $c_login->insert_user($data,$sql);
    //print_r($data);
}else{
  $sql="SELECT * FROM google WHERE id_google=:id and gmail_google=:email";
  $data=$_POST;
  $c_login=new login();
  $c_login->start_login($data,$sql);
}

?>
