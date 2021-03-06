<?php
include_once ('../../lib/autoload.inc.php');
session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoMessagerie= new DAOMessagerie($db);
$daoEtudiant= new DAOEtudiant($db);

if (isset($_POST["envoyer"])) {
	
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
		$_SESSION['messageAdded'] = 'true';
		$referrer = str_replace ("envoyer_messagerie" ,"envoyes_messagerie" , $_SESSION['referrer']);
	}
}

header('Location: ' . $referrer);
?>