<?php
class DAOStandard 
{ 
  protected function executeQuery($sql)
  {
  	$resultat = mysql_query($sql) or die (mysql_error() . "<br/>SQL: " . $sql);
  	return $resultat;
  }
  
  protected function fetchArray($ressource)
  {
  	return mysql_fetch_array($ressource);
  }
  
  protected function countRows($ressource)
  {
  	return mysql_num_rows($ressource);
  }
  
  public function lastInsertedID()
  {
  	return mysql_insert_id();
  }
}