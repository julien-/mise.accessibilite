<?php
class DAOInscription extends DAOMysqli
{	
	public function add(Inscription $inscription)
	{
		$this->executeQuery('INSERT INTO inscription SET id_cours = "' . $inscription->getCours()->getId() . '", id_etu = ' . $inscription->getEtudiant()->getId());
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
																			  								'admin' => $inscription['admin']))));
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
	  	$sql = 'SELECT * FROM inscription i, etudiant e, cours c, cle WHERE c.id_cle = cle.id_cle AND i.id_etu = e.id_etu AND i.id_cours = c.id_cours AND i.id_cours = ' . $id . ' GROUP BY c.id_cours';

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