<?php
//conectamos la base de datos
class Database extends PDO
{
  //nombre base de datos
private $dbname = "viaje";
//nombre servidor
private $host = "localhost";
//nombre usuarios base de datos
private $user = "postgres";
//password usuario
private $pass = "1234";
//puerto postgreSql
private $port = 1024;
private $con;
private $conm;
  public function __construct()
  {
    try {
	        //$this->con = parent::__construct("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->pass");
           //$this->conm = parent::__construct('mysql:host=localhost;dbname=viaje', 'root', 'n00lv1d4r-m3');
           $host = 'mysql:host=localhost;dbname=viaje;charset=utf8';
           $user = 'root';
           $pas = 'n00lv1d4r-m3';
           $op = array(
               PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
           );

           $this->conm = parent::__construct($host, $user, $pas, $op);
	    } catch(PDOException $e) {

	        echo  $e->getMessage();

	    }
}
}
 ?>
