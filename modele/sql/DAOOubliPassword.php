<?php
class DAOOubliPassword extends DAOStandard
{
	public function saveOrUpdate(OubliPassword $oubli)
	{
		if (exists($oubli))
			$this->update($oubli);
		else
			$this->save($oubli);
	}
	
	public function save(OubliPassword $oubli)
	{
		$this->executeQuery('INSERT INTO oubli_password SET id_etu = ' . $oubli->getEtudiant()->getId() . ', cle = "' . $oubli->getCle() . '", date_expiration = "' . $oubli->getDate() . '"');
	}
	
	public function update(Cle $cle)
	{
		$this->executeQuery('UPDATE oubli_password SET id_etu = ' . $oubli->getEtudiant()->getId() . ', cle = "' . $oubli->getCle() . '", date_expiration = "' . $oubli->getDate() . '" WHERE id_modification = '.$oubli->getId().'');
	}
	
	public function getByCle($cle)
	{
	  	$result = $this->executeQuery('SELECT * FROM oubli_password WHERE cle = "' . $cle . '"');
	  	
	  	$oubli = $this->fetchArray($result);
	
	  	if ($oubli == null)
	  		return false;
	  	else 
	  	{
	  		$daoEtudiant = new DAOEtudiant($db);
	  		return new OubliPassword(array(	'id' => $oubli['id'], 
	  										'etudiant' => $daoEtudiant->getByID($oubli['id_etu']),
	  										'cle' => $oubli['cle'],
	  										'date' => $oubli['date_expiration']));
	  	}
	}
	
	public function existsByCle($cle)
	{
		$result = $this->executeQuery('SELECT * FROM oubli_password WHERE cle = "' . $cle .'"');
	
		return $this->countRows($result) > 0;
	}
}
