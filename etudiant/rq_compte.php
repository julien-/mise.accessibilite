<?php
include_once "../config.php";
include_once "../sql/connexion_mysql.php";
include_once "../fonctions.php";

$redirige = false;

/* ################
 * AJOUT DE COMPTE
 * ################ */
if (isset($_POST["addcompte"])) {
    // Verification de la validité des informations
    $erreur = '';
    
    $reqVerifLogin = mysql_query("SELECT pseudo_etu FROM etudiant WHERE pseudo_etu = '" . $_POST["pseudo_etu"] . "'");
    
    if (mysql_num_rows($reqVerifLogin) > 0)
        //$erreur .= "Ce login (" . $$_POST["pseudo_etu"] . " ) est déjà utilisé ! <br/>";
        $erreur .= "Ce pseudo (" . $_POST["pseudo_etu"] . ") existe déja !<br/>";
    
    $reqVerifMail = mysql_query("SELECT mail_etu FROM etudiant WHERE mail_etu = '" . $_POST["mail_etu"] . "'");
    
    if (mysql_num_rows($reqVerifMail) > 0)
        //$erreur .= "Cette adresse email (" . $_POST["mail_etu"] . " ) est déjà utilisée ! <br/>";
        $erreur .= "Cette adresse mail est déjà utilisée ! <br/>";
    
    if(!verifierAdresseMail($_POST["mail_etu"]))
    {
        $erreur .= "Email invalide  <br/>";
    }
    
    if(strpos($_POST["pseudo_etu"], ' ') !== false)
    {
        $erreur .= "Espaces interdits dans les pseudos !<br/>";
    }
    
    if ($erreur == '')
    {
        //SELECT de la première séance
        $rq_seancerecente = mysql_query('SELECT id_seance FROM ' . $tb_seance . ' ORDER BY date_seance ASC;');
        $seancerecente = mysql_fetch_assoc($rq_seancerecente);
        //INSERT dans ETUDIANT
        $redirige = mysql_query('INSERT INTO ' . $tb_etudiant . ' (nom_etu, prenom_etu, pseudo_etu, mail_etu, pass_etu) '
                . 'VALUES ("' . $_POST["nom_etu"] . '", "' . $_POST["prenom_etu"] . '", "' . $_POST["pseudo_etu"] . '", "' . $_POST["mail_etu"] . '", "' . md5($_POST["pass_etu"]) . '");') or die (mysql_error());
        //récupère l'autoincrement créé pour la connexion future
        $id_etu = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id_etu_insere"));

        //récupère l'id de la séance en cours
        $now = date("Y-m-d");   //recupère la date de maintenant
        $sql = 'SELECT id_seance,date_seance FROM ' . $tb_seance . ' ORDER BY date_seance ASC';  //toutes les séances
        $req = mysql_query($sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysql_error());
        $seance_premiere = "";
        while ($data = mysql_fetch_assoc($req)) {
            //première séance
            if (empty($seance_premiere))
                $seance_premiere = $data['id_seance'];
            //recherche la séance à compléter
            if ($data['date_seance'] <= $now) {
                $seance_encours = $data['id_seance'];
            }
        }
        $seance_encours = (isset($seance_encours) && !empty($seance_encours) ? $seance_encours : $seance_premiere);

        /*//INSERT dans AVANCEMENT
        $rq_exercices = mysql_query('SELECT id_exo FROM ' . $tb_exercice . ';');
        while ($mon_exo = mysql_fetch_assoc($rq_exercices)) {
            $sql = 'INSERT INTO ' . $tb_avancement . ' (id_etu, id_exo, fait, compris, assimile, id_seance) '
                    . 'VALUES ("' . $id_etu['id_etu_insere'] . '", "' . $mon_exo["id_exo"] . '", "0", "0", "0", ' . $seance_encours . ' );';
            mysql_query($sql) or die(mysql_error());
        }*/

        //INSERT dans AVANCEMENT_BONUS
        $rq_bonus = mysql_query('SELECT id_bonus FROM ' . $tb_bonus . ';');
        while ($mon_bonus = mysql_fetch_assoc($rq_bonus)) {
            $sql = 'INSERT INTO ' . $tb_avancement_bonus . ' (id_etu, id_bonus, fait, suivi, id_seance) '
                    . 'VALUES ("' . $id_etu['id_etu_insere'] . '", "' . $mon_bonus["id_bonus"] . '", "0", "0", ' . $seance_encours . ' );';
            mysql_query($sql) or die(mysql_error());
        }

        //CONNEXION après l'INSCRIPTION
        $_SESSION['pseudo'] = $_POST['pseudo_etu'];
        $_SESSION['nom'] = $_POST['nom_etu'];
        $_SESSION['prenom'] = $_POST['prenom_etu'];
        $_SESSION['mail'] = $_POST['mail_etu'];
        $_SESSION['id'] = $id_etu['id_etu_insere'];


        /* #################
         * ## REDIRECTION ##
         * #################
         */
        mysql_close($db);
        $_SESSION["notif_msg"] = '<div class="ok">Inscription effectuée avec succès...</div>';
    
    }

    
// on le redirige vers la page d'où il venait avec la notification qu'il y a eu erreur ou pas
    
}

/* ################
 * MODIF DE COMPTE
 * ################ */

if (isset($_POST['soumis1'])) { // si on a appuyé sur le bouton submit dans le formulaire de modification de compte
    $erreur = '';
    
    $reqVerifLogin = mysql_query("SELECT pseudo_etu FROM etudiant WHERE pseudo_etu = '" . $_POST["pseudo"] . "' AND id_etu != " . $_SESSION['id']);
    
    if (mysql_num_rows($reqVerifLogin) > 0)
        $erreur .= "&pseudo=" . $_POST["pseudo"];
    
    $reqVerifMail = mysql_query("SELECT mail_etu FROM etudiant WHERE mail_etu = '" . $_POST["mail"] . "' AND id_etu != " . $_SESSION['id']);
    
    if (mysql_num_rows($reqVerifMail) > 0)
        $erreur .= "&mail=" . $_POST["mail"];
    
    if(!verifierAdresseMail($_POST["mail"]))
    {
        $erreur .= "&mailinv=" . $_POST["mail"];
    }
    
    if(strpos($_POST["pseudo"], ' ') !== false)
    {
        $erreur .= "&logininv=" . $_POST["pseudo"];
    }
    
    if ($erreur != '')
        header('Location: index.php?section=mon_compte' . $erreur);
    else
    {
        // on modifie le gars dans la base
        $redirige = mysql_query("UPDATE " . $tb_etudiant . " " .
                "SET nom_etu = '" . $_POST["nom"] . "', prenom_etu = '" . $_POST["prenom"] . "', " .
                "mail_etu = '" . $_POST["mail"] . "', pseudo_etu = '" . $_POST["pseudo"] . "' " .
                "WHERE id_etu = " . $_SESSION["id"]);
        //Affectation de $_SESSION
        $_SESSION['pseudo'] = $_POST['pseudo'];
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['mail'] = $_POST['mail'];

        if (!$redirige)
            $erreur = 'Erreur SQL !<br>' . $sql . '<br>' . mysql_error();

        /* #################
         * ## REDIRECTION ##
         * #################
         */
        mysql_close($db);


        if ($redirige) {
            $_SESSION["notif_msg"] = '<div class="ok">Modification du compte effectuée avec succès...</div>';
        } else {
            $_SESSION["notif_msg"] = '<div class="erreur">Erreur dans l\' execution de la requête.' . $erreur . '</div>';
        }
        // on le redirige vers la page d'où il venait avec la notification qu'il y a eu erreur ou pas
        header('Location: index.php?section=mon_compte');
    }
}

/* ##############
 * MODIF DE PASS
 * ############## */
if (isset($_POST['soumis2'])) { // si on a appuyé sur le bouton submit dans le formulaire de modification de pass
// on modifie le pass dans la base
    $redirige = mysql_query("UPDATE " . $tb_etudiant . " " .
            "SET pass_etu = '" . md5($_POST["pass1"]) . "' " .
            "WHERE id_etu = " . $_SESSION["id"]);
    if (!$redirige)
        $erreur = 'Erreur SQL !<br>' . $sql . '<br>' . mysql_error();

    /* #################
     * ## REDIRECTION ##
     * #################
     */
    mysql_close($db);


    if ($redirige) {
        $_SESSION["notif_msg"] = '<div class="ok">Modification du mot de passe éfféctuée avec succès...</div>';
    } else {
        $_SESSION["notif_msg"] = '<div class="erreur">Erreur dans l\' execution de la requête.' . $erreur . '</div>';
    }
// on le redirige vers la page d'où il venait avec la notification qu'il y a eu erreur ou pas
    header('Location: index.php?section=mon_compte');
}
?>