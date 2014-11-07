<?php
class DAOExercice extends DAOStandard
{	
	public function saveOrUpdate(Exercice $exercice)
	{
		if (exists($exercice))
			update($exercice);
		else
			save($exercice);
	}
	
	public function save(Exercice $exercice)
	{
		echo $this->getNextAvailableNumber($exercice->getTheme());

		$this->executeQuery('INSERT INTO exercice SET titre_exo = "' . $exercice->getTitre() . '", num_exo = ' . $this->getNextAvailableNumber($exercice->getTheme()) . ', id_theme =' . $exercice->getTheme());
	}
	
	public function update(Exercice $exercice)
	{
		$this->executeQuery('UPDATE exercice SET titre_exo = "' . $exercice->getTitre() . '", num_exo = ' . $exercice->getNumero() . ', id_theme =' . $exercice->getTheme()->getId() . ' WHERE id_exo = ' . $exercice->getId());
	}
	
	public function exists(Exercice $exercice)
	{
		$result = $this->executeQuery('SELECT * FROM exercice ex, theme t, cours c, etudiant e, cle WHERE ex.id_theme = t.id_theme AND c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND ex.id_exo = ' . $id);
		
		return $this->countRows($result) > 0;
	}
	
	public function getNextAvailableNumber($idTheme)
	{
		$result = $this->executeQuery('SELECT max(num_exo)+1 as num FROM exercice WHERE id_theme = ' . $idTheme);
		echo "ok";
		$numero = $this->fetchArray($result);
		return $numero['num'];
	}
	
	public function delete($id)
	{
		$daoAvancement = new DAOAvancement(null);
		
		$this->executeQuery('DELETE FROM exercice WHERE id_exo = ' . $id);
		$daoAvancement->deleteByExercice($id);
	}
	
	public function deleteByTheme($id)
	{
		$daoAvancement = new DAOAvancement(null);
		
		$this->executeQuery('DELETE FROM exercice WHERE id_theme = ' . $id);
		$daoAvancement->deleteByExercice($id);
	}
	
	  public function getByID($id)
	  {
	  	$result = $this->executeQuery('SELECT * FROM exercice ex, theme t, cours c, etudiant e, cle WHERE ex.id_theme = t.id_theme AND c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND ex.id_exo = ' . $id);
	  	
	  	if ($result == null)
	  		return false;
	  	
	  	$exercice = $this->fetchArray($result);

	  	return new Exercice (array('id' => $exercice['id_exo'],
	  								'titre_exo' => $exercice['titre_exo'],
	  								'numero' => $exercice['num_exo'],
	  								'theme' => new Theme(array('id' => $exercice['id_theme'], 
								  								'titre' => $exercice['titre_theme'], 
								  								'cours' => new Cours(array(	'id' => $exercice['id_cours'], 
														  								'libelle' => $exercice['libelle_cours'], 
														  								'couleurCalendar' => $exercice['couleur_calendar'], 
														  								'prof' => new Professeur(array('id' => $exercice['id_etu'], 
																		  								'nom' => $exercice['nom_etu'], 
																		  								'prenom' => $exercice['prenom_etu'], 
																		  								'mail' => $exercice['mail_etu'], 
																		  								'login' => $exercice['pseudo_etu'],
																		  								'pass' => $exercice['pass_etu'],
																		  								'admin' => $exercice['admin'])),
														  								'cle' => new Cle(array('id' => $exercice['id_cle'],
												  														'cle' => $exercice['valeur_cle']))))))));
	  }
	  
	  public function getByAllByTheme($id)
	  {
	  	$result = $this->executeQuery('SELECT * FROM exercice ex, theme t, cours c, etudiant e, cle WHERE ex.id_theme = t.id_theme AND c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND ex.id_theme = ' . $id);
	  
	  
	  
	  	$listResult = array();
	  	
	  	while($exercice = $this->fetchArray($result))
	  	{
		  	$listResult[] = new Exercice (array('id' => $exercice['id_exo'],
		  			'titre' => $exercice['titre_exo'],
		  			'numero' => $exercice['num_exo'],
		  			'theme' => new Theme(array('id' => $exercice['id_theme'],
		  					'titre' => $exercice['titre_theme'],
		  					'cours' => new Cours(array(	'id' => $exercice['id_cours'],
		  							'libelle' => $exercice['libelle_cours'],
		  							'couleurCalendar' => $exercice['couleur_calendar'],
		  							'prof' => new Professeur(array('id' => $exercice['id_etu'],
		  									'nom' => $exercice['nom_etu'],
		  									'prenom' => $exercice['prenom_etu'],
		  									'mail' => $exercice['mail_etu'],
		  									'login' => $exercice['pseudo_etu'],
		  									'pass' => $exercice['pass_etu'],
		  									'admin' => $exercice['admin'])),
		  							'cle' => new Cle(array('id' => $exercice['id_cle'],
		  									'cle' => $exercice['valeur_cle']))))))));
	  	}
	  	
	  	return $listResult;
	  }
}