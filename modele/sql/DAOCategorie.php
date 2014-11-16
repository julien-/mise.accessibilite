<?php
class DAOCategorie extends DAOStandard
{
	public function save(Categorie $categorie)
	{
		$this->executeQuery('INSERT INTO forum_categorie SET titre_categorie = "' . $categorie->getTitre() . '", description_categorie = "' . $categorie->getDescription() . '", id_cours = ' . $categorie->getCours() . ', id_categorie_parent = null');
	}
	
	
	public function delete($id)
	{
		$daoSujet = new DAOSujet($db);
		$daoSujet->deleteByCategorie($id);
		
		$this->executeQuery("DELETE FROM forum_categorie WHERE id_categorie =" . $id);
	}
	
	public function getNbSujets($id)
	{
		$ressource = $this->executeQuery('SELECT * FROM forum_sujets WHERE id_categorie = ' . $id);
	
		return $this->countRows($ressource);
	}
	
	public function getByID($id)
	{
		$daoCours = new DAOCours($db);
		
		$ressource = $this->executeQuery("SELECT * 
				FROM forum_categorie f, cours c, cle, etudiant e 
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle");
		
		$listeResult = array();
		
		$categorie = $this->fetchArray($ressource);
		return new Categorie(array('id' => $categorie['id_categorie'],
					'titre' => $categorie['titre_categorie'],
					'description' => $categorie['description_categorie'],
					'cours' => $daoCours->getByID($categorie['id_cours']),
					'parent' => $categorie['id_categorie_parent']
			));
	}
	
	public function getAllByCoursWithStats($idCours)
	{
		$daoCours = new DAOCours(null);
		$ressource = $this->executeQuery('SELECT c.id_categorie, id_categorie_parent, titre_categorie, description_categorie, id_cours, count(DISTINCT(s.id_sujet)) as nbSujets, count(r.id_reponse) as nbMessages
        FROM forum_categorie c
        LEFT JOIN forum_sujets s ON s.id_categorie = c.id_categorie
        LEFT JOIN forum_reponses r ON r.correspondance_sujet = s.id_sujet
        WHERE c.id_cours = ' . $idCours .'                            
        GROUP BY c.id_categorie
        ORDER BY s.id_categorie ASC
        ');
		
		$listeResult = array();
		
		while($categorie = $this->fetchArray($ressource))
		{
			$listeResult[] = new Categorie(array('id' => $categorie['id_categorie'],
					'titre' => $categorie['titre_categorie'],
					'description' => $categorie['description_categorie'],
					'cours' => $daoCours->getByID($categorie['id_cours']),
					'nbMessages'=> $categorie['nbMessages'],
					'nbSujets' => $categorie['nbSujets'],
					'parent' => $categorie['id_categorie_parent']
			));
		}
		
		return $listeResult;
	}
	
	
}
