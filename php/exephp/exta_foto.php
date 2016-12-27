<?php
class crudimg{

  private  $user;
  private  $pas;
  private  $dato;
  //conectamos a la bas de datos
   public  function __construct($data){
      $this->con = new Database();
      $saneo=new saneo($data);
      $this->d=$saneo->s();
    }
    public function exit_img(){
      try{
         $stmt = $this->con->prepare("SELECT `r_foto` FROM `foto` WHERE id_foto=:id");
         $stmt->bindParam(":id", $this->d[1]);
         $stmt->execute();
         $count=$stmt->rowCount();
         if($count>0){
           return true;
         }else{
           return false;
         }
      }
      catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
    }
    public function ext_update(){
      try{
      $stmt = $this->con->prepare("UPDATE `foto` SET `r_foto`=:r_foto  WHERE id_foto=:id_foto");
      $stmt->bindParam("r_foto",$this->d[0]);
      $stmt->bindParam("id_foto",$this->d[1]);
      $stmt->execute();
      }
      catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
    }
    public function extraer(){
      try{
      $stmt = $this->con->prepare("SELECT `r_foto` FROM `foto` WHERE id_foto=:idfoto");
      $stmt->bindParam("idfoto",$this->d[1]);
      $stmt->execute();
        while ($row=$stmt->fetch()) {
           $_SESSION['img']=$row[0];
        }
     
      return  $_SESSION['img'];
      }
      catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
    }
    public function insert_img(){
      try{
        $stmt = $this->con->prepare("INSERT INTO `foto` VALUES (:id_foto,:r_foto)");
        $stmt->bindParam(":r_foto",$this->d[0]);
        $stmt->bindParam(":id_foto",$this->d[1]);
        $stmt->execute();
        if($stmt){
          return true;
        }else{
          return false;
        }
      }
      catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
    }
}


?>
