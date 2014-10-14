<?php
if(isset($_GET["id_seance"]) && !empty($_GET["id_seance"]))
{
	$listeAvancement = $daoAvancement->getBySeanceEtudiant($_GET["id_seance"], $_SESSION["currentUser"]->getId());
	include_once('../Vue/seance_precedente.php');
}
else 
	include_once('../Vue/introuvable.php');
?>