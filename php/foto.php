<?php
session_start();
require_once 'conexion.php';
$con=new Database();
/*require_once("ext_foto/exta_foto.php");

$img_r=new ext_img();
echo $img_r->ext_insert($_POST["foto"],$_SESSION["id"]);
*/
$stmt = $con->prepare("UPDATE `foto` SET r_foto=:r_foto  WHERE id_foto=:id_foto");
$stmt->bindParam(":r_foto",$_POST["foto"]);
$stmt->bindParam(":id_foto",$_SESSION["id"]);
$stmt->execute();

$stm = $con->prepare("SELECT `r_foto` FROM `foto` WHERE id_foto=:idfoto");
$stm->bindParam(":idfoto",$_SESSION["id"]);
$stm->execute();
$data=$stm->fetchAll();
$_SESSION['img']=$data[0][0];
echo $data[0][0];
function FunctionName($value='')
{
  # code...
}


  /*if (isset($_POST["foto"]))
{
  $file = $_FILES["foto"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "img/";
    $carpeta2="php/img/";

    $src = $carpeta.$nombre;
    $src2=$carpeta2.$nombre;
    $image = $file["tmp_name"];
    $type = pathinfo($image, PATHINFO_EXTENSION);
    $data = file_get_contents($image);
    $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
    function base64_encode_image ($filename=string,$filetype=string) {
        if ($filename) {
            $imgbinary = fread(fopen($filename, "r"), filesize($filename));
            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
        }
    }
    move_uploaded_file($ruta_provisional, $src);
      $stmt = $con->prepare("UPDATE usuarios SET fope=:ruta WHERE email=:email");
      $stmt->bindParam("ruta", $src2);
      $stmt->bindParam("email", $_SESSION["email"]);
      $stmt->execute();

        echo $_POST["foto"];;

}else{
  print_r( $_POST);
}*/

 ?>
