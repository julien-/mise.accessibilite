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
	  	$result = $this->_db->query('SELECT * FROM cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu');
	 	
	  	$listeCours = array();
	  	while ($cours = $result->fetch_assoc()) {
	  		$listeCours[] = new Cours(array(	'id' => $cours['id_cours'], 
  								'libelle' => $cours['libelle_cours'], 
  								'couleurCalendar' => $cours['couleur_calendar'], 
  								'idProf' => new Professeur(array('id' => $cours['id_etu'], 
						  								'nom' => $cours['nom_etu'], 
						  								'prenom' => $cours['prenom_etu'], 
						  								'mail' => $cours['mail_etu'], 
						  								'login' => $cours['pseudo_etu'],
						  								'pass' => $cours['pass_etu'],
						  								'admin' => $cours['admin'])),
  								'idCle' => new Cle(array('id' => $cours['id_cle'],
  														'cle' => $cours['valeur_cle']))));
	  	}
	  	return $listeCours;
  }
  
  public function getAllByProf(Professeur $prof)
  {
  	$result = $this->_db->query('SELECT * FROM cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND id_prof = ' . $prof->getId());
  	 
  	$listeCours = array();
  	while ($cours = $result->fetch_assoc()) {
  		$listeCours[] = new Cours(array(	'id' => $cours['id_cours'],
  				'libelle' => $cours['libelle_cours'],
  				'couleurCalendar' => $cours['couleur_calendar'],
  				'idProf' => new Professeur(array('id' => $cours['id_etu'],
  						'nom' => $cours['nom_etu'],
  						'prenom' => $cours['prenom_etu'],
  						'mail' => $cours['mail_etu'],
  						'login' => $cours['pseudo_etu'],
  						'pass' => $cours['pass_etu'],
  						'admin' => $cours['admin'])),
  				'idCle' => new Cle(array('id' => $cours['id_cle'],
  						'cle' => $cours['valeur_cle']))));
  	}
  	return $listeCours;
  }
  
  /*public function getAllByEtu(Etudiant $etu)
  {
  	$result = $this->_db->query('SELECT * FROM cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND id_prof = ' . $etu->getId());
  
  	$listeCours = array();
  	while ($cours = $result->fetch_assoc()) {
  		$listeCours[] = new Cours(array(	'id' => $cours['id_cours'],
  				'libelle' => $cours['libelle_cours'],
  				'couleurCalendar' => $cours['couleur_calendar'],
  				'idProf' => new Professeur(array('id' => $cours['id_etu'],
  						'nom' => $cours['nom_etu'],
  						'prenom' => $cours['prenom_etu'],
  						'mail' => $cours['mail_etu'],
  						'login' => $cours['pseudo_etu'],
  						'pass' => $cours['pass_etu'],
  						'admin' => $cours['admin'])),
  				'idCle' => new Cle(array('id' => $cours['id_cle'],
  						'cle' => $cours['valeur_cle']))));
  	}
  	return $listeCours;
  }*/
  
  public function getAllByEtu(Etudiant $etu)
  {
  	$result = $this->_db->query('SELECT * FROM cours, etudiant, inscription, cle WHERE cours.id_prof = etudiant.id_etu AND cours.id_cle = cle.id_cle AND inscription.id_etu = ' . $etu->getId() . ' AND inscription.id_cours = cours.id_cours');
  	$listeCours = array();
  	while ($cours = $result->fetch_assoc()) {
  		$listeCours[] = new Cours(array(	'id' => $cours['id_cours'],
  				'libelle' => $cours['libelle_cours'],
  				'couleurCalendar' => $cours['couleur_calendar'],
  				'idEtu' => new Etudiant(array('id' => $cours['id_etu'],
  						'nom' => $cours['nom_etu'],
  						'prenom' => $cours['prenom_etu'],
  						'mail' => $cours['mail_etu'],
  						'login' => $cours['pseudo_etu'],
  						'pass' => $cours['pass_etu'],
  						'admin' => $cours['admin'])),
  				'idCle' => new Cle(array('id' => $cours['id_cle'],
  						'cle' => $cours['valeur_cle']))));
  	}
  	return $listeCours;
  }
  
  public function getByID($id)
  {
	$result = $this->_db->query('SELECT * FROM cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND id_cours = ' . $id);
	$cours = $result->fetch_assoc();
  	return new Cours(array(	'id' => $cours['id_cours'], 
  								'libelle' => $cours['libelle_cours'], 
  								'couleurCalendar' => $cours['couleur_calendar'], 
  								'idProf' => new Professeur(array('id' => $cours['id_etu'], 
						  								'nom' => $cours['nom_etu'], 
						  								'prenom' => $cours['prenom_etu'], 
						  								'mail' => $cours['mail_etu'], 
						  								'login' => $cours['pseudo_etu'],
						  								'pass' => $cours['pass_etu'],
						  								'admin' => $cours['admin'])),
  								'idCle' => new Cle(array('id' => $cours['id_cle'],
  														'cle' => $cours['valeur_cle']))));
  }
}