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

		$numero = $this->fetchArray($result);

		if ($numero['num'] == '')
			return 1;
		else 
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
	  	$daoTheme = new DAOTheme($db);
	  	
	  	$result = $this->executeQuery('SELECT * FROM exercice ex, theme t, cours c, etudiant e, cle WHERE ex.id_theme = t.id_theme AND c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND ex.id_exo = ' . $id);
	  	
	  	if ($result == null)
	  		return false;
	  	
	  	$exercice = $this->fetchArray($result);

	  	return new Exercice (array('id' => $exercice['id_exo'],
	  								'titre_exo' => $exercice['titre_exo'],
	  								'numero' => $exercice['num_exo'],
	  								'theme' => $daoTheme->getByID($exercice['id_theme'])
	  	));
	  }
	  
	  public function getByAllByTheme($id)
	  {
	  	$daoTheme = new DAOTheme($db);
	  	
	  	$result = $this->executeQuery('SELECT * FROM exercice ex, theme t, cours c, etudiant e, cle WHERE ex.id_theme = t.id_theme AND c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND ex.id_theme = ' . $id . ' ORDER BY num_exo');
	  
	  	$listResult = array();
	  	
	  	while($exercice = $this->fetchArray($result))
	  	{
		  	$listResult[] = new Exercice (array('id' => $exercice['id_exo'],
		  			'titre' => $exercice['titre_exo'],
		  			'numero' => $exercice['num_exo'],
		  			'theme' => $daoTheme->getByID($exercice['id_theme'])
		  	));
	  	}
	  	
	  	return $listResult;
	  }
}