<?php 
include_once ('../../lib/autoload.inc.php');
session_start();

DBFactory::getMysqlConnexionStandard();
$daoCategorie = new DAOCategorie($db);

$daoCategorie->save(new Categorie(array(
		'titre' => $_POST['titre'],
		'description' => $_POST['description'],
		'cours' => $_POST['cours'],
		'parent' => null
)));

header('Location: ' . $_SESSION['referrer']);
?>