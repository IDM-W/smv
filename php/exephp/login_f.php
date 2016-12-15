<?php
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



     $stmt = $this->con->prepare("SELECT * FROM facebook WHERE id_facebook=:id ");

       $stmt->bindParam("id", $r[0],PDO::PARAM_STR);
       $stmt->execute();

       $count=$stmt->rowCount();
    if ($count>0){
         $data=$stmt->fecthAll();
         session_start();
         $_SESSION['email']=$data[0][1];
         $_SESSION['id']=$r[0];
         $_SESSION['nombre']=$r[1];
         $_SESSION['img']=$r[3];
         echo 1;
    }else{

         echo 0;
    }
    }
     catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
       }
   }
}


 ?>
