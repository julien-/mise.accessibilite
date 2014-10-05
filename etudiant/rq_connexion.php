<?php

session_start();
if (isset($_POST['submit']) && !isset($_SESSION['id'])) { // si on a appuyé sur le bouton submit dans le formulaire de connexion
    include_once('../sql/connexion_mysql.php');
    $champRecherche = "pseudo_etu";
    if ((strpos($_POST['pseudo'], '@') !== FALSE) && (strpos($_POST['pseudo'], '.') !== FALSE))
    {
        $champRecherche = "mail_etu";

    }

    // on cherche le gars dans la base
    $sql = "SELECT * FROM etudiant WHERE pass_etu='" . md5($_POST['password']) . "' AND $champRecherche='" . $_POST['pseudo']. "'";
    $req = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
    $erreur = "";

    if (mysql_num_rows($req) > 0) 
    { // il est dans la base
        $etudiant = mysql_fetch_array($req);
        $_SESSION['pseudo'] = $etudiant['pseudo_etu'];
        $_SESSION['nom'] = $etudiant['nom_etu'];
        $_SESSION['prenom'] = $etudiant['prenom_etu'];
        $_SESSION['mail'] = $etudiant['mail_etu'];
        $_SESSION['id'] = $etudiant['id_etu'];
        $_SESSION['admin'] = $etudiant['admin'];
        //notification:
        $_SESSION["notif_msg"] = '<div class="ok">Connexion réussie</div>';
    } else 
    { // il y est pas on dit que y a erreur dans les paramètres $_GET de l'url de redirection
        $erreur = "&erreur=true";
        //notification:
        $_SESSION["notif_msg"] = '<div class="erreur">Connexion échouée</div>';
    }

    /* #################
     * ## REDIRECTION ##
     * #################
     */
    
    if (isset($_GET['section']))
        $retourPage = '&' . substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'], "?")+1);
    
    if ($etudiant['admin'])
        $typeUser = "admin";
    else
        $typeUser = "etudiant";
    // on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
    header('Location: ../' . $typeUser . '/index.php?redir=1' . $erreur . $retourPage);
}
else if (isset($_SESSION['id']))
{
    if ($_SESSION['admin'])
        $typeUser = "admin";
    else
        $typeUser = "etudiant";
    header('Location: ../' . $typeUser . '/index.php?redir=1' . $erreur . $retourPage);
}
?>