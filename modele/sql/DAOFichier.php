<?php
class DAOFichier extends DAOStandard
{	
	public function saveOrUpdate(Fichier $fichier)
	{
		if ($this->exists($fichier))
			$this->update($fichier);
		else
			$this->save($fichier);
	}
	
	public function save(Fichier $fichier)
	{
		$this->executeQuery('INSERT INTO fichiers SET id_exo = "' . $fichier->getExercice() . '", chemin_fichier = "' . $fichier->getChemin() . '", nom = "' . $fichier->getNom() . '", commentaires = "' . $fichier->getCommentaire() . '", code_lien = "' . $fichier->getCodeLien() . '", enligne = "' . $fichier->getEnLigne().'"');
	}
	
	public function update(Fichier $fichier)
	{
		$this->executeQuery('UPDATE fichiers SET telechargements = ' . $fichier->getTelechargements() . ', id_exo = "' . $fichier->getExercice()->getId() . '", chemin_fichier = "' . $fichier->getChemin() . '", nom = "' . $fichier->getNom() . '", commentaires = "' . $fichier->getCommentaire() . '", code_lien = "' . $fichier->getCodeLien() . '", enligne = "' . $fichier->getEnLigne() . '" WHERE id_fichier = ' . $fichier->getId());
	}
	
	public function exists(Fichier $fichier)
	{
		$result = $this->executeQuery('SELECT * FROM fichiers WHERE id_fichier = ' . $fichier->getId());
		
		return $this->countRows($result) > 0;
	}
	
	public function getAll()
	{
		$daoExercice = new DAOExercice($db);
		$result = $this->executeQuery('SELECT * FROM fichiers');
		 
		if ($result == null)
			return false;
		 
		$listResult = array();
	
		while($fichier = $this->fetchArray($result))
		{
			$daoExercice->getByID($fichier['id_exo']);
			$listResult[] = new Fichier (array(
							'id' => $fichier['id_fichier'],
							'exercice' => $daoExercice->getByID($fichier['id_exo']),
							'chemin' => $fichier['chemin_fichier'],
							'nom' => $fichier['nom'],
							'commentaire' => $fichier['commentaires'],
							'codeLien' => $fichier['code_lien'],
							'enLigne' => $fichier['enligne'],
							'telechargements' => $fichier['telechargements']
							));							
		}
	
		return $listResult;
	}
	
	public function getAllByExercice($id)
	{
		$daoExercice = new DAOExercice($db);
		$result = $this->executeQuery('SELECT * FROM fichiers WHERE id_exo = ' . $id);
			
		if ($result == null)
			return false;
			
		$listResult = array();
	
		while($fichier = $this->fetchArray($result))
		{
			$daoExercice->getByID($fichier['id_exo']);
			$listResult[] = new Fichier (array(
					'id' => $fichier['id_fichier'],
					'exercice' => $daoExercice->getByID($fichier['id_exo']),
					'chemin' => $fichier['chemin_fichier'],
					'nom' => $fichier['nom'],
					'commentaire' => $fichier['commentaires'],
					'codeLien' => $fichier['code_lien'],
					'enLigne' => $fichier['enligne'],
					'telechargements' => $fichier['telechargements']
			));
		}
	
		return $listResult;
	}
	
	public function getByCodeLien($code)
	{
		$daoExercice = new DAOExercice($db);
		$result = $this->executeQuery('SELECT * FROM fichiers WHERE code_lien = "' . $code . '"');
			
		if ($result == null)
			return false;

			$fichier = $this->fetchArray($result);

			$daoExercice->getByID($fichier['id_exo']);
			return new Fichier (array(
					'id' => $fichier['id_fichier'],
					'exercice' => $daoExercice->getByID($fichier['id_exo']),
					'chemin' => $fichier['chemin_fichier'],
					'nom' => $fichier['nom'],
					'commentaire' => $fichier['commentaires'],
					'codeLien' => $fichier['code_lien'],
					'enLigne' => $fichier['enligne'],
					'telechargements' => $fichier['telechargements']
			));
	
	}
	
	public function getByID($fichier)
	{
		$daoExercice = new DAOExercice($db);
		$result = $this->executeQuery('SELECT * FROM fichiers WHERE id_fichier = ' . $fichier);
			
		if ($result == null)
			return false;
	
		$fichier = $this->fetchArray($result);
	
		$daoExercice->getByID($fichier['id_exo']);
		return new Fichier (array(
				'id' => $fichier['id_fichier'],
				'exercice' => $daoExercice->getByID($fichier['id_exo']),
				'chemin' => $fichier['chemin_fichier'],
				'nom' => $fichier['nom'],
				'commentaire' => $fichier['commentaires'],
				'codeLien' => $fichier['code_lien'],
				'enLigne' => $fichier['enligne'],
				'telechargements' => $fichier['telechargements']
		));
	
	}
	
	public function count()
	{
		$result = $this->executeQuery('SELECT * FROM fichiers');
		
		return $this->countRows($result);
	}
	
	public function countByExercice($id)
	{
		$result = $this->executeQuery('SELECT * FROM fichiers WHERE id_exo = ' . $id);
	
		return $this->countRows($result);
	}
	
	public function delete($id)
	{
		$this->executeQuery('DELETE FROM fichiers WHERE id_fichier = ' . $id);
	}
	
	public function deleteByExercice($id)
	{
		$this->executeQuery('DELETE FROM fichiers WHERE id_exo = ' . $id);
	}
}