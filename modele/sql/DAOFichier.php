<?php
class DAOExercice extends DAOStandard
{	
	public function saveOrUpdate(Exercice $exercice)
	{
		if ($this->exists($exercice))
			$this->update($exercice);
		else
			$this->save($exercice);
	}
	
	public function save(Exercice $exercice)
	{
		$this->executeQuery('INSERT INTO fichiers SET id_exo = "' . $fichier->getExercice()->getId() . '", chemin_fichier = "' . $fichier->getChemin() . '", nom = "' . $fichier->getNom() . '", commentaires = "' . $fichier->getCommentaire() . '", code_lien = "' . $fichier->getCodeLien() . '", enligne = "' . $fichier->getEnLigne() . '" WHERE id_fichier = ' . $fichier->getId());
			}
	
	public function update(Fichier $fichier)
	{
		$this->executeQuery('UPDATE fichiers SET id_exo = "' . $fichier->getExercice()->getId() . '", chemin_fichier = "' . $fichier->getChemin() . '", nom = "' . $fichier->getNom() . '", commentaires = "' . $fichier->getCommentaire() . '", code_lien = "' . $fichier->getCodeLien() . '", enligne = "' . $fichier->getEnLigne() . '" WHERE id_fichier = ' . $fichier->getId());
	}
	
	public function exists(Exercice $exercice)
	{
		$result = $this->executeQuery('SELECT * FROM fichiers WHERE id_fichier = ' . $id);
		
		return $this->countRows($result) > 0;
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