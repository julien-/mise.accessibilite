<?php
class DAOMysqli 
{
  protected $_db;
  
  public function __construct(MySQLi $db)
  {
    $this->_db = $db;
  }
  
  protected function executeQuery($sql)
  {
  	return $this->_db->query($sql);
  }
  
  protected function fetchArray($ressource)
  {
  	return $ressource->fetch_assoc();
  }
  
  protected function countRows($ressource)
  {
  	return $ressource->num_rows;
  }
  
  protected function lastInsertedID()
  {
  	return $this->_db->insert_id;
  }
}