<?php 
class DAORemarque extends DAOStandard
{	
	public function saveOrUpdate(Remarque $remarque)
	{
		if (exists($remarque))
			update($remarque);
		else
			save($remarque);
	}
	
	public function save(Remarque $remarque)
	{
		$this->executeQuery('INSERT INTO remarque_seances SET id_seance = ' . $remarque->getSeance()->getId() . ', id_etu = ' . $remarque->getEtudiant()->getId() . ', remarque = "' . $remarque->getRemarque() . '"');
	}
	
	public function saveByIdSeanceIdEtudiantRemarque($id_seance, $id_etu, $remarque)
	{
		$this->executeQuery('INSERT INTO remarque_seances SET id_seance = ' . $id_seance . ', id_etu = ' . $id_etu . ', remarque = "' . $remarque . '"');
	}
	
	public function update(Remarque $remarque)
	{
		$this->executeQuery('UPDATE remarque_seances SET id_seance = ' . $remarque->getSeance()->getId() . ', id_etu = ' . $remarque->getEtudiant()->getId() . ', remarque =' . $remarque->getRemarque());
	}
	
	public function updateRemarqueByIdSeanceIdEtudiant($id_seance, $id_etu, $remarque)
	{
		$this->executeQuery('UPDATE remarque_seances 
							SET remarque = "' . $remarque . '"
							WHERE id_seance = ' . $id_seance . ' 
							AND id_etu = ' . $id_etu);
	}
	
	public function getByEtuSeance($id_etu, $id_seance)
	{
		
		$result = $this->executeQuery('SELECT * FROM remarque_seances, etudiant e1, etudiant e2, seance, cours, cle 
						WHERE remarque_seances.id_seance = '.$id_seance.' 
						AND remarque_seances.id_etu = '.$id_etu.'
						AND remarque_seances.id_etu = e1.id_etu
						AND remarque_seances.id_seance = seance.id_seance
						AND seance.id_cours = cours.id_cours
						AND cours.id_prof = e2.id_etu
						AND cours.id_cle = cle.id_cle');
			
		$remarque = $this->fetchArray($result);
		
		if ($remarque == null)
			return false;
		else 
		{
			return new Remarque(array('seance' => new Seance(array('id' => $remarque['id_seance'],
																	'date' => $remarque['date_seance'],
																	'cours' => new Cours(array(	'id' => $remarque['id_cours'], 
																  								'libelle' => $remarque['libelle_cours'], 
																  								'couleurCalendar' => $remarque['couleur_calendar'], 
																  								'prof' => new Professeur(array('id' => $remarque['id_etu'], 
																						  										'nom' => $remarque['nom_etu'], 
																						  										'prenom' => $remarque['prenom_etu'], 
																						  										'mail' => $remarque['mail_etu'], 
																						  										'login' => $remarque['pseudo_etu'],
																						  										'pass' => $remarque['pass_etu'],
																						  										'admin' => $remarque['admin'])),
																  								'cle' => new Cle(array('id' => $remarque['id_cle'],
																  														'cle' => $remarque['valeur_cle'])))))),
									'etudiant' => new Etudiant(array('id' => $remarque['id_etu'],
															  	 'nom' => $remarque['nom_etu'],
															  	 'prenom' => $remarque['prenom_etu'],
															  	 'mail' => $remarque['mail_etu'],
															  	 'login' => $remarque['pseudo_etu'],
															  	 'pass' => $remarque['pass_etu'],
															  	 'admin' => $remarque['admin'])),
									'remarque' => $remarque['remarque']));
		}		
	}
}
?>