<?php
include_once ('../../lib/autoload.inc.php');
session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoMessagerie= new DAOMessagerie($db);
$daoEtudiant= new DAOEtudiant($db);

$redirige = false;

if (isset($_GET["envoyermessage"])) {
	
	if($_POST['destinataire'] != "" && $_POST['titre'] != "" & $_POST['message'] != "" )
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
	
		$message = "Message envoyé avec succes";
		$redirige = true;
	}
}

/* #################
 * ## REDIRECTION ##
 * #################
 */
mysql_close($db);

if ($redirige)
{
	$retourPage = "section=". $_GET['section'];
	session_start();
	
	$_SESSION["notif_msg"] = '<div class="ok">'.$message.'</div>';
}
else
{
	if(isset($_GET['id_message_reponse']))
		$retourPage = "section=envoyer_messagerie&id_message_reponse=".$_GET['id_message_reponse'];
	else
		$retourPage = "section=envoyer_messagerie&destinataire=".$_POST['destinataire']."&titre=".$_POST['titre']."&message=".$_POST['message'];
	
	session_start();
	
	$_SESSION["notif_msg"] = '<div class="erreur">Erreur, certains éléments sont vides</div>';
}

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ../../etudiant/Controleur/index.php?' . $retourPage);
?>