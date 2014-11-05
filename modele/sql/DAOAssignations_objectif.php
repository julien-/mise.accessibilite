<?php
class DAOAssignations_objectif extends DAOStandard
{
  public function saveOrUpdate(Assignation_objectif $assignation)
  {
  	if ($this->exists($assignation))
  		$this->update($assignation);
  	else
  		$this->save($assignation);
  }
  
  public function save(Assignation_objectif $assignation)
  {
  	$result = $this->executeQuery('INSERT INTO assignations_objectif SET id_etu = ' . $assignation->getEtudiant()->getId() . ', id_objectif = ' . $assignation->getObjectif()->getId() . ', id_cours = ' . $assignation->getCours()->getId() . ', date = ' . $assignation->getDate());
  }
  
  public function update(Assignation_objectif $assignation)
  {
  	$result = $this->executeQuery('UPDATE assignations_objectif SET id_etu = ' . $assignation->getEtudiant()->getId() . ', id_objectif = ' . $assignation->getObjectif()->getId() . ', id_cours = ' . $assignation->getCours()->getId() . ', date = ' . $assignation->getDate());
  } 
  
  public function getByEtudiant($idEtu)
  {
  	$daoEtudiant = new DAOEtudiant($db);
  	$daoObjectif = new DAOObjectif($db);
  	$result = $this->executeQuery('SELECT *
									FROM assignations_objectif, objectif, etudiant, cours
									WHERE assignations_objectif.id_etu =' .$idEtu. '
  									AND assignations_objectif.id_objectif = objectif.id_objectif
  									AND assignations_objectif.id_etu = etudiant.id_etu
  									AND assignations_objectif.id_cours = cours.id_cours');
  		
  	$listeObjectifs = array();
	while ($objectif = $this->fetchArray($result)) {
		$listeObjectifs[] = new Assignations_objectif(array(
				'etudiant' => $daoEtudiant->getByID($objectif['id_etu']),
				'objectif' => $daoObjectif->getByID($objectif['id_objectif']),
				'cours' => $daoObjectif->getByID($objectif['id_cours']),
				'date' => $objectif['date']
		));
	}
	return $listeObjectifs;
  }
}