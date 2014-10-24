<?php
class DAOInscription extends DAOStandard
{	
	public function add(Inscription $inscription)
	{
		$this->executeQuery('INSERT INTO inscription SET date_inscription = "' . $inscription->getDate() . '" id_cours = "' . $inscription->getCours()->getId() . '", id_etu = ' . $inscription->getEtudiant()->getId());
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
	
	  public function getAllByEtudiant($id)
	  {
	  	$daoEtudiant = new DAOEtudiant($this->_db);
	  	$sql = 'SELECT * FROM inscription i, etudiant e, cours c, cle WHERE c.id_cle = cle.id_cle AND i.id_etu = e.id_etu AND i.id_cours = c.id_cours AND i.id_etu = ' . $id . ' GROUP BY c.id_cours';
	  	$result = $this->executeQuery($sql);

	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array( 'cours' => new Cours(array(	'id' => $inscription['id_cours'],
														  				'libelle' => $inscription['libelle_cours'],
														  				'couleurCalendar' => $inscription['couleur_calendar'],
														  				'prof' => $daoEtudiant->getByID($inscription['id_prof']),
														  				'cle' => new Cle(array('id' => $inscription['id_cle'],
														  						'cle' => $inscription['valeur_cle'])))),
	  												'etudiant' => new Etudiant(array(	'id' => $inscription['id_etu'], 
																			  								'nom' => $inscription['nom_etu'], 
																			  								'prenom' => $inscription['prenom_etu'], 
																			  								'mail' => $inscription['mail_etu'], 
																			  								'login' => $inscription['pseudo_etu'],
																			  								'pass' => $inscription['pass_etu'],
																			  								'admin' => $inscription['admin'])),
	  												'date' => $inscription['date_inscription']
	  		));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getAllByEtudiantProf($idEtudiant, $idProf)
	  {
	  	$daoEtudiant = new DAOEtudiant($this->_db);
	  	$sql = 'SELECT * FROM inscription i, etudiant e, cours c, cle WHERE c.id_cle = cle.id_cle AND i.id_etu = e.id_etu AND i.id_cours = c.id_cours AND i.id_etu = ' . $idEtudiant . ' AND c.id_prof = ' . $idProf . ' GROUP BY c.id_cours';
	  	$result = $this->executeQuery($sql);
	  
	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array( 'cours' => new Cours(array(	'id' => $inscription['id_cours'],
	  				'libelle' => $inscription['libelle_cours'],
	  				'couleurCalendar' => $inscription['couleur_calendar'],
	  				'prof' => $daoEtudiant->getByID($inscription['id_prof']),
	  				'cle' => new Cle(array('id' => $inscription['id_cle'],
	  						'cle' => $inscription['valeur_cle'])))),
	  				'etudiant' => new Etudiant(array(	'id' => $inscription['id_etu'],
	  						'nom' => $inscription['nom_etu'],
	  						'prenom' => $inscription['prenom_etu'],
	  						'mail' => $inscription['mail_etu'],
	  						'login' => $inscription['pseudo_etu'],
	  						'pass' => $inscription['pass_etu'],
	  						'admin' => $inscription['admin'])),
	  				'date' => $inscription['date_inscription']
	  		));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getAllByProfesseur($id)
	  {
	  	$daoEtudiant = new DAOEtudiant($this->_db);
	  	$sql = 'SELECT * FROM inscription i, etudiant e, cours c, cle WHERE c.id_cle = cle.id_cle AND i.id_etu = e.id_etu AND i.id_cours = c.id_cours AND c.id_prof = ' . $id . ' GROUP BY e.id_etu';
	  	$result = $this->executeQuery($sql);
	  
	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {
	  		$listeInscription[] = new Inscription(array( 'cours' => new Cours(array(	'id' => $inscription['id_cours'],
	  				'libelle' => $inscription['libelle_cours'],
	  				'couleurCalendar' => $inscription['couleur_calendar'],
	  				'prof' => $daoEtudiant->getByID($inscription['id_prof']),
	  				'cle' => new Cle(array('id' => $inscription['id_cle'],
	  						'cle' => $inscription['valeur_cle'])))),
	  				'etudiant' => new Etudiant(array(	'id' => $inscription['id_etu'],
	  						'nom' => $inscription['nom_etu'],
	  						'prenom' => $inscription['prenom_etu'],
	  						'mail' => $inscription['mail_etu'],
	  						'login' => $inscription['pseudo_etu'],
	  						'pass' => $inscription['pass_etu'],
	  						'admin' => $inscription['admin']))));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getAllByCours($id)
	  {
	  	$daoEtudiant = new DAOEtudiant($this->_db);
	  	$sql = 'SELECT * FROM inscription i, etudiant e, cours c, cle WHERE c.id_cle = cle.id_cle AND i.id_etu = e.id_etu AND i.id_cours = c.id_cours AND i.id_cours = ' . $id . ' GROUP BY c.id_cours ORDER BY date_inscription';

	  	$result = $this->executeQuery($sql);
	  	$listeInscription = null;
	  	while ($inscription = $this->fetchArray($result)) {

	  		$listeInscription[] = new Inscription(array( 'cours' => new Cours(array(	'id' => $inscription['id_cours'],
	  				'libelle' => $inscription['libelle_cours'],
	  				'couleurCalendar' => $inscription['couleur_calendar'],
	  				'prof' => $daoEtudiant->getByID($inscription['id_prof']),
	  				'cle' => new Cle(array('id' => $inscription['id_cle'],
	  						'cle' => $inscription['valeur_cle'])))),
	  				'etudiant' => new Etudiant(array(	'id' => $inscription['id_etu'],
	  						'nom' => $inscription['nom_etu'],
	  						'prenom' => $inscription['prenom_etu'],
	  						'mail' => $inscription['mail_etu'],
	  						'login' => $inscription['pseudo_etu'],
	  						'pass' => $inscription['pass_etu'],
	  						'admin' => $inscription['admin']))));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getClassmates($id)
	  {
	  	$daoEtudiant = new DAOEtudiant($db);
	  	
	  	$sql = 'CREATE TEMPORARY TABLE R1
				SELECT * 
				FROM inscription
				WHERE id_etu = 23;';  
	  	$result = $this->executeQuery($sql);
	  	
	  	$sql = 'CREATE TEMPORARY TABLE R2
				SELECT inscription.id_etu, nom_etu, prenom_etu, pseudo_etu, mail_etu, pass_etu, admin FROM inscription, etudiant, R1
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
	  		$listeInscription[] = new Inscription(array( 
	  				'cours' => 0,
	  				'etudiant' => new Etudiant(array(	'id' => $inscription['id_etu'],
	  						'nom' => $inscription['nom_etu'],
	  						'prenom' => $inscription['prenom_etu'],
	  						'mail' => $inscription['mail_etu'],
	  						'login' => $inscription['pseudo_etu'],
	  						'pass' => $inscription['pass_etu'],
	  						'admin' => $inscription['admin']))));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function searchClassmates($id, $query)
	  {
	  	$daoEtudiant = new DAOEtudiant($db);
	  
	  	$sql = 'CREATE TEMPORARY TABLE R1
				SELECT *
				FROM inscription
				WHERE id_etu = 23;';
	  	$result = $this->executeQuery($sql);
	  
	  	$sql = 'CREATE TEMPORARY TABLE R2
				SELECT inscription.id_etu, nom_etu, prenom_etu, pseudo_etu, mail_etu, pass_etu, admin FROM inscription, etudiant, R1
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
	  		$listeInscription[] = new Inscription(array(
	  				'cours' => 0,
	  				'etudiant' => new Etudiant(array(	'id' => $inscription['id_etu'],
	  						'nom' => $inscription['nom_etu'],
	  						'prenom' => $inscription['prenom_etu'],
	  						'mail' => $inscription['mail_etu'],
	  						'login' => $inscription['pseudo_etu'],
	  						'pass' => $inscription['pass_etu'],
	  						'admin' => $inscription['admin']))));
	  	}
	  	return $listeInscription;
	  }
	  
	  public function getAllByCoursExceptEtu($id_cours, $id_etu)
	  {
	  	$daoEtudiant = new DAOEtudiant($this->_db);
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
	  
	  		$listeInscription[] = new Inscription(array( 'cours' => new Cours(array(	'id' => $inscription['id_cours'],
	  				'libelle' => $inscription['libelle_cours'],
	  				'couleurCalendar' => $inscription['couleur_calendar'],
	  				'prof' => $daoEtudiant->getByID($inscription['id_prof']),
	  				'cle' => new Cle(array('id' => $inscription['id_cle'],
	  						'cle' => $inscription['valeur_cle'])))),
	  				'etudiant' => new Etudiant(array(	'id' => $inscription['id_etu'],
	  						'nom' => $inscription['nom_etu'],
	  						'prenom' => $inscription['prenom_etu'],
	  						'mail' => $inscription['mail_etu'],
	  						'login' => $inscription['pseudo_etu'],
	  						'pass' => $inscription['pass_etu'],
	  						'admin' => $inscription['admin']))));
	  	}
	  	return $listeInscription;
	  }
}