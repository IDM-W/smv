<?php

require_once("../saneo.php");
require_once("../conexion.php");

$u=$_POST;
$clase=new login_f();

$r2=$clase->entrar_f($u);
class login_f{
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
            // $ext_img=$clase->ext_insert($r[3],$r[0]);
             $query = $this->con->prepare('INSERT INTO `foto`(`id_foto`, `r_foto`) VALUES (:id_foto,:r_foto)');
             $query->bindParam(':id_foto',$r[0]);
             $query->bindParam(':r_foto',$r[5]);
             $query->execute();
             $query = $this->con->prepare("SELECT `r_foto` FROM `foto` WHERE id_foto=:idfoto");
             $query->bindParam("idfoto",$r[0]);
             $query->execute();
             $data=$query->fetchAll();
               session_start();
             $_SESSION['img']=$data[0][0];
             $_SESSION['id']=$r[0];
             $_SESSION['email']=$r[1];
             $_SESSION['telefono']=$r[2];
             $_SESSION['nombre']=$r[3];
             $_SESSION['facebook']="face";
             //$_SESSION['img']= ext_img:: ext_insert($r[5],$r[0]);
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
