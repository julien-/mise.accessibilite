<?php

class DAOHistorique extends DAOStandard
{
	public function getLastVisits($idCours)
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
} 
?>