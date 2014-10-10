<?php
class DAOCours extends DAOMysqli
{
  
  public function add(Cours $cours)
  {
  	$q = $this->_db->prepare('INSERT INTO cours SET libelle_cours = ?, couleur_calendar = ?, id_prof = ?, id_cle = ?');
  	$q->bind_param('ssss', $cours->getLibelle(), $cours->getCouleurCalendar(), $cours->getIdProf(), $cours->getIdCle());
  
  	$q->execute();
  }
  
  public function getAll()
  {
	  	$result = $this->executeQuery('SELECT * FROM cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu');
	 	
	  	$listeCours = array();
	  	while ($cours = $this->fetchArray($result)) {
	  		$listeCours[] = new Cours(array(	'id' => $cours['id_cours'], 
  								'libelle' => $cours['libelle_cours'], 
  								'couleurCalendar' => $cours['couleur_calendar'], 
  								'prof' => new Professeur(array('id' => $cours['id_etu'], 
						  								'nom' => $cours['nom_etu'], 
						  								'prenom' => $cours['prenom_etu'], 
						  								'mail' => $cours['mail_etu'], 
						  								'login' => $cours['pseudo_etu'],
						  								'pass' => $cours['pass_etu'],
						  								'admin' => $cours['admin'])),
  								'cle' => new Cle(array('id' => $cours['id_cle'],
  														'cle' => $cours['valeur_cle']))));
	  	}
	  	return $listeCours;
  }
  
  public function getAllByProf($id)
  {
  	$result = $this->executeQuery('SELECT * FROM cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND id_prof = ' . $id);
  	 
  	$listeCours = array();
  	while ($cours = $this->fetchArray($result)) {
  		$listeCours[] = new Cours(array(	'id' => $cours['id_cours'],
  				'libelle' => $cours['libelle_cours'],
  				'couleurCalendar' => $cours['couleur_calendar'],
  				'prof' => new Professeur(array('id' => $cours['id_etu'],
  						'nom' => $cours['nom_etu'],
  						'prenom' => $cours['prenom_etu'],
  						'mail' => $cours['mail_etu'],
  						'login' => $cours['pseudo_etu'],
  						'pass' => $cours['pass_etu'],
  						'admin' => $cours['admin'])),
  				'cle' => new Cle(array('id' => $cours['id_cle'],
  						'cle' => $cours['valeur_cle']))));
  	}
  	return $listeCours;
  }
  
  public function getByID($id)
  {
	$result = $this->executeQuery('SELECT * FROM cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND id_cours = ' . $id);
	$cours = $this->fetchArray($result);
  	return new Cours(array(	'id' => $cours['id_cours'], 
  								'libelle' => $cours['libelle_cours'], 
  								'couleurCalendar' => $cours['couleur_calendar'], 
  								'prof' => new Professeur(array('id' => $cours['id_etu'], 
						  								'nom' => $cours['nom_etu'], 
						  								'prenom' => $cours['prenom_etu'], 
						  								'mail' => $cours['mail_etu'], 
						  								'login' => $cours['pseudo_etu'],
						  								'pass' => $cours['pass_etu'],
						  								'admin' => $cours['admin'])),
  								'cle' => new Cle(array('id' => $cours['id_cle'],
  														'cle' => $cours['valeur_cle']))));
  }
}
