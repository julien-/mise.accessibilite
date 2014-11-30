<?php
class DAOCleEnseignant extends DAOStandard
{	  
  	public function correspond($cle)
  	{
  		$result = $this->executeQuery('SELECT * FROM cle_enseignant WHERE cle = "' . $cle . '"');
  	
  		return $this->countRows($result) > 0;
  	}
}
