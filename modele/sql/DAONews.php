<?php
class DAONews extends DAOStandard
{	
	public function getLastNews($limit, $idCours)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$result = $this->executeQuery('
				SELECT id_etudiant, activite, dateacti
				FROM(
				(SELECT id_etu as id_etudiant, date_inscription as dateacti, "inscription" as activite FROM inscription)
				UNION
				(SELECT id_etu as id_etudiant, date as dateacti, "avancement" as activite FROM avancement))news
				ORDER BY dateacti DESC
				LIMIT ' . $limit);
		
		$listeNews = array();
		
		while($news = $this->fetchArray($result))
		{
			$listeNews[] = new News(array(
					'date' => $news['dateacti'],
					'etudiant' => $daoEtudiant->getByID($news['id_etudiant']),
					'activite' => $news['activite']
			));
		}
		
		return $listeNews;
	}
}