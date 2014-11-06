<?php
if(isset($_SESSION['cours']) && !empty($_SESSION['cours']))
{
	$listeObjectifs = $daoObjectif->getAll();
	include_once('../Vue/evolution.php');
}
else 
	include_once('../Vue/introuvable.php');

?>