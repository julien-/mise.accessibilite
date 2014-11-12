<?php
if((isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser'])) && (isset($_SESSION['cours']) && !empty($_SESSION['cours'])))
{
	$listeObjectifs = $daoObjectif->getAll();
	include_once('../vue/objectif.php');
}
else 
	include_once('../vue/introuvable.php');
?>