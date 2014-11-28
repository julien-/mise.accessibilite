<?php
include_once ('../../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoEtudiant= new DAOEtudiant($db);
$daoFichiers = new DAOFichier($db);


if (isset($_GET["addavatar"])) {
	$tmp_file = $_FILES['fichier']['tmp_name'];
	$name_file = $_FILES['fichier']['name'];
	$type_file = $_FILES['fichier']['type'];
	
	if(!is_uploaded_file($tmp_file))
	{
		//fichier vide
		$_SESSION['fichierVide'] = 'true';
	}
	elseif(preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file))
	{
		//Nom de fichier invalide
		$_SESSION['nomFichierInvalide'] = 'true';
	}
	elseif( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png'))
	{
		//Type de fichier invalide
		$_SESSION['typeFichierInvalide'] = 'true';
	}
	else
	{
		$chemin = Outils::upload('fichier', '../../', Outils::$UPLOAD_FOLDER);
		
		$daoEtudiant->AddAvatar($_SESSION['currentUser']->getId(), $chemin, md5($chemin));
		$id_etu = $_SESSION['currentUser']->getId();
		$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
		$_SESSION['avatarAdd'] = 'true';
	}			
}

header('Location: ' . $_SESSION['referrer']);
?>