<script type="text/javascript"
  src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'>
</script>
<?php
include_once('../sql/connexion_mysql.php');
include_once('../fonctions.php');
$id_cours = exists('id_cours', 'cours', 'id_cours');
$debutConsignes = "<center><font style=\"font-weight: bold; font-size: 25px; font-family: 'please_write_me_a_songmedium';\">Infos</font></center>";
session_start();
include_once "../config.php";
include_once "../sql/connexion_mysql.php";

// vérif que c'est bien un étudiant
if ($_SESSION['admin'])
{
    header('Location: ../admin/index.php');
}
//affichage des notifications
if (isset($_SESSION["notif_msg"]) && !(empty($_SESSION["notif_msg"]))) {
    echo ($_SESSION["notif_msg"]);
    $_SESSION["notif_msg"] = "";
}

//inclusion des pages
if (!isset($_SESSION['pseudo'])) {
    $page = "connexion";
} else {
    if (isset($_GET['section'])) {
        $page = $_GET['section'];
        if (strpos($page, 'forum') != false)
            $page = '../forumSimple/' . $page;

        if (strpos($page, 'messagerie') != false)
            $page = '../messagerie/' . $page;  
    } 
    else {
        $page = "mes_cours";  //page par defaut
        
    }
    $sql = "INSERT INTO historique VALUES('', '$page', '" . date("Y-m-d") . "','" . date("H:i:s") . "', " . $_SESSION['id'] . ")";
    mysql_query($sql) or die (mysql_error());
}

/*if (isset($_SESSION['id'])) {
    $rq_avancement_global = mysql_query("SELECT ((SUM(fait) + SUM(compris) + SUM(assimile))/ (COUNT(id_exo)) ) AS avanc FROM " . $tb_avancement . " WHERE id_etu=" . $_SESSION['id']) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
    ;
    $mon_avancement_global = mysql_fetch_assoc($rq_avancement_global);
}*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../<?php echo $dossiercss; ?>style.css" />
        <link rel="stylesheet" href="../<?php echo $dossiercss; ?>tableau.css" />
        <link rel="stylesheet" href="../<?php echo $dossiercss . $page . ".css"; ?>"/>
        <script src="../js/onglets.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <title>My Study Companion - Suivez votre progression !</title>
    </head>

    <!--[if IE 6 ]><body class="ie6 old_ie"><![endif]-->
    <!--[if IE 7 ]><body class="ie7 old_ie"><![endif]-->
    <!--[if IE 8 ]><body class="ie8"><![endif]-->
    <!--[if IE 9 ]><body class="ie9"><![endif]-->
    <!--[if !IE]><!--><body><!--<![endif]-->


        <?php /*if (isset($_SESSION['pseudo'])) { ?>
            <!--######################
            # AFFICHAGE DE L'ECHELLE #
            ##########################-->
            <div id="echelle">
                <div id="contenu_echelle">
                    <div id="cache_echelle" style="height: <?php echo (100 - ($mon_avancement_global['avanc'])); ?>%">
                        <p <?php
                        if ($mon_avancement_global['avanc'] > 90)
                            echo('style="bottom: -50px"');  //évite qu'il soit trop au dessus 
                        ?>>
                                <?php echo (round($mon_avancement_global['avanc'], 0) . " %"); ?>
                        </p>
                    </div>
                </div>
                <p id="p_echelle">Evolution globale</p>
            </div>
            
        <?php } */?>
        <div id="haut">
            <div id="logo_titre">
                <a href="index.php"><img src="../<?php echo $dossierimg ?>logo_titre.png" alt="logo"/></a>
            </div>
            <?php if (isset($_SESSION['nom'])) {
                
                $sql = "SELECT COUNT(*) FROM messages WHERE destinataire = " . $_SESSION['id'] . " AND lu = 0";
                $reqNewMails = mysql_query($sql) or die (mysql_error());
                $newMails = mysql_fetch_array($reqNewMails);
                $couleur = "white";
                if ($newMails['COUNT(*)'] > 0)
                    $couleur = "yellow";
                ?>


            <div id="box_identif"><a href="index.php?section=mon_compte" class="mon_compte_link"><?php echo $_SESSION["prenom"] . ' '; ?><?php echo $_SESSION["nom"]; ?></a>
                    &nbsp;&nbsp;<a style="text-decoration: none;" href="index.php?section=reception_messagerie"><?php echo '<span style="color: ' . $couleur . ';">' . $newMails['COUNT(*)'] . '</span>'; ?><img width="30" id="icone_mail" src="../images/mail.png" alt="Mails" title="Mes messages"/></a>&nbsp;&nbsp;<a href="../identification/deconnexion.php">Se déconnecter</a>
                </div>
            
            <div class="spacer"></div>
                
            <?php } ?>
        </div>
        
        <header>                     
                <nav>
                    <ul class="menu">

                        <li
                            <?php
                                if ($page == "mes_cours") {
                                    echo "class=\"current\"";
                                }
                            ?>
                        >
                            <a href="index.php?section=mes_cours">Mes cours</a>    
                        </li>
                        <li  
                            <?php
                                if ($page == "liste_cours") {
                                    echo "class=\"current\"";
                                }
                            ?>
                        >
                            <a href="index.php?section=liste_cours">S'inscrire</a>
                        </li>

                        <?php 
                            if(($page == "evolution" || $page == "enregistrer_progression" || $page == "classement" || $page == "ma_progression" || $page == "details_theme" || $page == '../forumSimple/index_forum'))
                            {
                                if ($id_cours != false)
                                {
                                    $now = date("Y-m-d");   //recupère la date de maintenant
                                    $sql = 'SELECT id_seance,date_seance FROM ' . $tb_seance . ' WHERE id_cours = ' . $id_cours . ' ORDER BY date_seance ASC';  //toutes les séances
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
                            ?>                                
                            <li  
                                <?php
                                    if ($page == "evolution")
                                        echo "class=\"current\"";
                                ?>
                            >  
                                <a href="index.php?section=evolution&id_cours=<?php echo $id_cours; ?>">Mon Evolution</a>
                            </li>
                            <li  
                                <?php
                                    if ($page == "enregistrer_progression")
                                        echo "class=\"current\"";
                                ?>
                            >  
                                <a href="index.php?section=enregistrer_progression&seance=<?php echo(isset($seance_encours) && !empty($seance_encours) ? $seance_encours : $seance_premiere); ?>&id_cours=<?php echo $id_cours; ?>">Mise à jour</a>
                            </li>
                            <li  
                                <?php
                                    if ($page == "ma_progression")
                                        echo "class=\"current\"";
                                ?>
                            >  
                                <a href="index.php?section=ma_progression&id_cours=<?php echo $id_cours; ?>">Ma Progression</a>
                            </li>
                            <li  
                                <?php
                                    if ($page == "classement")
                                        echo "class=\"current\"";
                                ?>
                            >  
                                <a href="index.php?section=classement&id_cours=<?php echo $id_cours; ?>">Classement</a>
                            </li>
                            <li  
                                <?php
                                    if ($page == "forumSimple/section=index_forum") {
                                        echo "class=\"current\"";
                                    }
                                ?>
                            >
                                <a href="index.php?section=index_forum&id_cours=<?php echo $id_cours; ?>">Forum</a>
                            </li>
                            <?php
                                }
                                else
                                    header('Location: index.php?section=introuvable');
                            }
                            ?>
                    </ul>
                </nav>

        </header>
       
        
        <div id="bloc_page">
            <section>
                <?php
                if (file_exists($page . ".php"))
                    include($page . ".php");
                else
                    header('Location: index.php?section=introuvable');
                ?>
            </section>
            <!--###################### (fonctionne car après include de la page)
        # AFFICHAGE DES CONSIGNES (il faut définir consignes dans chaque page)
        ##########################-->
        <?php if (isset($consignes) && $consignes != 'Infos') {?>
            <div id="consignes">
                <?php echo($debutConsignes . $consignes); ?>
            </div>
            <?php
        }
        ?>
        </div>
        <!--Integration de Jquery-->
        <script type="text/javascript" src="../js/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="../<?php echo ($dossierjs); ?>jquery-1.4.3.min.js"></script>
        <!--Integartaion des fichiers js de chaque page-->
        <script type="text/javascript" src="../<?php echo ($dossierjs . $page . ".js"); ?>"></script>
        <script type="text/javascript" src="../<?php echo ($dossierjs); ?>commun.js"></script>
        <div class="clearfooter"></div>
        <footer>
            <span class="spanfooter">
            <span>Remarques, questions, bugs : <a href="mailto:mystudycompanion@gmail.com">mystudycompanion@gmail.com</a></span>
            <br/>
            <span>Copyright © 2014 - My Study Companion ® - Tous droits réservés</span>
            </span>
        </footer>
    </body>
</html>
