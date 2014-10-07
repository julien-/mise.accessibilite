<?php
class DBFactory
{
  public static function getMysqlConnexionWithPDO()
  {
    $db = new PDO('mysql:host=localhost;dbname=apprentissage', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $db;
  }
  
  public static function getMysqlConnexionWithMySQLi()
  {
  	$mysqli = new MySQLi('localhost', 'root', '', 'apprentissage');
  	$mysqli->set_charset("utf8");
    return $mysqli;
    
    
  }
}