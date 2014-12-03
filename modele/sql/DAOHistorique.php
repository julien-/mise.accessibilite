<?php
class DAOHistorique extends DAOStandard
{
	public function save(Historique $historique)
	{
		$this->executeQuery("INSERT INTO historique SET page='" . $historique->getPage() . "', date_visite='" . $historique->getDateVisite() . "', heure_visite='".$historique->getHeureVisite()."', id_etu=".$historique->getEtudiant()->getId().", id_cours=".$historique->getCours(). ', timestamp = ' . Outils::dateToTimestamp(date('Y-m-d H:i:s')));
	}
	
	public function getLastVisitsByCours($idCours)
	{
		$ressource = $this->executeQuery("SELECT distinct(count(id_etu)) as nb_visites, date_visite
							FROM historique
							WHERE id_cours = " . $idCours ."
							GROUP by date_visite
							ORDER BY date_visite DESC
							LIMIT 7");
		
		$result = array();
		while($historique = $this->fetchArray($ressource))
		{
			$result[] = array('nb_visites' => $historique['nb_visites'],
					 'date' => $historique['date_visite']);
		}
		
		return $result;
	}
	
	public function getLastVisitsByEtudiant($idEtudiant)
	{
		$ressource = $this->executeQuery("SELECT distinct(count(id_etu)) as nb_visites, date_visite
							FROM historique
							WHERE id_etu = ". $idEtudiant ."
							GROUP by date_visite
							ORDER BY date_visite DESC
							LIMIT 7");
	
		$result = array();
		while($historique = $this->fetchArray($ressource))
		{
			$result[] = array('nb_visites' => $historique['nb_visites'],
					'date' => $historique['date_visite']);
		}
	
		return $result;
	}
	
	public function getLastVisitsByEtudiantCours($idEtu, $idCours)
	{
		$ressource = $this->executeQuery("SELECT distinct(count(id_etu)) as nb_visites, date_visite
							FROM historique
							WHERE id_etu = ". $idEtu ."
							AND id_cours = ". $idCours ."
							GROUP by date_visite
							ORDER BY date_visite DESC
							LIMIT 7");
		
		$result = array();
		while($historique = $this->fetchArray($ressource))
		{
			$result[] = array('nb_visites' => $historique['nb_visites'],
					'date' => $historique['date_visite']);
		}
		
		return $result;
	}
	
	public function verifConnexion4JoursAffile($idEtu, $idCours)
	{
		
	}
	
	public function getUserConnected()
	{
		$timestamp_5 = time()-(60*150);
		
		$ressource = $this->executeQuery("
							SELECT nom_etu, prenom_etu, etudiant.id_etu, code_lien
							FROM historique, etudiant
							WHERE historique.id_etu != ". $_SESSION['currentUser']->getId() ."
							AND etudiant.id_etu = historique.id_etu 
							AND id_cours = ". $_SESSION['cours']->getId() ."
							AND timestamp >= " . $timestamp_5 . "
							GROUP BY historique.id_etu");
		
		$result = array();
		while($historique = $this->fetchArray($ressource))
		{
			$result[] = new Historique(array('etudiant' => new Etudiant(array(
					'nom' => $historique['nom_etu'],
					'prenom' => $historique['prenom_etu'],
					'id' => $historique['id_etu'],
					'code_lien' => $historique['code_lien']
			)		)));

		}
		
		return $result;
	}
} 
?>