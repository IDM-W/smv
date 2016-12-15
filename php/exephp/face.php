<?php
session_start();
require_once("../saneo.php");
require_once("../conexion.php");
$u=$_POST;
$clase=new login_f();
 $r2=$clase->entrar_f($u);


class login_f
{
private  $user;
private  $pas;
//conectamos a la bas de datos
 public  function __construct()
  {
    $this->con = new Database();
    $this->user;
    $this->pas;
  }
  //aqui sanetizamos los campos de logi

  //aqui hacemos la consulta al bd
  public function entrar_f($p)
  {
     $saneo=new saneo($p);
     $r=$saneo->s();
    try{
        $query = $this->con->prepare('INSERT INTO facebook  values (:id,:email,:telefono,:nombre)');
         $query->bindParam(':id',$r[0]);
         $query->bindParam(':email',$r[1]);
         $query->bindParam(':telefono',$r[2]);
         $query->bindParam(':nombre',$r[4]);
         $query->execute();
         if ($query) {


             $_SESSION['email']=$r[1];
             $_SESSION['telefono']=$r[2];
             $_SESSION['nombre']=$r[3];
             $_SESSION['img']=$r[5];
            echo 1;
         }else {
           echo 0;
         }

    }catch(PDOException $e) {
       echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
    }

   }



 ?>
