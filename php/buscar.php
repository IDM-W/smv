<?php

require_once("saneo.php");
require_once("conexion.php");
$u=$_POST;
$clase=new b();
 $r2=$clase->bus($u);


class  b
{

//conectamos a la bas de datos
 public  function __construct()
  {
    $this->con = new Database();

  }
  //aqui sanetizamos los campos de logi

  //aqui hacemos la consulta al bd
  public function bus($p)
  {
     $saneo=new saneo($p);
     $r=$saneo->s();
    try{
       $stmt = $this->con->prepare("SELECT * FROM pv WHERE lugar_s=:lds  AND lugar_l=:ldl");
         $stmt->bindParam("lds", $r[0]);
         $stmt->bindParam("ldl", $r[1]) ;
         $stmt->execute();

         $count=$stmt->rowCount();
    if ($count<1){
        echo $count;
    }else{
            while ($row=$stmt->fetch()) {
              echo '<div class="co">
          <table>
            <tr>

              <td id="s">'.$row[4].'  </td>
              <td><span class="icon-man"></span><label class="icon-car"></label></td>
              <td >  '.$row[5].'</td>
              <td >  $'.$row[9].'</td>
              <a href="#" id="'.$row[0].'"><td><label id="subirme">Subirme</label></td></a>
              <div class=separador></div>
            </tr>
          </table>
        </div>';
            }
            //echo $count;

    }
    }
     catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
       }
   }
}

 ?>
