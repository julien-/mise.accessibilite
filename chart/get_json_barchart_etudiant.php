<?php
	include_once ('../modele/Etudiant.php');
	include_once ('../modele/Cours.php');
	include_once ('../modele/Outils.php');
	include_once ('../modele/sql/DAOAvancement.php');
	include_once ('../modele/sql/DBFactory.php');
	require 'jsonwrapper.php';
	session_start ();
	
	$db = null;
	DBFactory::getMysqlConnexionStandard ();
	$daoAvancement = new DAOAvancement ( $db );
	$progressionEtudiant = $daoAvancement->getByCoursEtudiant ( $_SESSION ['cours']->getId (), $_SESSION ['currentUser']->getId () );
	
	$table = array ();
	$table ['cols'] = array (
			
			array (
					'label' => 'Titre',
					'type' => 'string' 
			),
			array (
					'label' => 'Valeur',
					'type' => 'number' 
			),
			array (
					'role' => 'tooltip',
					'type' => 'string',
					'p' => array (
							'role' => 'tooltip' 
					) 
			),
			array (
					'role' => 'style',
					'type' => 'string',
					'p' => array (
							'role' => 'style' 
					) 
			) 
	);
	
	$rows = array ();

	/* Ajout de la barre concernant l'étudiant */
	$temp = array ();
	
	$temp [] = array (
			'v' => 'Moi' 
	);
	$temp [] = array (
			'v' => ( int ) $progressionEtudiant 
	);
	$temp [] = array (
			'v' => 'Mon avancement: ' . $progressionEtudiant . '%' 
	);
	$temp [] = array (
			'v' => Outils::colorChart ( $progressionEtudiant ) 
	);
	
	$rows [] = array (
			'c' => $temp 
	);
	/* Fin de la barre concernant l'étudiant */
	/* Ajout de la barre dans le graphique */
	$table['rows'] = $rows;
	$temp = array('p' => null);
	$table['p']= $temp['p'];
	
	
	$jsonTable = json_encode ( $table );
	
	header ( 'Cache-Control: no-cache, must-revalidate' );
	header ( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
	header ( 'Content-type: application/json' );
	
	echo $jsonTable;
?>