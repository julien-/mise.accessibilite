<?php
class DAOCle extends DAOStandard
{
  
	public function save(Cle $cle)
	{
		$this->executeQuery('INSERT INTO cle SET valeur_cle = "' . $cle->getCle() . '"');
	}
	
	public function update(Cle $cle)
	{
		$this->executeQuery('UPDATE cle SET valeur_cle = "' . $cle->getCle() . '" WHERE id_cours = ' . $cle->getId());
	}
	
	public function saveOrUpdate(Cle $cle)
	{
		if (exists($cours))
			$this->update($cours);
		else
			$this->save($cours);
	}
  
  	public function exists(Cle $cle)
  	{
  		$result = $this->executeQuery('SELECT * FROM cle WHERE id_cle = ' . $cle->getId());
  	
  		return $this->countRows($result) > 0;
  	}
  	
  	public function checkCleInscription($valeur)
  	{
  		$result = $this->executeQuery('SELECT * FROM cle WHERE valeur_cle = "' . $valeur . '" AND id_cle NOT IN (SELECT id_cle FROM cours)');
  		 
  		return $this->countRows($result) > 0;
  	}
  
  	public function delete($id)
  	{
  		$this->executeQuery('DELETE FROM cle WHERE id_cle = ' . $id);
  	}
}
