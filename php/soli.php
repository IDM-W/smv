<?php
session_start();
require_once('conexion.php');
require_once('saneo.php');
$p=$_POST;
$clase=new sv();
$r=$clase->svi($p);

 /**
  *
  */
 class sv
 {
  private $con;
  private $s;
   function __construct()
   {
     $this->con=new Database();

   }
   public function svi($p)

   {

    $sa=new saneo($p);
     $res=$sa->s();
     $res[0]=utf8_decode($res[0]);
     $res[1]=utf8_decode($res[1]);
     $query = $this->con->prepare('INSERT INTO svi (email,nombre,lugar_s,lugar_l,fecha) values (:email,:nombre,:lugar_s,:lugar_ll,:fecha)');

        $query->bindParam(':email',$_SESSION['email']);
        $query->bindParam(':nombre',$_SESSION['nombre']);

        $query->bindParam(':lugar_s',$res[0]);
        $query->bindParam(':lugar_ll',$res[1]);
        $query->bindParam(':fecha',$res[2]);
        $query->execute();
        if (!$query) {
          echo 0;
        }else{
          $e=$query->rowCount();
           if ($e==1) {
             $res[0]=utf8_encode($res[0]);
             $res[1]=utf8_encode($res[1]);
              echo '<table>

                <tr height="20">
                  <td>'.$_SESSION['nombre'].'</td>
                  <td>'.$res[0].'</td>
                  <td>'.$res[1].'</td>
                  <td>'.$res[2].'</td>
                </tr>
              </table>' ;
           }else {
             echo 0;
           }
        }
   }

 }

 ?>
