<?php
class DAOMysqli 
{
  protected $_db;
  
  public function __construct(MySQLi $db)
  {
    $this->_db = $db;
  }
  
  private function executeQuery($sql)
  {
  	return $this->_db->query($sql);
  }
  
  private function fetchArray($ressource)
  {
  	return $ressource->fetch_assoc();
  }
  
  private function countRows($ressource)
  {
  	return $ressource->num_rows;
  }
}