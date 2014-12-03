<?php 
$daoMessagerie = new DAOMessagerie($db);
$daoInscription = new DAOInscription($db);
$daoEtudiant = new DAOEtudiant($db);

if(isset($_GET['id_message_reponse']) && !empty($_GET['id_message_reponse']))
	$message_reponse = $daoMessagerie->getById($_GET['id_message_reponse']);
elseif(isset($_GET['aide']) && !empty($_GET['aide']) && isset($_GET['exercice']) && !empty($_GET['exercice']))
{
	$aideur = $daoEtudiant->getByID($_GET['aide']);
	$exercice = $daoExercice->getByID($_GET['exercice']);
}
elseif (isset($_GET['dest']))
{
	$destinataire = $daoEtudiant->getByID($_GET['dest']);
}
else 
	$listeClassmates = $daoInscription->getClassmates($_SESSION['currentUser']->getId());

include_once('../../messagerie/vue/envoyer_messagerie.php');
?>