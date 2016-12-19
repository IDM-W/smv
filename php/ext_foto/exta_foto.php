<?php
    class ext_img{

      public function  ext_insert($ext_inser,$id_foto){
            require_once 'conexion.php';
            $con=new Database();
          $stm =$con->prepare("INSERT INTO `foto`(`id_foto`, `r_foto`) VALUES (:id_foto,:r_foto)");

          $stm->bindParam("id_foto",$id_foto);
          $stm->bindParam("r_foto",$ext_inser);
          $stm->execute();

          if($stm){
              $img=selectmg($id_foto);
              return $img;
          }else{
              return "$ext_inser";
          }
      }

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
         $stm = $con->prepare("SELECT `r_foto` FROM `foto` WHERE id_foto=:idfoto");
         $stm->bindParam(":idfoto",$id_foto);
         $stm->execute();
         $data=$stm->fetchAll();
         return "54";
      }
    }


?>
