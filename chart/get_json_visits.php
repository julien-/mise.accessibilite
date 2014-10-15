<?php
	include_once ('../modele/Etudiant.php');
	include_once ('../modele/Cours.php');
	include_once ('../modele/Outils.php');
	include_once ('../modele/sql/DAOAvancement.php');
	include_once ('../modele/sql/DAOHistorique.php');
	include_once ('../modele/sql/DBFactory.php');
	session_start ();
	
	DBFactory::getMysqlConnexionStandard();
	
	$table = array();
	$table['cols'] = array(
			array('label' => 'Date', 'type' => 'string'),
			array('label' => 'Visites', 'type' => 'number'),
	);

	$rows = array();
	
	$daoHistorique = new DAOHistorique();
	$listeHistorique = $daoHistorique->getLastVisits($_GET['c']);

	for($i = 6; $i >= 0; $i--)
	{
		$newDay = date("Y-m-d", strtotime("-" . $i ." day"));
		$jours[] = $newDay;
	}
	
	foreach ($jours as $jour)
	{
		$trouve = false;
		$date = $jour;
		foreach($listeHistorique as $cle => $historique)
		{
			if ($historique['date'] == $jour)
			{
				$trouve = true;
				$date = $historique['date'];
				$nbVisites = (int)$historique['nb_visites'];

				break;
			}
		}
		if (!$trouve)
			$nbVisites = 0;
		
		$temp = array();
		$temp[] = array('v' => Outils::daysToFr(date('D', strtotime($date))));
		$temp[] = array('v' => $nbVisites);
		$rows[] = array('c' => $temp);
	}
	
	$table['rows'] = $rows;
	$temp = array('p' => null);
	$table['p']= $temp['p'];
	
	$jsonTable = json_encode($table);
	
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Content-type: application/json');
	
	echo $jsonTable;
	
?>