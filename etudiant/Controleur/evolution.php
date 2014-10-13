<?php
if(isset($_GET["id_cours"]) && !empty($_GET["id_cours"]))
{
	$_SESSION["cours"] = $daoCours->getByID($_GET["id_cours"]);
	include_once('../Vue/evolution.php');
}
elseif(isset($_SESSION["cours"]) && !empty($_SESSION["cours"]))
	include_once('../Vue/evolution.php');
else 
	include_once('../Vue/introuvable.php');

?>