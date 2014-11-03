<?php
$idEtudiant = exists ( 'e', 'etudiant', 'id_etu' );

if ($idEtudiant != false) 
{
	$daoEtudiant = new DAOEtudiant ( $db );
	$daoInscription = new DAOInscription ( $db );
	$daoAvancement = new DAOAvancement ( $db );
	$daoSujet = new DAOSujet($db);
	$daoAvancementBonus = new DAOAvancement_bonus($db);
	
	$listeInscription = $daoInscription->getAllByEtudiantProf ($idEtudiant, $_SESSION ['currentUser']->getId () );
	$etudiant = $daoEtudiant->getByID ($idEtudiant);
	$score = $daoAvancement->getTotalScoreEtudiant($idEtudiant);
	$nbSujets = $daoSujet->getPosted($idEtudiant);
	$totalBonus = $daoAvancementBonus->getNumberBonusByEtudiant($idEtudiant);
	
	$listeMesBonus = $daoAvancementBonus->getByEtudiantFait($idEtudiant);
	include('../vue/bonus.php');
	include('../vue/etudiant.php');
}
?>
