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
		$daoEtudiant = new DAOEtudiant($db);
		$daoSeance = new DAOSeance($db);
		
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
			return new Remarque(array(	'seance' => $daoSeance->getByID($remarque['id_seance']),
										'etudiant' => $daoEtudiant->getByID($remarque['id_etu']),
										'remarque' => $remarque['remarque']));
		}		
	}
}
?>