<?php
class DAOExercice extends DAOMysqli
{	
	public function add(Exercice $exercice)
	{
		$this->_db->query('INSERT INTO exercice SET titre_exo = "' . $exercice->getTitre() . '", num_exo = ' . $exercice->getNumero() . ', id_theme =' . $exercice->getTheme()->getId());
	}
	  
	  public function getByID($id)
	  {
	  	$result = $this->_db->query('SELECT * FROM exercice ex, theme t, cours c, etudiant e, cle WHERE ex.id_theme = t.id_theme AND c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND ex.id_exo = ' . $id);
	  	
	  	$exercice = $result->fetch_assoc();
	
	  	if ($exercice == null)
	  		return false;
	  	echo $exercice['libelle_cours'];
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