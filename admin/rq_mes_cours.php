<?php

session_start();
include_once "../fonctions.php";
include_once "../config.php";
include_once "../sql/connexion_mysql.php";

$redirige = false;

############
## COURS ##
############
//AJOUT DE COURS
if (isset($_GET["addcours"])) {
    //ajout dans la table cle
    mysql_query("INSERT INTO " . $tb_cle . " (valeur_cle) VALUES ( '" . md5($_POST["clecours"]) . "' );");
    //récupère le dernier AUTO INCREMENT généré
    $idcle = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id_cle"));
    //ajout dans la table cours
    mysql_query("INSERT INTO " . $tb_cours . " (libelle_cours, id_prof, id_cle) VALUES ('" . $_POST["titrecours"] . "', " . $_SESSION["id"] . ", " . $idcle["id_cle"] . " );");

    mysql_query("INSERT INTO forum_categorie (titre_categorie, description_categorie, id_cours, id_categorie_parent) " .
            "VALUES ('Blabla des étudiants' , 'Pour parler de tout et de rien', " . $idcle['id_cle'] . ", NULL);");
    $redirige = true;
}

//MODIFICATION DE COURS
if (isset($_GET["majtitrecours"])) {
    mysql_query('UPDATE ' . $tb_cours . ' SET libelle_cours = "' . $_POST["newtitrecours"] . '" WHERE id_cours = ' . $_GET["majtitrecours"] . ';');
    $redirige = true;
}

if (isset($_GET["majclecours"])) {
    mysql_query('UPDATE ' . $tb_cle . ' SET valeur_cle = "' . md5($_POST["newclecours"]) . '" WHERE id_cle = ' . $_GET["majclecours"] . ';');
    $redirige = true;
}

//SUPPRESSION DE COURS
if (isset($_GET["supcours"])) {
    //cle
    $cleducours = mysql_fetch_assoc(mysql_query("SELECT id_cle FROM " . $tb_cours . " WHERE id_cours = " . $_GET["supcours"]));
    mysql_query("DELETE FROM " . $tb_cle . " WHERE id_cle = " . $cleducours["id_cle"]);
    //cours
    mysql_query("DELETE FROM " . $tb_cours . " WHERE id_cours = " . $_GET["supcours"]);

    deleteCategorieFromCours($cleducours["id_cle"]);

    //----

    $rq_themesducours = mysql_query("SELECT id_theme FROM " . $tb_theme . " WHERE id_cours = " . $_GET["supcours"]);
    while ($themesducours = mysql_fetch_assoc($rq_themesducours)) {
        //avancement
        $rq_exodutheme = mysql_query("SELECT id_exo FROM " . $tb_exercice . " WHERE id_theme = " . $themesducours["id_theme"]);
        while ($exodutheme = mysql_fetch_assoc($rq_exodutheme)) {
            mysql_query("DELETE FROM " . $tb_avancement . " WHERE id_exo = " . $exodutheme["id_exo"]);
        }
        //exercice
        mysql_query("DELETE FROM " . $tb_exercice . " WHERE id_theme = " . $themesducours["id_theme"]);
        //avancement_bonus
        $rq_bonusdutheme = mysql_query("SELECT id_bonus FROM " . $tb_bonus . " WHERE id_theme = " . $themesducours["id_theme"]);
        while ($bonusdutheme = mysql_fetch_assoc($rq_bonusdutheme)) {
            mysql_query("DELETE FROM " . $tb_avancement_bonus . " WHERE id_bonus = " . $bonusdutheme["id_bonus"]);
        }
        //bonus
        mysql_query("DELETE FROM " . $tb_bonus . " WHERE id_theme = " . $themesducours["id_theme"]);
    }

    //theme
    mysql_query("DELETE FROM " . $tb_theme . " WHERE id_cours = " . $_GET["supcours"]);

    $redirige = true;
}


############
## THEMES ##
############
//AJOUT DE THEME
if (isset($_GET["addtheme"])) {
    mysql_query("INSERT INTO " . $tb_theme . " (titre_theme, id_cours) " .
            "VALUES ('" . $_POST["titretheme"] . "' , " . $_POST['id_cours_sel'] . ");");

    mysql_query("INSERT INTO forum_categorie (titre_categorie, description_categorie, id_cours, id_categorie_parent) " .
            "VALUES ('" . $_POST["titretheme"] . "' , 'Tout ce qui concerne le thème " . $_POST['titretheme'] . "', " . $_POST['id_cours_sel'] . ", NULL);");
    $redirige = true;
}

//MODIFICATION DE THEME
if (isset($_GET["majtheme"])) {
    mysql_query('UPDATE ' . $tb_theme . ' SET titre_theme = "' . $_POST["titremajtheme"] . '" WHERE id_theme = ' . $_GET["majtheme"] . ';');
    $redirige = true;
}

//SUPPRESSION DE THEME (et ses exos)
if (isset($_GET["suptheme"])) {
    //forum
    //theme
    mysql_query("DELETE FROM " . $tb_theme . " WHERE id_theme = " . $_GET["suptheme"]);

    $rq_exodutheme = mysql_query("SELECT id_exo FROM " . $tb_exercice . " WHERE id_theme = " . $_GET["suptheme"]);
    while ($exodutheme = mysql_fetch_assoc($rq_exodutheme)) {
        //avancement
        while ($exodutheme = mysql_fetch_assoc($rq_exodutheme)) {
            mysql_query("DELETE FROM " . $tb_avancement . " WHERE id_exo = " . $exodutheme["id_exo"]);
        }
        //exercice
        mysql_query("DELETE FROM " . $tb_exercice . " WHERE id_theme = " . $_GET["suptheme"]);
        //avancement_bonus
        $rq_bonusdutheme = mysql_query("SELECT id_bonus FROM " . $tb_bonus . " WHERE id_theme = " . $_GET["suptheme"]);
        while ($bonusdutheme = mysql_fetch_assoc($rq_bonusdutheme)) {
            mysql_query("DELETE FROM " . $tb_avancement_bonus . " WHERE id_bonus = " . $bonusdutheme["id_bonus"]);
        }
        //bonus
        mysql_query("DELETE FROM " . $tb_bonus . " WHERE id_theme = " . $_GET["suptheme"]);
    }

    $redirige = true;
}

###############
## EXERCICES ##
###############
//SUPPRESSION D'EXERCICE
if (isset($_GET["supexo"])) {
    //-1 il faut vérifier la numérotation des exercices suivants du thème
    //   on récupère id_theme concérné
    $rq_exoduthem = mysql_query("SELECT * FROM " . $tb_exercice . " WHERE id_theme = " . $_POST["idt_exo"]);
    //décrémente les numéros supérieurs
    $num_asuppr = "";
    while ($mon_exoduthem = mysql_fetch_assoc($rq_exoduthem)) { //parcours du SELECT *
        if (empty($num_asuppr)) {   //on récupère le numéro de l'exercice à supprimer par son id
            if ($mon_exoduthem["id_exo"] == $_GET["supexo"])
                $num_asuppr = $mon_exoduthem["num_exo"];
        }
        else {  //on décrémente les exercices suivant celui que l'on veut supprimer
            if ($mon_exoduthem['num_exo'] > $num_asuppr)
                mysql_query('UPDATE ' . $tb_exercice . ' SET num_exo = ' . ($mon_exoduthem['num_exo'] - 1) . ' WHERE id_exo = ' . $mon_exoduthem['id_exo'] . ';');
        }
    }
    //-2 on efface de la table AVANCEMENT
    mysql_query("DELETE FROM " . $tb_avancement . " WHERE id_exo = " . $_GET["supexo"]);

    //3-on efface de la table EXERCICE
    mysql_query("DELETE FROM " . $tb_exercice . " WHERE id_exo = " . $_GET["supexo"]);
    
    //4-on efface tous les fichiers liés à l'exercice
    $rq_fichiers = mysql_query("SELECT id_fichier, chemin_fichier " .
            "FROM " . $tb_fichiers . " " .
            "WHERE id_exo = " . $_GET["supexo"]);
    
    //physiquement
    $ok = true;
    while($mon_fichier = mysql_fetch_assoc($rq_fichiers))
    {
        $ok = unlink($mon_fichier["chemin_fichier"]);
    }
    
    //dans la BDD :
    if ($ok) {
        $redirige = ( mysql_query("DELETE FROM " . $tb_fichiers . " WHERE id_exo = " . $_GET["supexo"]) );
    }
    
    $redirige = true;
}

//AJOUT D'EXERCICE
if (isset($_GET["addexo"])) {
    //Insert dans exercice
    
    mysql_query('INSERT INTO ' . $tb_exercice . ' (id_theme, num_exo, titre_exo) ' .
            'VALUES (' . $_POST['id_them_sel'] . ', ' . $_POST['nbmax_exo'] . ', "' . $_POST['titre_exo'] . '");');
    //récupère l'autoincrement créé

   

    $redirige = true;
}

//MODIFICATION D'EXERCICE
if (isset($_GET["majexo"])) {
    mysql_query('UPDATE ' . $tb_exercice . ' SET titre_exo = "' . $_POST["titremajexo"] . '" WHERE id_exo = ' . $_GET["majexo"] . ';');
    $redirige = true;
}


/* #################
 * ## REDIRECTION ##
 * #################
 */
mysql_close($db);

// on regarde de quel page il venait
if (isset($_GET['section']))
    $retourPage = "section = " . $_GET['section'];
else
    $retourPage = "";
session_start();

if ($redirige)
    $_SESSION["notif_msg"] = '<div class="ok">Requête éffectuée avec succès...</div>';
else
    $_SESSION["notif_msg"] = '<div class="erreur">Erreur dans l\' execution de la requête...</div>';

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: controleur/index.php?' . $retourPage);
?>
