<?php
class DBFactory
{
	public static function getMysqlConnexionStandard()
	{
		$server = 'localhost';
		$user = 'root';
		$mdp = ''; 
		$base = 'apprentissage'; 

		$db = mysql_connect($server, $user, $mdp) or die("erreur de connexion");
		
		mysql_select_db($base, $db) or die("erreur de selection base");
		mysql_query("SET NAMES UTF8"); 
		
		return 1;
	}
	
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