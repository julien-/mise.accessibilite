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
	
    $destination = Outils::upload('userfile', '../../', Outils::$UPLOAD_FOLDER);
    $daoFichiers->saveOrUpdate(new Fichier(array(
    		'id' => -1,
    		'exercice' => $_POST['fichierID'], 
    		'chemin' => $destination, 
    		'nom' => $_FILES['userfile']['name'] , 
    		'commentaire' => $_POST['commentaires'], 
    		'codeLien' => md5($destination),
    		'enLigne' => $online
    )));
	
    $redirige = true;
}

//COMMENTAIRE
if(isset($_GET["comment"])){
    $redirige = ( mysql_query("UPDATE " . $tb_fichiers . " SET commentaires = '" . nl2br(htmlentities($_POST["commentaires"], ENT_QUOTES, 'UTF-8')) . "'  WHERE id_fichier = " . $_GET["comment"]) );
}

//EN LIGNE ou HORS LIGNE
if (isset($_POST["online"])) {
    $redirige = ( mysql_query("UPDATE " . $tb_fichiers . " SET enligne = " . $_POST["coche"] . "  WHERE id_fichier = " . $_POST["online"]) );
}

if ($redirige)
    $_SESSION["notif_msg"] = '<div class="ok">Requête éffectuée avec succès...</div>';
else
    $_SESSION["notif_msg"] = '<div class="erreur">Erreur dans l\' execution de la requête.' . $msgperso . '</div>';

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ' . $_SESSION['referrer']);
?>
