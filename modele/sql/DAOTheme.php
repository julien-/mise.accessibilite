<?php
class DAOTheme extends DAOMysqli
{	
	public function add(Theme $theme)
	{
		$this->_db->query('INSERT INTO theme SET titre_theme = "' . $theme->getTitre() . '", id_cours = "' . $theme->getCours()->getId() . '"');
	}
	  
	
	public function getAllByCours($id)
	{
		$result = $this->_db->query('SELECT * FROM theme t, cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND t.id_cours = ' . $id);
		 
		$listeTheme = array();
		while ($theme = $result->fetch_assoc()) {
			$listeTheme[] = new Theme(array('id' => $theme['id_theme'], 
  								'titre' => $theme['titre_theme'], 
  								'cours' => new Cours(array(	'id' => $theme['id_cours'], 
						  								'libelle' => $theme['libelle_cours'], 
						  								'couleurCalendar' => $theme['couleur_calendar'], 
						  								'idProf' => new Professeur(array('id' => $theme['id_etu'], 
										  								'nom' => $theme['nom_etu'], 
										  								'prenom' => $theme['prenom_etu'], 
										  								'mail' => $theme['mail_etu'], 
										  								'login' => $theme['pseudo_etu'],
										  								'pass' => $theme['pass_etu'],
										  								'admin' => $theme['admin'])),
										  								'idCle' => new Cle(array('id' => $theme['id_cle'],
										  														'cle' => $theme['valeur_cle']))))));
		}
		return $listeTheme;
	}
	
	  public function getByID($id)
	  {
	  	$result = $this->_db->query('SELECT * FROM theme t, cours c, etudiant e, cle WHERE c.id_cle = cle.id_cle AND c.id_prof = e.id_etu AND t.id_cours = c.id_cours AND t.id_theme = ' . $id);
	  	
	  	$theme = $result->fetch_assoc();
	
	  	if ($theme == null)
	  		return false;
	  	
	  	return new Theme(array('id' => $theme['id_theme'], 
  								'titre' => $theme['titre_theme'], 
  								'cours' => new Cours(array(	'id' => $theme['id_cours'], 
						  								'libelle' => $theme['libelle_cours'], 
						  								'couleurCalendar' => $theme['couleur_calendar'], 
						  								'idProf' => new Professeur(array('id' => $theme['id_etu'], 
										  								'nom' => $theme['nom_etu'], 
										  								'prenom' => $theme['prenom_etu'], 
										  								'mail' => $theme['mail_etu'], 
										  								'login' => $theme['pseudo_etu'],
										  								'pass' => $theme['pass_etu'],
										  								'admin' => $theme['admin'])),
										  								'idCle' => new Cle(array('id' => $theme['id_cle'],
										  														'cle' => $theme['valeur_cle']))))));
	  }
}