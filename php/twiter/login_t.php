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
  function registro($var)
  {
    $r= new saneo($var);
    $d=$r->s();
     $sql1=$this->con->prepare('INSERT INTO twiter (id_twiter,email,telefono,nombre) VALUES
     (:idt,:email,:numero,:nombre)');
     $sql1->bindParam(':idt',$_SESSION['tid']);
     $sql1->bindParam(':email',$d[0]);
     $sql1->bindParam(':numero',$d[1]);
     $sql1->bindParam(':nombre',$_SESSION['tn']);
     $sql1->execute();
     if ($sql1) {
       $e=$sql1->rowCount();
       if ($e>0) {
         $sql2=$this->con->prepare('INSERT INTO foto VALUES
           (:idf,:foto)');
           $sql2->bindParam(':idf',$_SESSION['tid']);
           $sql2->bindParam(':foto',$_SESSION['tf']);
           $sql2->execute();
           $_SESSION['img']=$_SESSION['tf'];
           $_SESSION['id']=$_SESSION['tid'];
           $_SESSION['email']=$d[0];
           $_SESSION['telefono']=$d[1];
           $_SESSION['nombre']=$_SESSION['tn'];
           header('location:../../info.php');
           echo 1;
       }
     }
  }

}



 ?>
