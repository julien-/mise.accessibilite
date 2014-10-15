<?php
class DAOCategorie extends DAOStandard
{
	public function getByID($id)
	{
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
					'cours' => new Cours(array(	'id' => $categorie['id_cours'], 
  								'libelle' => $categorie['libelle_cours'], 
  								'couleurCalendar' => $categorie['couleur_calendar'], 
  								'prof' => new Professeur(array('id' => $categorie['id_etu'], 
						  								'nom' => $categorie['nom_etu'], 
						  								'prenom' => $categorie['prenom_etu'], 
						  								'mail' => $categorie['mail_etu'], 
						  								'login' => $categorie['pseudo_etu'],
						  								'pass' => $categorie['pass_etu'],
						  								'admin' => $categorie['admin'])),
  								'cle' => new Cle(array('id' => $categorie['id_cle'],
  														'cle' => $categorie['valeur_cle'])))),
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
