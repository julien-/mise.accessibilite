<?php
class DAOTheme extends DAOStandard
{	
	public function saveOrUpdate($theme)
	{
		if (exists($theme))
			update($theme);
		else
			save($theme);
	}
	
	public function save(Theme $theme)
	{
		$this->executeQuery('INSERT INTO theme SET titre_theme = "' . $theme->getTitre() . '", id_cours = "' . $theme->getCours() . '"');
	}
	
	public function update(Theme $theme)
	{
		$this->executeQuery('UPDATE theme SET titre_theme = "' . $theme->getTitre() . '", id_cours = "' . $theme->getCours()->getId() . '" WHERE id_theme = ' . $theme->getId());
	}
	
	public function exists($theme)
	{
		$result = $this->executeQuery('SELECT * FROM theme t, cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND t.id_theme = ' . $id);
		
		return $this->countRows($result);
	}
	
	public function countByCours($idCours)
	{
		$result = $this->executeQuery('SELECT * FROM theme WHERE id_cours = ' . $idCours);
	
		return $this->countRows($result);
	}
	
	public function delete($id)
	{
		$daoAvancement = new DAOAvancement($db);
		$daoExercice = new DAOExercice($db);
		
		// Suppression du thème
		$this->executeQuery('DELETE FROM theme WHERE id_theme = ' . $id);
		
		// Suppression des exercices du thème
		$daoExercice->deleteByTheme($id);
		
		// Suppression des avancements pour ce thème
		$listExercice = $daoExercice->getByAllByTheme($id);
		foreach($listExercice as $exercice)
		{
			$daoAvancement->deleteByExercice($exercice->getId());
		}
		
	}
	
	public function deleteByCours($id)
	{
		$this->executeQuery('DELETE FROM theme WHERE id_cours = ' . $id);
	}
	  
	public function getAllByCours($id)
	{
		$daoCours = new DAOCours($db);
		
		$result = $this->executeQuery('SELECT * FROM theme t, cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND t.id_cours = ' . $id);
		 
		$listeTheme = array();
		while ($theme = $this->fetchArray($result)) {
			$listeTheme[] = new Theme(array('id' => $theme['id_theme'], 
  								'titre' => $theme['titre_theme'], 
								'cours' => $daoCours->getByID($theme['id_cours'])
			));
		}
		return $listeTheme;
	}
	
  	  public function getByID($id)
	  {
	  	$daoCours = new DAOCours($db);
	  	
	  	$result = $this->executeQuery('SELECT * FROM theme t, cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND t.id_theme = ' . $id);
	  	
	  	$theme = $this->fetchArray($result);
	
	  	if ($theme == null)
	  		return false;
	  	
	  	return new Theme(array('id' => $theme['id_theme'], 
  								'titre' => $theme['titre_theme'], 
  								'cours' => $daoCours->getByID($theme['id_cours'])	  			
	  	));
	  }
}