<?php
class DAOCours extends DAOMysqli
{
  
	public function save(Cours $cours)
	{
  		$this->executeQuery('INSERT INTO cours SET libelle_cours = "' . $cours->getLibelle() . '", couleur_calendar = ' . $cours->getCouleurCalendar() . ' , id_prof = ' . $cours->getProf()->getId() . ', id_cle = ' . $cours->getCle()->getId());
	}
	
	public function update(Cours $cours)
	{
		$this->executeQuery('UPDATE cours SET libelle_cours = "' . $cours->getLibelle() . '", couleur_calendar = ' . $cours->getCouleurCalendar() . ' , id_prof = ' . $cours->getProf()->getId() . ', id_cle = ' . $cours->getCle()->getId() . ' WHERE id_cours = ' . $cours->getId());
	}
	
	public function saveOrUpdate(Cours $cours)
	{
		if (exists($cours))
			$this->update($cours);
		else
			$this->save($cours);
	}
  
  	public function exists(Cours $cours)
  	{
  		$result = $this->executeQuery('SELECT * FROM cours WHERE id_cours = ' . $cours->getId());
  	
  		return $this->countRows($result) > 0;
  	}
  
  	public function delete($id)
  	{
  		$this->executeQuery('DELETE FROM cours WHERE id_cours = ' . $id);
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
