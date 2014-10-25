<?php 
$daoMessagerie = new DAOMessagerie($db);
$daoInscription = new DAOInscription($db);
$daoEtudiant = new DAOEtudiant($db);

if(isset($_GET['id_message_reponse']) && !empty($_GET['id_message_reponse']))
	$message_reponse = $daoMessagerie->getById($_GET['id_message_reponse']);
else 
	$listeClassmates = $daoInscription->getClassmates($_SESSION['currentUser']->getId());

$daoMessagerie = new DAOMessagerie($db);
$daoInscription = new DAOInscription($db);
$daoEtudiant = new DAOEtudiant($db);

if (isset($_POST['go']) && $_POST['go'] == 'Envoyer le message')
{
	if (empty($_POST['destinataire']) || empty($_POST['titre']) || empty($_POST['message']))
	{
		$erreur = 'Au moins un des champs est vide.';
	}
	else
	{
		$message = new Messagerie(array(
				'destinataire' => $daoEtudiant->getByID($_POST['destinataire']),
				'expediteur' => $daoEtudiant->getByID($_SESSION['currentUser']->getId()),
				'date' => date("Y-m-d H:i:s"),
				'heure' => date("H:i:s"),
				'titre' => mysql_real_escape_string($_POST['titre']),
				'texte' => mysql_real_escape_string($_POST['message']),
				'lu' => 0
		));
		$daoMessagerie->send($message);
	}
}

if (isset($_GET['id_message_reponse']))
{
	$messageARepondre = $daoMessagerie->getById($_GET['id_message_reponse']);
	
	$destinataire = $messageARepondre->getExpediteur();
	
	$identiteCompleteDestinataire = $destinataire->getPrenom() . ' ' . $destinataire->getNom() . ' (' . $destinataire->getLogin() . ')';
	$idDestinataire = $destinataire->getId();
}
include_once('../../messagerie/vue/envoyer_messagerie.php');
?>