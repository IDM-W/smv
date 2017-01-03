<?php
@session_start();
require '../conexion.php';
require '../saneo.php';
$var=$_POST;
$clase=new logint();
$funcion=$clase->registro($var);
class logint
{

  function __construct()
  {
   $this->con=new Database();
  }
  public function registro($var)
  {
    $r= new saneo($var);
    $d=$r->s();
     $sql=$this->con->prepare('INSERT INTO `twiter`(`id_twiter`, `email`, `telefono`, `nombre`) VALUES (:id,:email,:tele,:nombre)');
     $sql->bindParam(':id',$_SESSION['tid']);
     $sql->bindParam(':email',$d[0]);
     $sql->bindParam(':tele',$d[1]);
     $sql->bindParam(':nombre',$_SESSION['tn']);
     $sql->execute();
       $e=$sql->rowCount();
       echo $d[0];
     if ($e>0) {
       $sql2=$this->con->prepare('INSERT INTO foto VALUES
         (:idf,:foto)');
         $sql2->bindParam(':idf',$_SESSION['tid']);
         $sql2->bindParam(':foto',$_SESSION['tf']);
         $sql2->execute();
         echo $_SESSION['tf'];
     }

  }

}



 ?>
