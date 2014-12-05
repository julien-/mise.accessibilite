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
		$daoCategorie = new DAOCategorie($db);
		
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
					'auteur' => $daoEtudiant->getByID($sujet['id_etu']),
					'titre' => $sujet['titre'],
					'date_derniere_reponse' => $sujet['date_derniere_reponse'], 
					'categorie' => $daoCategorie->getByID($sujet['id_categorie'])					
			));
	}
	
	public function getByMessage($id)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$daoCategorie = new DAOCategorie($db);
		
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
				'auteur' => $daoEtudiant->getByID($sujet['id_etu']),
				'titre' => $sujet['titre'],
				'date_derniere_reponse' => $sujet['date_derniere_reponse'],
				'categorie' => $daoCategorie->getByID($sujet['id_categorie'])					
			));
	}
	
	public function getLastFiveByCours($idCours)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$daoCategorie = new DAOCategorie($db);
		
		$ressource = $this->executeQuery("SELECT *
				FROM forum_categorie f, cours c, cle, etudiant e, forum_sujets s
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle
				AND s.auteur = e.id_etu
				AND f.id_cours = " . $idCours . "
				AND s.id_categorie = f.id_categorie
				ORDER BY date_derniere_reponse DESC
				LIMIT 5");
		
	
		$result = array();
		
		while($sujet = $this->fetchArray($ressource))
		{
			$result[] = new Sujet(array(
				'id' => $sujet['id_sujet'],
				'auteur' => $daoEtudiant->getByID($sujet['id_etu']),
				'titre' => $sujet['titre'],
				'dateDerniereReponse' => $sujet['date_derniere_reponse'],
				'categorie' => $daoCategorie->getByID($sujet['id_categorie'])					
			));
		}
		
		return $result;
	}
	
	public function getLastFiveByCoursEtudiant($idCours, $idEtudiant)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$daoCategorie = new DAOCategorie($db);
		
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
			$result[] = new Sujet(array(
				'id' => $sujet['id_sujet'],
				'auteur' => $daoEtudiant->getByID($sujet['id_etu']),
				'titre' => $sujet['titre'],
				'date_derniere_reponse' => $sujet['date_derniere_reponse'],
				'categorie' => $daoCategorie->getByID($sujet['id_categorie'])					
			));
		}
	
		return $result;
	}
	
	public function getAllByCategorieWithStats($idCategorie)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$daoCategorie = new DAOCategorie($db);
		
		$ressource = $this->executeQuery("SELECT * FROM forum_sujets s 
WHERE s.id_categorie = " . $idCategorie . " 
ORDER BY date_derniere_reponse DESC");
			
		$listeSujets = array();
		
		while($sujet = $this->fetchArray($ressource))
		{
			$listeSujets[] = new Sujet(array(
				'id' => $sujet['id_sujet'],
				'auteur' => $daoEtudiant->getByID($sujet['auteur']),
				'titre' => $sujet['titre'],
				'dateDerniereReponse' => $sujet['date_derniere_reponse'],
				'categorie' => $daoCategorie->getByID($sujet['id_categorie'])					
			));
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
