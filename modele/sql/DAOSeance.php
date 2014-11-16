<?php
class DAOSeance extends DAOStandard
{
public function save(Seance $seance)
	{
		$this->executeQuery('INSERT INTO seance SET date_seance = "' . $seance->getDate() . '", id_cours = ' . $seance->getCours());
	}
	
	public function update(Seance $seance)
	{
		$this->executeQuery('UPDATE seance SET date_seance = "' . $seance->getDate() . '", id_cours = ' . $seance->getCours()->getId() . ' WHERE id_seance = ' . $seance->getId());
	}
	 
	public function delete($id)
	{
		$this->executeQuery('DELETE FROM seance WHERE id_seance = ' . $id);
	}

	public function getByID($id)
	{
		$daoCours = new DAOCours($db);

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
				'cours' => $daoCours->getByID($seance['id_cours'])
		));

	}
	public function getAll()
	{
		$daoCours = new DAOCours($db);

		$result = $this->executeQuery('SELECT * FROM seance s, cours c, cle, etudiant e WHERE c.id_prof = e.id_etu AND cle.id_cle = c.id_cle AND s.id_cours = c.id_cours ORDER BY date_seance ASC');
			
		$listeSeance = array();
		while ($seance = $this->fetchArray($result)) {
			$listeSeance[] = new Seance(array(	'id' => $seance['id_seance'],
					'date' => $seance['date_seance'],
					'cours' => $daoCours->getByID($seance['id_cours'])
			));
		}
		return $listeSeance;
	}
	 
	public function getAllByCours($id)
	{
		$daoCours = new DAOCours($db);

		$result = $this->executeQuery('SELECT * FROM seance s, cours c, cle, etudiant e WHERE c.id_prof = e.id_etu AND cle.id_cle = c.id_cle AND s.id_cours = c.id_cours AND s.id_cours =' . $id);
			
		$listeSeance = array();
		while ($seance = $this->fetchArray($result)) {
			$listeSeance[] = new Seance(array(	'id' => $seance['id_seance'],
					'date' => $seance['date_seance'],
					'cours' => $daoCours->getByID($seance['id_cours'])
			));
		}
		return $listeSeance;
	}
}
