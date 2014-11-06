<?php
class DAOAssignations_objectif extends DAOStandard
{
  public function saveOrUpdate(Assignations_objectif $assignation)
  {
  	if ($this->exists($assignation))
  		$this->update($assignation);
  	else
  		$this->save($assignation);
  }
  
  public function save(Assignations_objectif $assignation)
  {
  	$result = $this->executeQuery('INSERT INTO assignations_objectif SET id_etu = ' . $assignation->getEtudiant() . ', id_objectif = ' . $assignation->getObjectif()->getId() . ', id_cours = ' . $assignation->getCours() . ', date = now()');
  }
  
  public function saveByObjectif($idEtu, $idCours, $idObjectif)
  {

  	$result = $this->executeQuery('INSERT INTO assignations_objectif SET id_etu = ' . $assignation->getEtudiant() . ', id_objectif = ' . $assignation->getObjectif() . ', id_cours = ' . $assignation->getCours() . ', date = now()');
  }
  
  public function update(Assignations_objectif $assignation)
  {
  	$result = $this->executeQuery('UPDATE assignations_objectif SET id_etu = ' . $assignation->getEtudiant() . ', id_objectif = ' . $assignation->getObjectif() . ', id_cours = ' . $assignation->getCours() . ', date = ' . $assignation->getDate());
  } 
  
  public function existsByEtudiantObjectifCours($idEtu, $idObj, $idCours)
  {
  	$ressource = $this->executeQuery('SELECT * FROM assignations_objectif WHERE id_etu =' . $idEtu . ' AND id_objectif =' . $idObj . ' AND id_cours = ' . $idCours);
  	
  	return $this->countRows($ressource) > 0;
  }
  
  public function getByEtudiant($idEtu)
  {
  	$daoEtudiant = new DAOEtudiant($db);
  	$daoObjectif = new DAOObjectif($db);
  	$daoCours = new DAOCours($db);
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
				'cours' => $daoCours->getByID($objectif['id_cours']),
				'date' => $objectif['date']
		));
	}
	return $listeObjectifs;
  }
  
  public function checkAllByEtudiantCours($idEtu, $idCours)
  {
  	$daoObjectifs = new DAOObjectif($db);
  	$listeObjectifs = $daoObjectifs->getAll();
  	$listeAssignation = array();
  	foreach($listeObjectifs as $objectif)
  	{
  		$objectif_ = str_replace(' ', '_', $objectif->getObjectif());
  		$objectif_ = stripAccents($objectif_);
  		$methode = 'check' . ucfirst($objectif_);
	  	if (is_callable ( array (
	  			$this,
	  			$methode
	  	) )) 
	  	{
	  		$pourcentage = $this->$methode ($idEtu, $idCours);
	  		$assignation = new Assignations_objectif(array(
	  				'etudiant' => $idEtu,
	  				'objectif' => $objectif,
	  				'cours' => $idCours,
	  				'pourcentage' => $pourcentage,
	  				'date' => date("Y/m/d")
	  		));
	  		
	  		if ($pourcentage >= 100 && !$this->existsByEtudiantObjectifCours($idEtu, $objectif->getId(), $idCours))
	  		{
	  			$this->save($assignation);
	  		}
	  		
	  		$listeAssignation[] = $assignation;
	  	}
  	}
  	
  	return $listeAssignation;
  }
  
  public function checkDebutant($idEtu, $idCours)
  {
  	$daoAvancement = new DAOAvancement($db);
  	$pourcentage = $daoAvancement->getByCoursEtudiant($idCours, $idEtu) * 4;
  	return $pourcentage;
  }
  
  public function checkIntermediaire($idEtu, $idCours)
  {
  	$daoAvancement = new DAOAvancement($db);
  	$pourcentage = $daoAvancement->getByCoursEtudiant($idCours, $idEtu) * 2;
  	return $pourcentage;
  }
  
  public function checkAvance($idEtu, $idCours)
  {
  	$daoAvancement = new DAOAvancement($db);
  	$pourcentage = $daoAvancement->getByCoursEtudiant($idCours, $idEtu) * (4/3);
  	return $pourcentage;
  }
  
  public function checkExpert($idEtu, $idCours)
  {
  	$daoAvancement = new DAOAvancement($db);
  	return $daoAvancement->getByCoursEtudiant($idCours, $idEtu);
  }
  
  public function checkDiscret($idEtu, $idCours)
  {
  	$daoMessage = new DAOMessage($db);
  	$pourcentage = $daoMessage->countByEtudiantCours($idEtu, $idCours);
  	return $pourcentage * 100;
  }
  
  public function checkLoquace($idEtu, $idCours)
  {
  	$daoMessage = new DAOMessage($db);
  	$pourcentage = $daoMessage->countByEtudiantCours($idEtu, $idCours) / 5;
  	return $pourcentage * 100; 
  }
  
  public function checkBavard($idEtu, $idCours)
  {
  	$daoMessage = new DAOMessage($db);
  	$pourcentage = $daoMessage->countByEtudiantCours($idEtu, $idCours) / 15;
  	return $pourcentage * 100;
  }
  
  public function checkProf_en_herbe($idEtu, $idCours)
  {
  	$daoAvancement_bonus = new DAOAvancement_bonus($db);
  	$pourcentage = $daoAvancement_bonus->countFaitByEtudiantCours($idEtu, $idCours);
  	return $pourcentage * 100;
  }
  
  public function checkPetit_genie($idEtu, $idCours)
  {
  	$daoAvancement_bonus = new DAOAvancement_bonus($db);
  	$pourcentage = $daoAvancement_bonus->countFaitByEtudiantCours($idEtu, $idCours) / 5;
  	return $pourcentage * 100;
  }
  
  public function checkSavant_fou($idEtu, $idCours)
  {
  	$daoAvancement_bonus = new DAOAvancement_bonus($db);
  	$pourcentage = $daoAvancement_bonus->countFaitByEtudiantCours($idEtu, $idCours) / 15;
  	return $pourcentage * 100;
  }
  
  public function checkJuge($idEtu, $idCours)
  {
  	$daoAvancement_bonus = new DAOAvancement_bonus($db);
  	$pourcentage = $daoAvancement_bonus->countNotesByEtudiantCours($idEtu, $idCours);
  	return $pourcentage * 100;
  }
  
  public function checkJure($idEtu, $idCours)
  {
  	$daoAvancement_bonus = new DAOAvancement_bonus($db);
  	$pourcentage = $daoAvancement_bonus->countNotesByEtudiantCours($idEtu, $idCours) / 5;
  	return $pourcentage * 100;
  }
  
  public function checkBourreau($idEtu, $idCours)
  {
  	$daoAvancement_bonus = new DAOAvancement_bonus($db);
  	$pourcentage = $daoAvancement_bonus->countNotesByEtudiantCours($idEtu, $idCours) / 15;
  	return $pourcentage * 100;
  }
  
  public function checkIdole($idEtu, $idCours)
  {
  	$daoAvancement_bonus = new DAOAvancement_bonus($db);
  	$pourcentage = $daoAvancement_bonus->countNotesRecuesEgal5ByEtudiantCours($idEtu, $idCours) / 15;
  	return $pourcentage * 100;
  }  
  
  public function checkPionier($idEtu, $idCours)
  {
  	$daoInscription= new DAOInscription($db);
  	$firstStudentid = $daoInscription->getFirstEtudiantInscritByCours($idCours);
  	if($firstStudentid == $idEtu)
  		return 100;
  	else
  		return 0;
  }
}