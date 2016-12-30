<?php

 class embarcarme{

   public  function __construct(){
     $this->con = new Database();
   }

   public function embarcar($p){
      $saneo=new saneo($p);
      $r=$saneo->s();
      try{

        $query = $this->con->prepare("SELECT pv.id_pv, pv.email, pv.nombre, pv.telefono, pv.lugar_s, pv.lugar_l, pv.fecha, pv.hora, pv.cupos, pv.precio, pv.marca, pv.modelo FROM pv WHERE  pv.id_pv=:id");
        $r[0]=utf8_decode($r[0]);
        $query->bindParam(":id", $r[0]);
        $query->execute();
        $pv=$query->fetchAll();


        $quer=$this->con->prepare("SELECT `conductor`, `turista`,SUM( `p_cupos`) as cupos, `fecha` FROM `mt` WHERE id_pv=:pv_id");
        $quer->bindParam(":pv_id", $pv[0]["id_pv"]);
        $quer->execute();
        $mt=$quer->fetchAll();

        if($mt[0]["cupos"]>=$pv[0]["cupos"]){
            print_r (json_encode($response=array(false,"Cupos cerrado")));
        }else{
            $quer = $this->con->prepare('INSERT INTO mt (id_pv, conductor, turista,p_cupos, fecha) VALUES (:pv_id,:cond,:turi,:p_cupos,SYSDATE())');
            $quer->bindParam(":pv_id", $pv[0]["id_pv"]);
				    $quer->bindParam(":cond", $pv[0]["email"]);
				    $quer->bindParam(":turi", $_SESSION["email"]);
            $quer->bindParam(":p_cupos", $r[1]);

                $quer->execute();
              print_r (json_encode($response=array(true,"se a embarcado desde-> ".$pv[0]["lugar_s"]." a-> ".$pv[0]["lugar_l"]."")));
        }
      }
      catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
   }

 }

?>
