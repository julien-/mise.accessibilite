<?php
$idEtudiant = exists ( 'e', 'etudiant', 'id_etu' );

if ($idEtudiant != false) 
{
	$daoEtudiant = new DAOEtudiant ( $db );
	$daoInscription = new DAOInscription ( $db );
	$daoAvancement = new DAOAvancement ( $db );
	
	$listeInscription = $daoInscription->getAllByEtudiantProf ( $idEtudiant, $_SESSION ['currentUser']->getId () );
	$etudiant = $daoEtudiant->getByID ( $idEtudiant );
	
	include('../vue/etudiant.php');
}
?>
