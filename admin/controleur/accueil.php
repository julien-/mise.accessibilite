<?php 
$daoSujet = new DAOSujet($db);

$liste5DerniersSujets = $daoSujet->getLastFiveByCours(1);

include_once('../vue/accueil.php')
?>