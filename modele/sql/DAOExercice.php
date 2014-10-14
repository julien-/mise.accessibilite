<?php
class DAOExercice extends DAOMysqli
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
		$this->executeQuery('INSERT INTO exercice SET titre_exo = "' . $exercice->getTitre() . '", num_exo = ' . $exercice->getNumero() . ', id_theme =' . $exercice->getTheme()->getId());
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
	
	public function delete($id)
	{
		$this->executeQuery('DELETE FROM exercice WHERE id_exo = ' . $id);
	}
	
	public function deleteByTheme($id)
	{
		$this->executeQuery('DELETE FROM exercice WHERE id_theme = ' . $id);
	}
	
	  public function getByID($id)
	  {
	  	$result = $this->executeQuery('SELECT * FROM exercice ex, theme t, cours c, etudiant e, cle WHERE ex.id_theme = t.id_theme AND c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND ex.id_exo = ' . $id);
	  	
	  	$exercice = $this->fetchArray($result);
	
	  	if ($exercice == null)
	  		return false;

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
}