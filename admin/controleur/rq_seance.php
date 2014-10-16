<?php

include_once "../../config.php";

include_once "../../lib/autoload.inc.php";
session_start();
$msgperso = "";
$redirige = false;

DBFactory::getMysqlConnexionStandard();
$daoCours = new DAOCours();
$cours = $daoCours->getByID($_SESSION["id_cours_sel"]);
############
## SEANCE ##
############

//AJOUT DE SEANCE
if (isset($_GET["addseance"])) {
    $nb_seance = mysql_num_rows( mysql_query('SELECT * FROM ' . $tb_seance . ';') );
    //PROBLEME au niveau de l'auto_increment (car en lien avec d'autres tables) il faudrait enlever les liens, et tout gérer manuellement
    mysql_query('ALTER TABLE '.$tb_seance.' AUTO_INCREMENT='.($nb_seance+1).';');
    
    $redirige = ( mysql_query("INSERT INTO " . $tb_seance . " (date_seance, id_cours) VALUES ('" . $_POST["dateseanceadd"] . "', ".$_SESSION["id_cours_sel"].");") );    
}


//SUPPRESSION DE SEANCE (et mise à NULL dans la table avancement)
if (isset($_GET["supseance"])) {
    $redirige = ( mysql_query('UPDATE ' . $tb_avancement . ' SET id_seance = "NULL" WHERE id_seance = ' . $_GET["supseance"] . ';'));
    if ($redirige) {
        $redirige = ( mysql_query("DELETE FROM " . $tb_seance . " WHERE id_seance = " . $_GET["supseance"]) );
        if(!$redirige)
            $msgperso =" Des étudiants utilisent cette séance ";
    }
}

//MISE A JOUR DE SEANCE
if (isset($_GET["majseance"])) {
    $redirige = ( mysql_query('UPDATE ' . $tb_seance . ' SET date_seance = "' . $_POST["dateseancemaj"] . '" WHERE id_seance = ' . $_GET["majseance"] . ';') );
}

//COULEUR de COURS
if (isset($_GET["couleur_cours"])) {
	
	$cours->setCouleurCalendar($_POST["choix_couleur_calendar"]);
	$redirige = $daoCours->update($cours);
}
//mysql_close($db);
/* #################
 * ## REDIRECTION ##
 * #################
 */


// on regarde de quelle page il venait
if (isset($_GET['section']))
    $retourPage = "section=" . $_GET['section'];
else
    $retourPage = "";

if ($redirige)
    $_SESSION["notif_msg"] = '<div class="ok">Requête éffectuée avec succès...</div>';
else
    $_SESSION["notif_msg"] = '<div class="erreur">Erreur dans l\' execution de la requête.' . $msgperso . '</div>';

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: index.php?' . $retourPage);
?>
