<?php 
$daoInscription = new DAOInscription($db);

$listeResultats = $daoInscription->getAllByProfesseur($_SESSION ['currentUser']->getId());

include_once ('../vue/mes_etudiants.php');
?>