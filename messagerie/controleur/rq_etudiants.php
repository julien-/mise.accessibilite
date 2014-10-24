<?php 
include_once('../../lib/autoload.inc.php');
session_start();

DBFactory::getMysqlConnexionStandard();
$daoInscritption = new DAOInscription($db);

$listeEtudiants = $daoInscritption->searchClassmates($_SESSION['currentUser']->getId(), $_GET['query']);

$temp = array();

foreach($listeEtudiants as $etudiant)
{
	$temp[] = array('username' => $etudiant->getEtudiant()->getLogin(), 'name' => $etudiant->getEtudiant()->getNom(), 'surname' => $etudiant->getEtudiant()->getPrenom(), 'id' => $etudiant->getEtudiant()->getId());
}

echo json_encode($temp);
?>