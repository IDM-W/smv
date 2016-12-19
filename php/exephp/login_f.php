<?php
require_once("../saneo.php");
require_once("../conexion.php");
//require_once("exta_foto.php");
$u=$_POST;
$clase=new login_f();
$r2=$clase->entrar_f($u);
class ext_img{
  public function  ext_update($ext_inser,$id_foto){
      $stmt = $this->con->prepare("UPDATE `foto` SET `r_foto`=:id_foto  WHERE id_foto=:r_foto");

      $stmt->bindParam("r_foto",$ext_inser,PDO::PARAM_STR);
      $tmt->bindParam("id_foto",$id_foto,PDO::PARAM_STR);
      $stmt->execute();
      if(!$stmt){
          $img=selectmg($id_foto);
          return $img;
      }
  }

  public function selectmg($id_foto){
     $stmt = $this->con->prepare("SELECT `r_foto` FROM `foto` WHERE id_foto=:idfoto");
     $tmt->bindParam("idfoto",$id_foto,PDO::PARAM_STR);
     $stmt->execute();
     $data=$stmt->fetchAll();
     return $data[0][0];
  }
}
class login_f extends ext_img{
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
         $data=$stmt->fetchAll();
         session_start();
         $_SESSION['email']=$data[0][1];
         $_SESSION['id']=$r[0];
         $_SESSION['nombre']=$r[1];
         //$_SESSION['img']=$r[3];
         $stmt = $this->con->prepare("UPDATE `foto` SET `r_foto`=:r_foto  WHERE id_foto=:id_foto");
         $stmt->bindParam("r_foto",$r[3]);
         $stmt->bindParam("id_foto",$r[0]);
         $stmt->execute();
         $stmt = $this->con->prepare("SELECT `r_foto` FROM `foto` WHERE id_foto=:idfoto");
         $stmt->bindParam("idfoto",$r[0]);
         $stmt->execute();
         $rels=$stmt->fetchAll();
         $_SESSION['img']=$rels[0][0];
         //$_SESSION['img']= ext_img::ext_update($r[5],$r[0]);
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
