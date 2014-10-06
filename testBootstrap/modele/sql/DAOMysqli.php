<?php
class DAOMysqli 
{
  protected $_db;
  
  public function __construct(MySQLi $db)
  {
    $this->_db = $db;
  }
}