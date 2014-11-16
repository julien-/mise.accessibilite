<?php
class DAOInscription extends DAOStandard
{	
	public function add(Inscription $inscription)
	{
		$this->executeQuery('INSERT INTO inscription SET date_inscription = "' . $inscription->getDate() . '" id_cours = "' . $inscription->getCours()->getId() . '", id_etu = ' . $inscription->getEtudiant()->getId().', couleur_cours = '. $inscription->getCouleur());
	}
	
	public function insertByDateAndEtuAndCours($date, $idEtu, $idCours)
	{
		$this->executeQuery('INSERT INTO inscription SET date_inscription = "'.$date.'", id_cours = ' . $idCours . ', id_etu = ' . $idEtu);
	}
	  
	public function deleteByEtudiant($id)
	{
		$this->executeQuery('DELETE FROM inscription WHERE id_etu = ' . $id);
	}
	
	public function deleteByCours($id)
	{
		$this->executeQuery('DELETE FROM inscription WHERE id_cours = ' . $id);
	}
	
	public function deleteByEtudiantAndCours($idEtu, $idCours)
	{
		$this->executeQuery('DELETE FROM inscription WHERE id_etu = ' . $idEtu . ' AND id_cours = ' . $idCours);
	}
	
	public function countByEtudiantProf($idEtu, $idProf)
	{
		$result = $this->executeQuery('SELECT * FROM inscription i, cours c WHERE i.id_cours = c.id_cours AND id_etu = ' . $idEtu . ' AND id_prof = ' . $idProf);
		
		return $this->countRows($result);
	}
	
	public function countByEtudiant($idEtu)
	{
		$result = $this->executeQuery('SELECT * FROM inscription WHERE id_etu = ' . $idEtu);
	
		return $this->countRows($result);
	}
	
	public function countByCours($idCours)
	{
		$result = $this->executeQuery('SELECT * FROM inscription WHERE id_cours = ' . $idCours);
	
		return $this->countRows($result);
	}
	
	public function estInscrit($idEtu, $idCours)
	{
		$result = $this->executeQuery('SELECT * FROM inscription WHERE id_cours = ' . $idCours . ' AND id_etu = ' . $idEtu);
	
		if($this->countRows($result) == 0)
			return false;
		else 
			return true;
	}
	
	  public function getAllByEtudiant($id)
	  {  	
	  	$daoEtudiant = new DAOEtudiant($db);
	  	$daoCours = new DAOCours($db);
	  	
	  	$sql = 'SELECT * FROM inscription i, etudiant e, cours c, cle WHERE c.id_cle = cle.id_cle AND i.id_etu = e.id_etu AND i.id_cours = c.id_cours AND i.id_etu = ' . $id . ' GROUP BY c.id_cours';
	  	$result = $this->executeQuery($sql);

	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array('id' => $inscription['id_inscription'],
	  													'cours' => $daoCours->getByID($inscription['id_cours']),
	  													'etudiant' => $daoEtudiant->getByID($inscription['id_etu']),
	  													'date' => $inscription['date_inscription'],
	  													'couleur_fond' => $inscription['couleur_fond'],
	  													'couleur_texte' => $inscription['couleur_texte']	  													
	  		));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getAllByEtudiantProf($idEtudiant, $idProf)
	  {
	  	$daoEtudiant = new DAOEtudiant($db);
	  	$daoCours = new DAOCours($db);
	  	
	  	$sql = 'SELECT * FROM inscription i, etudiant e, cours c, cle WHERE c.id_cle = cle.id_cle AND i.id_etu = e.id_etu AND i.id_cours = c.id_cours AND i.id_etu = ' . $idEtudiant . ' AND c.id_prof = ' . $idProf . ' GROUP BY c.id_cours';
	  	$result = $this->executeQuery($sql);
	  
	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array('id' => $inscription['id_inscription'],
	  				 									'cours' => $daoCours->getByID($inscription['id_cours']),
	  													'etudiant' => $daoEtudiant->getByID($inscription['id_etu']),
	  													'date' => $inscription['date_inscription'],
	  													'couleur_fond' => $inscription['couleur_fond'],
	  													'couleur_texte' => $inscription['couleur_texte']
	  			  		));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getAllByProfesseur($id)
	  {
	  	$daoEtudiant = new DAOEtudiant($db);
	  	$daoCours = new DAOCours($db);
	  	
	  	$sql = 'SELECT * FROM inscription i, etudiant e, cours c, cle WHERE c.id_cle = cle.id_cle AND i.id_etu = e.id_etu AND i.id_cours = c.id_cours AND c.id_prof = ' . $id . ' GROUP BY e.id_etu';
	  	$result = $this->executeQuery($sql);
	  
	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array('id' => $inscription['id_inscription'],
	  				 									'cours' => $daoCours->getByID($inscription['id_cours']),
	  													'etudiant' => $daoEtudiant->getByID($inscription['id_etu']),
	  													'date' => $inscription['date_inscription'],
	  													'couleur_fond' => $inscription['couleur_fond'],
	  													'couleur_texte' => $inscription['couleur_texte']
	  			  		));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getAllByCours($id)
	  {
	  	$daoEtudiant = new DAOEtudiant($db);
	  	$daoCours = new DAOCours($db);
	  	
	  	$sql = 'SELECT * FROM inscription i, etudiant e, cours c, cle WHERE c.id_cle = cle.id_cle AND i.id_etu = e.id_etu AND i.id_cours = c.id_cours AND i.id_cours = ' . $id . ' GROUP BY i.id_etu ORDER BY nom_etu';

	  	$result = $this->executeQuery($sql);
	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array('id' => $inscription['id_inscription'],
	  				 									'cours' => $daoCours->getByID($inscription['id_cours']),
	  													'etudiant' => $daoEtudiant->getByID($inscription['id_etu']),
	  													'date' => $inscription['date_inscription'],
	  													'couleur_fond' => $inscription['couleur_fond'],
	  													'couleur_texte' => $inscription['couleur_texte']
	  			  		));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getClassmates($id)
	  {
	  	$daoEtudiant = new DAOEtudiant($db);
	  	$daoCours = new DAOCours($db);
	  	
	  	$sql = 'CREATE TEMPORARY TABLE R1
				SELECT * 
				FROM inscription
				WHERE id_etu = 23;';  
	  	$result = $this->executeQuery($sql);
	  	
	  	$sql = 'CREATE TEMPORARY TABLE R2
				SELECT inscription.id_inscription, inscription.id_cours, inscription.id_etu, inscription.date_inscription, inscription.couleur_fond, inscription.couleur_texte 
	  			FROM inscription, etudiant, R1
				WHERE inscription.id_cours = R1.id_cours
				AND inscription.id_etu = etudiant.id_etu
				;'; 
	  	$result = $this->executeQuery($sql);
	  	
	  	$sql = 'SELECT *
				FROM R2';
	  	$result = $this->executeQuery($sql);
	  	
	  	$sql = 'DROP TEMPORARY TABLE R1';
	  	$this->executeQuery($sql);
	  	
	  	$sql = 'DROP TEMPORARY TABLE R2';
	  	$this->executeQuery($sql);
	  	
	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array('id' => $inscription['id_inscription'],
	  				 									'cours' => $daoCours->getByID($inscription['id_cours']),
	  													'etudiant' => $daoEtudiant->getByID($inscription['id_etu']),
	  													'date' => $inscription['date_inscription'],
	  													'couleur_fond' => $inscription['couleur_fond'],
	  													'couleur_texte' => $inscription['couleur_texte']
	  			  		));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function searchClassmates($id, $query)
	  {
	  	$daoEtudiant = new DAOEtudiant($db);
	  	$daoCours = new DAOCours($db);
	  
	  	$sql = 'CREATE TEMPORARY TABLE R1
				SELECT *
				FROM inscription
				WHERE id_etu = 23;';
	  	$result = $this->executeQuery($sql);
	  
	  	$sql = 'CREATE TEMPORARY TABLE R2
				SELECT inscription.id_inscription, inscription.id_cours, inscription.id_etu, inscription.date_inscription, inscription.couleur_fond, inscription.couleur_texte 
	  			FROM inscription, etudiant, R1
				WHERE inscription.id_cours = R1.id_cours
				AND inscription.id_etu = etudiant.id_etu
	  			AND (nom_etu LIKE "%'.$query.'%"
  				OR prenom_etu LIKE "%'.$query.'%")
				;';
	  	$result = $this->executeQuery($sql);
	  
	  	$sql = 'SELECT *
				FROM R2';
	  	$result = $this->executeQuery($sql);
	  
	  	$sql = 'DROP TEMPORARY TABLE R1';
	  	$this->executeQuery($sql);
	  
	  	$sql = 'DROP TEMPORARY TABLE R2';
	  	$this->executeQuery($sql);
	  
	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array('id' => $inscription['id_inscription'],
	  				 									'cours' => $daoCours->getByID($inscription['id_cours']),
	  													'etudiant' => $daoEtudiant->getByID($inscription['id_etu']),
	  													'date' => $inscription['date_inscription'],
	  													'couleur_fond' => $inscription['couleur_fond'],
	  													'couleur_texte' => $inscription['couleur_texte']
	  			  		));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getAllByCoursExceptEtu($id_cours, $id_etu)
	  {
	  	$daoEtudiant = new DAOEtudiant($db);
	  	$daoCours = new DAOCours($db);
	  	
	  	$sql = 'SELECT * 
	  			FROM inscription i, etudiant e, cours c, cle 
	  			WHERE c.id_cle = cle.id_cle 
	  			AND i.id_etu != ' . $id_etu . '
	  			AND i.id_etu = e.id_etu 
	  			AND i.id_cours = c.id_cours 
	  			AND i.id_cours = ' . $id_cours . ' 
	  			GROUP BY e.id_etu
	  			ORDER BY date_inscription';
	  
	  	$result = $this->executeQuery($sql);
	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array('id' => $inscription['id_inscription'],
	  				 									'cours' => $daoCours->getByID($inscription['id_cours']),
	  													'etudiant' => $daoEtudiant->getByID($inscription['id_etu']),
	  													'date' => $inscription['date_inscription'],
	  													'couleur_fond' => $inscription['couleur_fond'],
	  													'couleur_texte' => $inscription['couleur_texte']
	  			  		));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function isFirstEtudiantInscritByCours($idCours, $idEtu)
	  {
	  	$sql = 'SELECT id_etu
	  			FROM inscription
	  			WHERE id_cours = ' . $idCours .'
	  			ORDER BY id_inscription ASC
	  			LIMIT 1';
	  	$result = $this->executeQuery($sql);
	  	$id = $this->fetchArray($result);
	  	if($id['id_etu'] == $idEtu)
	  		return true;
	  	else
	  		return false;
	  }
	  
	  public function getCouleurFond($idCours, $idEtu)
	  {
	  	$sql = 'SELECT couleur_fond
	  			FROM inscription
	  			WHERE id_cours = ' . $idCours .'
	  			AND id_etu = ' . $idEtu;
	  	$result = $this->executeQuery($sql);
	  	$couleur = $this->fetchArray($result);
	  	if($couleur['couleur_fond'] == NULL)
	  		return "#f54f4f";
	  	else
	  		return $couleur['couleur_fond'];
	  }
	  
	  public function getCouleurTexte($idCours, $idEtu)
	  {
	  	$sql = 'SELECT couleur_texte
	  			FROM inscription
	  			WHERE id_cours = ' . $idCours .'
	  			AND id_etu = ' . $idEtu;
	  	$result = $this->executeQuery($sql);
	  	$couleur = $this->fetchArray($result);
	  	if($couleur['couleur_texte'] == NULL)
	  		return "white";
	  	else
	  		return $couleur['couleur_texte'];
	  }
	  
	  public function modifierCouleur($idCours, $idEtu, $couleur_fond, $couleur_texte)
	  {
	  	$this->executeQuery ( 'UPDATE inscription
								SET couleur_fond = "' . $couleur_fond . '", couleur_texte = "' . $couleur_texte . '"
								WHERE id_etu = ' . $idEtu . '
								AND id_cours = ' . $idCours );
	  }
}