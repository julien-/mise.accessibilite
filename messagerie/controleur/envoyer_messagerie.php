<?php 
$daoMessagerie = new DAOMessagerie($db);
$daoInscription = new DAOInscription($db);
$daoEtudiant = new DAOEtudiant($db);

if(isset($_GET['id_message_reponse']) && !empty($_GET['id_message_reponse']))
	$message_reponse = $daoMessagerie->getById($_GET['id_message_reponse']);
else 
	$listeClassmates = $daoInscription->getClassmates($_SESSION['currentUser']->getId());

include_once('../../messagerie/vue/envoyer_messagerie.php');
?>