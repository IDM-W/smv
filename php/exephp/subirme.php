<?php 

 class subirme{
 	
   public  function __construct(){
     $this->con = new Database();
   }

   public function subir($p){
      $saneo=new saneo($p);
      $r=$saneo->s();
      try{
        $query = $this->con->prepare("SELECT pv.id_pv, pv.email, pv.nombre, pv.telefono, pv.lugar_s, pv.lugar_l, pv.fecha, pv.hora, pv.cupos, pv.precio, pv.marca, pv.modelo, COUNT(mt.id_pv) FROM pv, mt WHERE mt.id_pv=:id and pv.id_pv=:id");
        $r[0]=utf8_decode($r[0]);
        $query->bindParam("id", $r[0]);
        $query->execute();
        $count=$query->rowCount();
        if ($count<1){
          echo $count ." datos encontrados";
        }else{
            while ($row=$query->fetch()) {
             /* $query = $this->con->prepare("SELECT * FROM mt WHERE id_pv=:id_p");
              $query->bindParam(":id_p", $r[0]);
              $query->execute();
              $count=$query->rowCount();   
			   echo   $count .' '.$r[0];*/       	
              echo '<div class="" id="foto">
               	 	<div id="img">
               	 	</div>
               	 	<label><a>'.$row[2].'</a></label>
               	 	<label>Conductor:<a>Novato</a></label>           	 	
               	 </div>
               	 <div class="" id="oferta">
               	 	<a>Oferta</a><br>
               	 	<label>Cupos:<a> '.$row[8].'/'.$row[12].'</a></label><br>  
               	 	<label>Valor:<a> '.$row[9].'</a></label>         	 	
               	 </div>
               	 <div class="" id="cupos"> 
               	 	<label>Salida:<a> '.$row[4].'</a></label><br>
               	 	<label>Llegada:<a> '.$row[5].'</a></label><br>
               	 	<label>Fecha:<a> '.$row[6].'</a></label><br>
               	 	<label>Hora:<a> '.$row[7].'</a></label><br>            	 	
               	 </div>
               	 <div class="" id="botton">
               	 	<center><input onclick="embarcar(this)" id="'.$row[0].'" class="btn azul cur_p1" type="button" value="embarcar" /> </center>
               	 	      	 	
               	 </div>';
            }

        }
      }
      catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
   }
  
 }
 
?>