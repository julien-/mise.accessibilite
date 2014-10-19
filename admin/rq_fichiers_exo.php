<?php

include_once "../../lib/autoload.inc.php";
include_once "../../config.php";
include_once "../../fonctions.php";
session_start();
$msgperso = "";
$redirige = false;

$daoFichiers = new DAOFichier(null);
##############
## FICHIERS ##
##############

//UPLOAD DE FICHIERS
function upload($index, $destination, $maxsize = FALSE, $extensions = FALSE) {
    //Test1: fichier correctement uploadé
    if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0)
        return FALSE;
    //Test2: taille limite
    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize)
        return FALSE;
    //Test3: extension
    $ext = substr(strrchr($_FILES[$index]['name'], '.'), 1);
    if ($extensions !== FALSE AND !in_array($ext, $extensions))
        return FALSE;

    // verifie que le fichier existe pas deja sous ce nom
    $fileExt = pathinfo($_FILES[$index]['name'], PATHINFO_EXTENSION);
    $fileName = substr(basename($_FILES[$index]['name'], $ext), 0, -1);
    $count = 1;
    $tmpDest = $destination;
    while (file_exists($tmpDest)) {
        $tmpDest = $destination . $fileName . ' (' . $count . ') .' . $fileExt;
        $count++;
    }
    $destination = $tmpDest;
    //Déplacement
    if (!move_uploaded_file($_FILES[$index]['tmp_name'], $destination))
        return false;

    return $destination;
}

if (isset($_POST["submit"])) {
    $destination = upload('userfile', '../../upload/');
    $daoFichiers->saveOrUpdate(array(
    		'exercice' => $_POST['fichierID'], 
    		'chemin' => $destination, 
    		'nom' => $_POST['nom_fichier'], 
    		'commentaire' => $_POST['commentaires'], 
    		'codeLien' => md5($destination),
    		'enLigne' => $_POST['en_ligne']
    ));
	
    $redirige = true;
}

//SUPPRESSION DE FICHIERS
if (isset($_GET["supfichier"])) {
    $rq_fichiers = mysql_query("SELECT id_fichier, chemin_fichier " .
            "FROM " . $tb_fichiers . " " .
            "WHERE id_fichier = " . $_GET["supfichier"]);
    $mon_fichier = mysql_fetch_assoc($rq_fichiers);
//physiquement
    $ok = unlink($mon_fichier["chemin_fichier"]);
//dans la BDD :
    if ($ok) {
        $redirige = ( mysql_query("DELETE FROM " . $tb_fichiers . " WHERE id_fichier = " . $_GET["supfichier"]) );
    }
}


//COMMENTAIRE
if(isset($_GET["comment"])){
    $redirige = ( mysql_query("UPDATE " . $tb_fichiers . " SET commentaires = '" . nl2br(htmlentities($_POST["commentaires"], ENT_QUOTES, 'UTF-8')) . "'  WHERE id_fichier = " . $_GET["comment"]) );
}


//EN LIGNE ou HORS LIGNE
if (isset($_POST["online"])) {
    $redirige = ( mysql_query("UPDATE " . $tb_fichiers . " SET enligne = " . $_POST["coche"] . "  WHERE id_fichier = " . $_POST["online"]) );
}




mysql_close($db);
/* #################
 * ## REDIRECTION ##
 * #################
 */


// on regarde de quelle page il venait
if (isset($_GET['section']))
    $retourPage = "section=" . $_GET['section'];
else
    $retourPage = "";

if (isset($_GET['exo_sel']))
    $retourPage .= "&exo_sel=" . $_GET['exo_sel'];
session_start();

if ($redirige)
    $_SESSION["notif_msg"] = '<div class="ok">Requête éffectuée avec succès...</div>';
else
    $_SESSION["notif_msg"] = '<div class="erreur">Erreur dans l\' execution de la requête.' . $msgperso . '</div>';

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: index.php?' . $retourPage);
?>
