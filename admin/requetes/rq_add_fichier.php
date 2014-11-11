<?php

include_once "../../lib/autoload.inc.php";
include_once "../../config.php";
include_once "../../fonctions.php";
session_start();
$msgperso = "";
$redirige = false;

$db = DBFactory::getMysqlConnexionStandard();
$daoFichiers = new DAOFichier($db);

if (isset($_POST["submit"])) {
	
	if (isset($_POST['en_ligne']))
		$online = 1;
	else
		$online = 0;
	
    $destination = Outils::upload('fichier', '../../', Outils::$UPLOAD_FOLDER);
    $daoFichiers->saveOrUpdate(new Fichier(array(
    		'id' => -1,
    		'exercice' => $_POST['exercice-fichier'], 
    		'chemin' => $destination, 
    		'nom' => $_FILES['fichier']['name'] , 
    		'commentaire' => $_POST['desc-fichier'], 
    		'codeLien' => md5($destination),
    		'enLigne' => $online
    )));
}

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ' . $_SESSION['referrer']);
?>
