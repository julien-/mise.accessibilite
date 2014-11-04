<?php 
$daoInscription = new DAOInscription($db);

$listeResultats = $daoInscription->getAllByCours($_SESSION ['cours']->getId());

include_once ('../vue/mes_etudiants.php');
?>