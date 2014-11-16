<?php
class DAOCle extends DAOStandard
{
	public function saveOrUpdate(Cle $cle)
	{
		if (exists($cours))
			$this->update($cours);
		else
			$this->save($cours);
	}
	
	public function save(Cle $cle)
	{
		$this->executeQuery('INSERT INTO cle SET valeur_cle = "' . md5($cle->getCle()) . '"');
		
		return $this->lastInsertedID();
	}
	
	public function update(Cle $cle)
	{
		$this->executeQuery('UPDATE cle SET valeur_cle = "' . $cle->getCle() . '" WHERE id_cours = ' . $cle->getId());
	}
	
	public function getByID($id)
	{
	  	$result = $this->executeQuery('SELECT * FROM cle WHERE id_cle = ' . $id);
	  	
	  	$cle = $this->fetchArray($result);
	
	  	if ($cle == null)
	  		return false;
	  	
	  	return new Cle(array('id' => $cle['id_cle'], 'cle' => $cle['valeur_cle']));
	}
  
  	public function exists(Cle $cle)
  	{
  		$result = $this->executeQuery('SELECT * FROM cle WHERE id_cle = ' . $cle->getId());
  	
  		return $this->countRows($result) > 0;
  	}
  	
  	public function checkCleInscription($valeur)
  	{
  		$result = $this->executeQuery('SELECT * FROM cle WHERE valeur_cle = "' . md5($valeur) . '" AND id_cle NOT IN (SELECT id_cle FROM cours)');
  		 
  		return $this->countRows($result) > 0;
  	}
  
  	public function delete($id)
  	{
  		$this->executeQuery('DELETE FROM cle WHERE id_cle = ' . $id);
  	}
}
