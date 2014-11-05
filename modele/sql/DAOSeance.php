<?php
class DAOSeance extends DAOStandard
{	
	public function save(Seance $seance)
	{
		$this->executeQuery('INSERT INTO seance SET date_seance = "' . $seance->getDate() . '", id_cours = ' . $seance->getCours());
	}
	
	public function update(Seance $seance)
	{
		$this->executeQuery('UPDATE seance SET date_seance = "' . $seance->getId() . '", id_cours = ' . $seance->getCours()->getId());
	}
	  
	public function delete($id)
	{
		$this->executeQuery('DELETE FROM seance WHERE id_seance = ' . $id);
	}
	
	public function getByID($id)
	{
		$result = $this->executeQuery('SELECT * 
										FROM seance s, cours c, cle cl, etudiant e 
										WHERE s.id_seance = ' .$id. ' 
										AND s.id_cours = c.id_cours 
										AND c.id_prof = e.id_etu 
										AND c.id_cle = cl.id_cle');
			
		$seance = $this->fetchArray($result);
	
		if ($seance == null)
			return false;
	
		return new Seance(array('id' => $seance['id_seance'],
								'date' => $seance['date_seance'],
								'cours' => new Cours(array(	'id' => $seance['id_cours'], 
							  								'libelle' => $seance['libelle_cours'], 
							  								'couleurCalendar' => $seance['couleur_calendar'], 
							  								'prof' => new Professeur(array('id' => $seance['id_etu'], 
													  								'nom' => $seance['nom_etu'], 
													  								'prenom' => $seance['prenom_etu'], 
													  								'mail' => $seance['mail_etu'], 
													  								'login' => $seance['pseudo_etu'],
													  								'pass' => $seance['pass_etu'],
													  								'admin' => $seance['admin'])),
							  								'cle' => new Cle(array('id' => $seance['id_cle'],
							  														'cle' => $seance['valeur_cle']))))));
		
	}
	public function getAll()
	{
		$result = $this->executeQuery('SELECT * FROM seance s, cours c, cle, etudiant e WHERE c.id_prof = e.id_etu AND cle.id_cle = c.id_cle AND s.id_cours = c.id_cours ORDER BY date_seance ASC');
		 
		$listeSeance = array();
		while ($seance = $this->fetchArray($result)) {
			$listeSeance[] = new Seance(array(	'id' => $seance['id_seance'],
										'date' => $seance['date_seance'],
										'cours' => new Cours(array(	'id' => $seance['id_cours'], 
									  								'libelle' => $seance['libelle_cours'], 
									  								'couleurCalendar' => $seance['couleur_calendar'], 
									  								'prof' => new Professeur(array('id' => $seance['id_etu'], 
															  								'nom' => $seance['nom_etu'], 
															  								'prenom' => $seance['prenom_etu'], 
															  								'mail' => $seance['mail_etu'], 
															  								'login' => $seance['pseudo_etu'],
															  								'pass' => $seance['pass_etu'],
															  								'admin' => $seance['admin'])),
									  								'cle' => new Cle(array('id' => $seance['id_cle'],
									  														'cle' => $seance['valeur_cle']))))));
		}
		return $listeSeance;
	}
	  
	public function getAllByCours($id)
	{
		$result = $this->executeQuery('SELECT * FROM seance s, cours c, cle, etudiant e WHERE c.id_prof = e.id_etu AND cle.id_cle = c.id_cle AND s.id_cours = c.id_cours AND s.id_cours =' . $id);
			
		$listeSeance = array();
		while ($seance = $this->fetchArray($result)) {
			$listeSeance[] = new Seance(array(	'id' => $seance['id_seance'],
					'date' => $seance['date_seance'],
					'cours' => new Cours(array(	'id' => $seance['id_cours'],
							'libelle' => $seance['libelle_cours'],
							'couleurCalendar' => $seance['couleur_calendar'],
							'prof' => new Professeur(array('id' => $seance['id_etu'],
									'nom' => $seance['nom_etu'],
									'prenom' => $seance['prenom_etu'],
									'mail' => $seance['mail_etu'],
									'login' => $seance['pseudo_etu'],
									'pass' => $seance['pass_etu'],
									'admin' => $seance['admin'])),
							'cle' => new Cle(array('id' => $seance['id_cle'],
									'cle' => $seance['valeur_cle']))))));
		}
		return $listeSeance;
	}
}