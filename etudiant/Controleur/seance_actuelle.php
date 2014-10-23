<?php
if(isset($_GET["id_seance"]) && !empty($_GET["id_seance"]))
{
	$remarque = $daoRemarque->getByEtuSeance($_SESSION["currentUser"]->getId(), $_GET["id_seance"]);
	$listeThemes = $daoTheme->getAllByCours($_SESSION["cours"]->getId());
	$id_seance = $_GET["id_seance"];
	include_once('../Vue/seance_actuelle.php');
}
else 
	include_once('../Vue/introuvable.php');
?>