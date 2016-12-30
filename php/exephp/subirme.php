<?php

 class subirme{

   public  function __construct(){
     $this->con = new Database();
   }

   public function subir($p){
      $saneo=new saneo($p);
      $r=$saneo->s();
      try{
        $query = $this->con->prepare("SELECT pv.id_pv, pv.email, pv.nombre, pv.telefono, pv.lugar_s, pv.lugar_l, pv.fecha, pv.hora, pv.cupos, pv.precio, pv.marca, pv.modelo, foto.r_foto FROM pv INNER JOIN foto on foto.id_foto=pv.id_cr WHERE pv.id_pv=:id");
///"SELECT pv.id_pv, pv.email, pv.nombre, pv.telefono, pv.lugar_s, pv.lugar_l, pv.fecha, pv.hora, pv.cupos, pv.precio, pv.marca, pv.modelo, COUNT(mt.id_pv) as cupos, foto.r_foto FROM pv INNER JOIN mt on mt.id_pv=pv.id_pv INNER JOIN foto on foto.id_foto=pv.id_cr WHERE pv.id_pv=:id"
        $r[0]=utf8_decode($r[0]);
        $query->bindParam(":id", $r[0]);
        $query->execute();
        $count=$query->rowCount();

        $cup = $this->con->prepare("SELECT if(sum(mt.p_cupos)>=1,SUM(mt.p_cupos),0) as cupos FROM `mt` WHERE mt.id_pv=:id");
        $cup->bindParam(":id", $r[0]);
        $cup->execute();
        $cupos=$cup->fetchAll();


       $selcup="";
        if ($count<1){
          echo $count ." datos encontrados";
        }else{
            while ($row=$query->fetch()) {
             /* $query = $this->con->prepare("SELECT * FROM mt WHERE id_pv=:id_p");
              $query->bindParam(":id_p", $r[0]);
              $query->execute();
              $count=$query->rowCount();
			   echo   $count .' '.$r[0];*/
<<<<<<< HEAD

=======
         
>>>>>>> 52aba3b72cb313b0e4b946a7cb2c2a2d446ca0f6
         for ($i = 1; $i <=($row[8]-$cupos[0][0]); $i++) {
           if($i==1){
             $selcup.='<option value="'.($i).'">'.($i).' cupo</option>';

           }else{
             $selcup.='<option value="'.($i).'">'.($i).' cupos</option>';
           }

         }
         //print_r($row);
              echo '<div class="" id="foto">
               	 	<img src="'.$row[12].'" id="img"/><br>
               	 	<label><a>'.$row[2].'</a></label><br>
               	 	<label>Conductor:<a>Novato</a></label>
               	 </div>
               	 <div class="" id="oferta">
               	 	<a>Oferta</a><br>
               	 	<label>Cupos:<a>'.$row[8].' / '.$cupos[0][0].'</a></label><br>
               	 	<label>Valor:<a>'.$row[9].' </a></label>
               	 </div>
               	 <div class="" id="cupos">
               	 	<label>Salida:<a>'.$row[4].' </a></label><br>
               	 	<label>Llegada:<a>'.$row[5].' </a></label><br>
               	 	<label>Fecha:<a>'.$row[6].' </a></label><br>
               	 	<label>Hora:<a>'.$row[7].' </a></label><br>
                  <label>Pedir: </label><select id="p_cupos" name="p_cupos">
                     '.$selcup.'
                 </select>

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
