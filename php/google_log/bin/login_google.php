<?php

  class login{

    private  $user;
    private  $pas;
    private  $dato;
    //conectamos a la bas de datos
     public  function __construct(){
        $this->con = new Database();
        $this->user;
        $this->pas;
      }
      public function start_login($data,$sql){
        $saneo=new saneo($data);
        $d=$saneo->s();
        try{
           $stmt = $this->con->prepare($sql);
           $stmt->bindParam(":id", $d[1]);
           $stmt->bindParam(":email", $d[2]);
           $stmt->execute();
           $count=$stmt->rowCount();
        if ($count>0){
             $data=$stmt->fetchAll();

             //$_SESSION['img']=$r[3];
             $stmt = $this->con->prepare("UPDATE `foto` SET `r_foto`=:r_foto  WHERE id_foto=:id_foto");
             $stmt->bindParam("r_foto",$d[0]);
             $stmt->bindParam("id_foto",$d[1]);
             $stmt->execute();
             $stmt = $this->con->prepare("SELECT `r_foto` FROM `foto` WHERE id_foto=:idfoto");
             $stmt->bindParam("idfoto",$d[1]);
             $stmt->execute();
             $rels=$stmt->fetchAll();
             //$_SESSION['img']= ext_img::ext_update($r[5],$r[0]);
             unset($_SESSION["presesion"]);
             $_SESSION['email']=$d[2];
             $_SESSION['id']=$d[1];
             $_SESSION['nombre']=$d[3];
             $_SESSION['img']=$rels[0][0];
             $_SESSION["telefono"]=$data[0][2];
             //header('Location:http://localhost/smv/inicio.php');
             print_r($_SESSION);
        }else{

             $_SESSION["presesion"]=$data;
             //echo $_SESSION["presesion"];
             //header("Location:http://localhost/smv/info.php");
             echo false;
        }
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
      }

      public function insert_user($data,$sql){
        $saneo=new saneo($data);
        $d=$saneo->s();
        try{
           $stmt = $this->con->prepare("SELECT * FROM google WHERE id_google=:id ");
           $stmt->bindParam("id", $d[0]);
           $stmt->execute();
           $count=$stmt->rowCount();
        if ($count>0){
             //$_SESSION['img']= ext_img::ext_update($r[5],$r[0]);
             echo true;
        }else{
             $stmt = $this->con->prepare($sql);
             //echo $_SESSION["presesion"];
             //header("Location:http://localhost/smv/info.php");
             $stmt->bindParam(":id", $d[1]);
             $stmt->bindParam(":email", $d[2]);
             $stmt->bindParam(":telefono", $d[4]);
             $stmt->bindParam(":nombre", $d[3]);
             $stmt->execute();
             $stmt = $this->con->prepare("INSERT INTO `foto` VALUES (:id_foto,:r_foto)");
             $stmt->bindParam(":r_foto",$d[0]);
             $stmt->bindParam(":id_foto",$d[1]);
             $stmt->execute();
             $stmt = $this->con->prepare("SELECT `r_foto` FROM `foto` WHERE id_foto=:id");
             $stmt->bindParam(":id",$d[1]);
             $stmt->execute();
             $img=$stmt->fetchAll();
            // $data=$stmt->fetchAll();
             //$_SESSION["presesion"]=$data;
             $_SESSION["img"]=$img[0][0];
             $_SESSION["id"]=$d[1];
             $_SESSION["email"]=$d[2];
             $_SESSION["nombre"]=$d[3];
             $_SESSION["telefono"]=$d[4];
             //unset($_SESSION["presesion"]);
             print_r($_SESSION);
        }
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
      }
  }

?>
