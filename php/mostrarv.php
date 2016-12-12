<?php
require 'conexion.php';
$clase=new mos();
$res=$clase->mmo();

/**
 *
 */
class mos
{
private $con;
  function __construct()
  {
 $this->con=new Database();
  }
  public function mmo()
  {
     $stmt = $this->con->prepare("SELECT * FROM pv" );
      $stmt->execute();

      while ($row=$stmt->fetch()) {
        echo '<div class="co">
          <table>
            <tr>

              <td id="s">'.$row[4].'  </td>
              <td><span class="icon-man"></span><label class="icon-car"></label></td>
              <td >  '.$row[5].'</td>
              <td >  $'.$row[9].'</td>
              <a  href="#" ><td><label class="subirme" onclick="subirme(this)" id="'.$row[0].'">Subirme</label></td></a>
              <div class=separador></div>
            </tr>
          </table>
        </div>';
      }
  }
}

 ?>
