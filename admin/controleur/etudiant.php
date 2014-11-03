<?php
$idEtudiant = exists ( 'e', 'etudiant', 'id_etu' );

if ($idEtudiant != false) 
{
	$daoEtudiant = new DAOEtudiant ( $db );
	$daoInscription = new DAOInscription ( $db );
	$daoAvancement = new DAOAvancement ( $db );
	$daoSujet = new DAOSujet($db);
	$daoAvancementBonus = new DAOAvancement_bonus($db);
	
	$listeInscription = $daoInscription->getAllByEtudiantProf ( $idEtudiant, $_SESSION ['currentUser']->getId () );
	$etudiant = $daoEtudiant->getByID ($idEtudiant);
	$score = $daoAvancement->getTotalScoreEtudiant($idEtudiant);
	$nbSujets = $daoSujet->getPosted($idEtudiant);
	$bonus = $daoAvancementBonus->getNumberBonusByEtudiant($idEtudiant);
	include('../vue/etudiant.php');
}
?>
