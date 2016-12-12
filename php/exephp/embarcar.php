<?php 
session_start();  
 class embarcarme{
 	
   public  function __construct(){
     $this->con = new Database();
   }

   public function embarcar($p){
      $saneo=new saneo($p);
      $r=$saneo->s();
      try{
   	
        $query = $this->con->prepare("SELECT pv.id_pv, pv.email, pv.nombre, pv.telefono, pv.lugar_s, pv.lugar_l, pv.fecha, pv.hora, pv.cupos, pv.precio, pv.marca, pv.modelo, COUNT(mt.id_pv) FROM pv, mt WHERE mt.id_pv=:id and pv.id_pv=:id");
        $r[0]=utf8_decode($r[0]);
        $query->bindParam(":id", $r[0]);
        $query->execute();
        $count=$query->rowCount();
        if ($count<1){
          echo $count ." Insertado (*Denegado)";
        }else{
            while ($row=$query->fetch()) {
            	echo  $count;
                        	
                $query = $this->con->prepare('INSERT INTO mt(id_pv, conductor, turista) VALUES (:pv_id,:cond,:turi)');
                $query->bindParam(":pv_id", $r[0]);
				$query->bindParam(":cond", $row[1]);	
				$query->bindParam(":turi", $_SESSION["email"]);					
                $query->execute();
            }

        }
      }
      catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
   }
  
 }
 
?>