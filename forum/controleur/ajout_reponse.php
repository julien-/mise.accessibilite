<?php 
include_once ('../../lib/autoload.inc.php');
session_start();

DBFactory::getMysqlConnexionStandard();
$daoMessage = new DAOMessage($db);

$daoMessage->save(new Message(array(
		'auteur' => $_SESSION['currentUser']->getId(),
		'message' => $_POST['message'],
		'sujet' => $_POST['sujet']
)));

header('Location: ' . $_SESSION['alternative-referrer']);
?>