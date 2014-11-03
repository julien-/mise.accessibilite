<?php 
include_once ('../../lib/autoload.inc.php');
session_start();

DBFactory::getMysqlConnexionStandard();
$daoSujet = new DAOSujet($db);
$daoMessage = new DAOMessage($db);

$daoSujet->save(new Sujet(array(
		'auteur' => $_SESSION['currentUser']->getId(),
		'titre' => $_POST['titre'],
		'categorie' => $_POST['id_categorie']
)));

$outilsSQL = new DAOStandard($db);

$daoMessage->save(new Message(array(
		'auteur' => $_SESSION['currentUser']->getId(),
		'titre' => $_POST['titre'],
		'message' => $_POST['message'],
		'sujet' => $outilsSQL->lastInsertedID()
)));

header('Location: ' . $_SESSION['referrer']);
?>