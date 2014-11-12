<?php
if(isset($_SESSION['cours']) && !empty($_SESSION['cours']))
{
	$listeObjectifs = $daoObjectif->getAll();
	include_once('../vue/evolution.php');
}
else 
	include_once('../vue/introuvable.php');

?>