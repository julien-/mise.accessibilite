<?php
class DAOSujet extends DAOStandard
{
	public function save(Sujet $sujet)
	{
		$this->executeQuery('INSERT INTO forum_sujets SET auteur = ' . $sujet->getAuteur() . ', titre="' . $sujet->getTitre() . '", date_derniere_reponse = now(), id_categorie = ' . $sujet->getCategorie());
	}
	
	public function delete($id)
	{
		$daoMessage = new DAOMessage($db);
		$daoMessage->deleteBySujet($id);
		
		$this->executeQuery('DELETE FROM forum_sujets WHERE id_sujet = ' . $id);
	}
	
	public function deleteByCategorie($id)
	{
		$listeSujets = $this->getAllByCategorieWithStats($id);

		foreach($listeSujets as $sujet)
		{
			$this->delete($sujet->getId());
		}
	}
	
	public function getByID($id)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$ressource = $this->executeQuery("SELECT * 
				FROM forum_categorie f, cours c, cle, etudiant e, forum_sujets s 
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle
				AND s.auteur = e.id_etu
				AND s.id_categorie = f.id_categorie
				AND id_sujet = " . $id);
		
		
		$sujet = $this->fetchArray($ressource);
			return new Sujet(array('id' => $sujet['id_sujet'],
					'auteur' => new Etudiant(array(	'id' => $sujet['id_etu'], 
  								'nom' => $sujet['nom_etu'], 
  								'prenom' => $sujet['prenom_etu'], 
  								'mail' => $sujet['mail_etu'], 
  								'login' => $sujet['pseudo_etu'],
  								'pass' => $sujet['pass_etu'],
  								'admin' => $sujet['admin'])),
					'titre' => $sujet['titre'],
					'date_derniere_reponse' => $sujet['date_derniere_reponse'],
					'categorie' => new Categorie(array('id' => $sujet['id_categorie'],
										'titre' => $sujet['titre_categorie'],
										'description' => $sujet['description_categorie'],
										'cours' => new Cours(array(	'id' => $sujet['id_cours'], 
					  								'libelle' => $sujet['libelle_cours'], 
					  								'couleurCalendar' => $sujet['couleur_calendar'], 
					  								'prof' => $daoEtudiant->getByID($sujet['auteur']),
					  								'cle' => new Cle(array('id' => $sujet['id_cle'],
					  														'cle' => $sujet['valeur_cle'])))),
										'parent' => $sujet['id_categorie_parent']
			))));
	}
	
	public function getByMessage($id)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$ressource = $this->executeQuery("SELECT *
				FROM forum_reponses, forum_categorie f, cours c, cle, etudiant e, forum_sujets s
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle
				AND s.auteur = e.id_etu
				AND s.id_categorie = f.id_categorie
				AND forum_reponses.id_reponse = " . $id);
	
		$sujet = $this->fetchArray($ressource);
		return new Sujet(array(
				'id' => $sujet['id_sujet'],
				'titre' => $sujet['titre'],
				'date_derniere_reponse' => $sujet['date_derniere_reponse'],
				'categorie' => new Categorie(array('id' => $sujet['id_categorie'],
						'titre' => $sujet['titre_categorie'],
						'description' => $sujet['description_categorie'],
						'cours' => new Cours(array(	'id' => $sujet['id_cours'],
								'libelle' => $sujet['libelle_cours'],
								'couleurCalendar' => $sujet['couleur_calendar'],
								'cle' => new Cle(array('id' => $sujet['id_cle'],
										'cle' => $sujet['valeur_cle'])))),
						'parent' => $sujet['id_categorie_parent']
				))));
	}
	
	public function getLastFiveByCours($idCours)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$ressource = $this->executeQuery("SELECT *
				FROM forum_categorie f, cours c, cle, etudiant e, forum_sujets s
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle
				AND s.auteur = e.id_etu
				AND f.id_cours = " . $idCours . "
				AND s.id_categorie = f.id_categorie
				ORDER BY date_derniere_reponse
				LIMIT 5");
		
	
		$result = array();
		
		while($sujet = $this->fetchArray($ressource))
		{
			$result[] = new Sujet(array('id' => $sujet['id_sujet'],
					'auteur' => new Etudiant(array(	'id' => $sujet['id_etu'],
							'nom' => $sujet['nom_etu'],
							'prenom' => $sujet['prenom_etu'],
							'mail' => $sujet['mail_etu'],
							'login' => $sujet['pseudo_etu'],
							'pass' => $sujet['pass_etu'],
							'admin' => $sujet['admin'])),
					'titre' => $sujet['titre'],
					'dateDerniereReponse' => $sujet['date_derniere_reponse'],
					'categorie' => new Categorie(array('id' => $sujet['id_categorie'],
							'titre' => $sujet['titre_categorie'],
							'description' => $sujet['description_categorie'],
							'cours' => new Cours(array(	'id' => $sujet['id_cours'],
									'libelle' => $sujet['libelle_cours'],
									'couleurCalendar' => $sujet['couleur_calendar'],
									'prof' => $daoEtudiant->getByID($sujet['auteur']),
									'cle' => new Cle(array('id' => $sujet['id_cle'],
											'cle' => $sujet['valeur_cle'])))),
							'parent' => $sujet['id_categorie_parent']
					))));
		}
		
		return $result;
	}
	
	public function getLastFiveByCoursEtudiant($idCours, $idEtudiant)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$ressource = $this->executeQuery("SELECT *
				FROM forum_categorie f, cours c, cle, etudiant e, forum_sujets s
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle
				AND s.auteur = e.id_etu
				AND e.id_etu = " . $idEtudiant . "
				AND f.id_cours = " . $idCours . "
				AND s.id_categorie = f.id_categorie
				ORDER BY date_derniere_reponse
				LIMIT 5");
	
	
		$result = array();
	
		while($sujet = $this->fetchArray($ressource))
		{
			$result[] = new Sujet(array('id' => $sujet['id_sujet'],
					'auteur' => new Etudiant(array(	'id' => $sujet['id_etu'],
							'nom' => $sujet['nom_etu'],
							'prenom' => $sujet['prenom_etu'],
							'mail' => $sujet['mail_etu'],
							'login' => $sujet['pseudo_etu'],
							'pass' => $sujet['pass_etu'],
							'admin' => $sujet['admin'])),
					'titre' => $sujet['titre'],
					'dateDerniereReponse' => $sujet['date_derniere_reponse'],
					'categorie' => new Categorie(array('id' => $sujet['id_categorie'],
							'titre' => $sujet['titre_categorie'],
							'description' => $sujet['description_categorie'],
							'cours' => new Cours(array(	'id' => $sujet['id_cours'],
									'libelle' => $sujet['libelle_cours'],
									'couleurCalendar' => $sujet['couleur_calendar'],
									'prof' => $daoEtudiant->getByID($sujet['auteur']),
									'cle' => new Cle(array('id' => $sujet['id_cle'],
											'cle' => $sujet['valeur_cle'])))),
							'parent' => $sujet['id_categorie_parent']
					))));
		}
	
		return $result;
	}
	
	public function getAllByCategorieWithStats($idCategorie)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$ressource = $this->executeQuery("SELECT *
				FROM forum_categorie f, cours c, cle, etudiant e, forum_sujets s
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle
				AND s.auteur = e.id_etu
				AND s.id_categorie = " . $idCategorie . "
				ORDER BY date_derniere_reponse DESC
				");
			
		$listeSujets = array();
		
		while($sujet = $this->fetchArray($ressource))
		{
			$listeSujets[] = new Sujet(array('id' => $sujet['id_sujet'],
					'auteur' => new Etudiant(array(	'id' => $sujet['id_etu'],
							'nom' => $sujet['nom_etu'],
							'prenom' => $sujet['prenom_etu'],
							'mail' => $sujet['mail_etu'],
							'login' => $sujet['pseudo_etu'],
							'pass' => $sujet['pass_etu'],
							'admin' => $sujet['admin'])),
					'titre' => $sujet['titre'],
					'nbMessages' => $this->getNbMessages($sujet['id_sujet']),
					'dateDerniereReponse' => $sujet['date_derniere_reponse'],
					'categorie' => $sujet['id_categorie']));
		}
		
		return $listeSujets;
	}
	
	public function getNbMessages($idSujet)
	{
		$result = $this->executeQuery("SELECT * FROM forum_reponses WHERE correspondance_sujet = " . $idSujet);
	
		return $this->countRows($result);
	}
	
	public function getPosted($idEtudiant)
	{
		$result = $this->executeQuery("SELECT * FROM forum_sujets WHERE auteur = " . $idEtudiant);
		
		return $this->countRows($result);
	}
}
