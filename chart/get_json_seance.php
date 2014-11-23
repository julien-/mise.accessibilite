<?php
	include_once ('../modele/Etudiant.php');
	include_once ('../modele/Cours.php');
	include_once ('../modele/Cle.php');
	include_once ('../modele/Seance.php');
	include_once ('../modele/Outils.php');
	include_once ('../modele/sql/DAOAvancement.php');
	include_once ('../modele/sql/DAOSeance.php');
	include_once ('../modele/sql/DBFactory.php');
	require 'jsonwrapper.php';
	session_start ();
	
	DBFactory::getMysqlConnexionStandard();
	
	$daoSeance = new DAOSeance();
	$daoAvancement = new DAOAvancement();

	$listeSeances = $daoSeance->getAllIdByCours($_SESSION['cours']->getId());	
	
	$table = array();
	$table['cols'] = array(
			array('label' => 'Date', 'type' => 'string'),
			array('label' => 'Ma progression', 'type' => 'number'),
			array('label' => 'Progression de la promo', 'type' => 'number'),
	);

	$rows = array();
	
	for ($i = 0; $i < sizeof($listeSeances); $i++)
	{
		$avancement = $daoAvancement->getByCoursSeanceEtudiant($_SESSION['cours']->getId(), $listeSeances[$i]['id'], $_SESSION['currentUser']->getId());
		$avancement_promo = $daoAvancement->getByCoursSeance($_SESSION['cours']->getId(), $listeSeances[$i]['id']);
		
		$temp = array();
		$temp[] = array('v' => "Seance du ".Outils::dateToFr($listeSeances[$i]['date']));
		$temp[] = array('v' => $avancement);
		$temp[] = array('v' => $avancement_promo);
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