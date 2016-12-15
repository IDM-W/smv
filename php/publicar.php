<?php
session_start();
require_once('conexion.php');
require_once('saneo.php');
$p=$_POST;
$clase=new pv();
$r=$clase->pvi($p);

 /**
  *
  */
 class pv
 {
  private $con;
  private $s;
   function __construct()
   {
     $this->con=new Database();

   }
   public function pvi($p)

   {
header("Content-type: text/plain;charset=utf-8");
    $sa=new saneo($p);
     $res=$sa->s();
     $query = $this->con->prepare('INSERT INTO pv (email,nombre,telefono,lugar_s,lugar_l,fecha,hora,cupos,precio,marca,modelo) values (:email,:nombre,:telefono,:lugar_s,:lugar_ll,:fecha,:hora,:cupos,:precio,:marca,:modelo)');

        $query->bindParam(':email',$_SESSION['email']);
        $query->bindParam(':nombre',$_SESSION['nombre']);
        $query->bindParam(':telefono',$_SESSION['telefono']);
        $query->bindParam(':lugar_s',$res[0]);
        $query->bindParam(':lugar_ll',$res[1]);
        $query->bindParam(':fecha',$res[2]);
        $query->bindParam(':hora',$res[3]);
        $query->bindParam(':cupos',$res[4]);
        $query->bindParam(':precio',$res[5]);
        $query->bindParam(':marca',$res[6]);
        $query->bindParam(':modelo',$res[7]);
        $query->execute();
        if (!$query) {
          echo 12;
        }else{
          $e=$query->rowCount();
           if ($e==1) {

            echo '<table>
              <tr>
                <td>'.$_SESSION['nombre'].'</td>
                <td>'.$res[0].'</td>
                <td>'.$res[1].'</td>
                <td>'.$res[2].'</td>
                <td>'.$res[3].'</td>
                <td>'.$res[4].'</td>
                <td>'.$res[5].'</td>
                <td>'.$res[6].'</td>
                <td>'.$res[7].'</td>
              </tr>
            </table>';
           }else {
             echo 0;
           }
        }
   }

 }

 ?>
