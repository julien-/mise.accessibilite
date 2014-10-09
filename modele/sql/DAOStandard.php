<?php
class DAOStandard 
{ 
  private function executeQuery($sql)
  {
  	return mysql_query($sql) or die (mysql_error() . "<br/>SQL: " . $sql);
  }
  
  private function fetchArray($ressource)
  {
  	return mysql_fetch_array($ressource);
  }
  
  private function countRows($ressource)
  {
  	return mysql_num_rows($ressource);
  }
}