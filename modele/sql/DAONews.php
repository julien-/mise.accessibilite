<?php
class DAONews extends DAOStandard
{	
	public function getLastNews($limit, $idCours)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$result = $this->executeQuery('
				SELECT id_etudiant, activite, dateacti
				FROM(
				(SELECT id_etu as id_etudiant, date_inscription as dateacti, "inscription" as activite FROM inscription WHERE id_cours = ' . $idCours .')
				UNION
				(SELECT id_etu as id_etudiant, date as dateacti, "avancement" as activite FROM avancement, theme, exercice WHERE avancement.id_exo = exercice.id_exo AND exercice.id_theme = theme.id_theme AND id_cours = ' . $idCours . '))news
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
	
	public function getLastNewsByCoursEtudiant($limit, $idCours, $idEtudiant)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$result = $this->executeQuery('
				SELECT id_etudiant, activite, dateacti
				FROM(
				(SELECT id_etu as id_etudiant, date_inscription as dateacti, "inscription" as activite FROM inscription WHERE id_etu = ' . $idEtudiant . ' AND id_cours = ' . $idCours .')
				UNION
				(SELECT id_etu as id_etudiant, date as dateacti, "avancement" as activite FROM avancement, theme, exercice WHERE id_etu = ' . $idEtudiant . ' AND avancement.id_exo = exercice.id_exo AND exercice.id_theme = theme.id_theme AND id_cours = ' . $idCours . '))news
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