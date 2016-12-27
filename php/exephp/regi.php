<?php
require '../conexion.php';
require '../saneo.php';
$re=$_POST;
$clase=new  verificar();
$f=$clase->verficar_correo($re);

class verificar
{
private  $user;

//conectamos a la bas de datos
 public  function __construct()
  {
    $this->con = new Database();

  }
  //aqui sanetizamos los campos de logi

  //aqui hacemos la consulta al bd
  public function verficar_correo($p)
  {
     $saneo=new saneo($p);
     $r=$saneo->s();
    try{

     $stmt = $this->con->prepare("SELECT * FROM usuarios WHERE email=:usernameEmail  ");

       $stmt->bindParam("usernameEmail", $r[0],PDO::PARAM_STR);
       $stmt->execute();

       $count=$stmt->rowCount();
        if ($count==1){
          echo 0;
        }else{
          echo 1;
        }
    }
     catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
       }
   }
}

 ?>
