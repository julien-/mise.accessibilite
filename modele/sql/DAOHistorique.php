<?php
class DAOHistorique extends DAOStandard
{
	public function save(Historique $historique)
	{
		$this->executeQuery("INSERT INTO historique SET page='" . $historique->getPage() . "', date_visite='" . $historique->getDateVisite() . "', heure_visite='".$historique->getHeureVisite()."', id_etu=".$historique->getEtudiant()->getId().", id_cours=".$historique->getCours());
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
	
	public function verifConnexion4JoursAffile($idEtu, $idCours)
	{
		
	}
} 
?>