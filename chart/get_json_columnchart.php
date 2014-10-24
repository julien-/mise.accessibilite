<?php 
include_once ('../modele/Etudiant.php');
include_once ('../modele/Cours.php');
include_once ('../modele/sql/DAOAvancement.php');
include_once ('../modele/sql/DBFactory.php');
session_start ();

$db = null;
DBFactory::getMysqlConnexionStandard ();
$daoAvancement = new DAOAvancement ( $db );

if ($_GET['theme'] != -1)
{
	$listeAvancement = $daoAvancement->getTabByThemeEtudiant($_GET['theme'], $_SESSION["currentUser"]->getId());

	$table = array ();
	
	$table['cols'] = array(
			array('label' => 'exercice', 'type' => 'string'),
			array('label' => 'fait   ', 'type' => 'number'),
			array('role' => 'tooltip', 'type' => 'string', 'p' => array( 'role' => 'tooltip')),
			array('role' => 'style', 'type' => 'string', 'p' => array ('role' => 'style')),
			
			array('label' => 'compris   ', 'type' => 'number'),
			array('role' => 'tooltip', 'type' => 'string', 'p' => array( 'role' => 'tooltip')),
			array('role' => 'style', 'type' => 'string', 'p' => array ('role' => 'style')),
			array('label' => 'assimile   ', 'type' => 'number'),
			array('role' => 'tooltip', 'type' => 'string', 'p' => array( 'role' => 'tooltip')),
			array('role' => 'style', 'type' => 'string', 'p' => array ('role' => 'style')),
			
	);
	
	$rows = array ();
	
	foreach ($listeAvancement as $avancement)
	{
	
		$temp = array ();
		
		$temp [] = array (
				'v' => $avancement["exercice"]["numero"]
		);
		$temp [] = array (
				'v' => $avancement["fait"]
		);
		$temp [] = array (
				'v' => $avancement["exercice"]["titre"]
		);
		$temp [] = array (
				'v' => '#FF6633'
		);

		$temp [] = array (
				'v' => $avancement["compris"]
		);
		$temp [] = array (
				'v' => $avancement["exercice"]["titre"]
		);
		$temp [] = array (
				'v' => '#FFCC33'
		);
		$temp [] = array (
				'v' => $avancement["assimile"]
		);
		$temp [] = array (
				'v' => $avancement["exercice"]["titre"]
		);
		$temp [] = array (
				'v' => '#99FF33'
		);

		
		$rows [] = array (
				'c' => $temp
		);
	
	}
	
	$table['rows'] = $rows;
	$temp = array('p' => null);
	$table['p']= $temp['p'];
	
	$jsonTable = json_encode($table);
	
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Content-type: application/json');
	
	echo $jsonTable;
}
?>