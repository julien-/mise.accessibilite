session_start();
<script type="text/javascript"
  src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'>
</script>
<?php

include_once "../config.php";
include_once "../sql/connexion_mysql.php";
session_start();
include_once('../fonctions.php');
if (!isset($_SESSION['pseudo'])) {
    $page = "connexion"; //NON CONNECTE en tant que PROFESSEUR
} else {
    if ($_SESSION['admin'])
    {
        //CONNECTE en tant que PROFESSEUR
        if (isset($_GET['section'])) {
            $page = $_GET['section'];
            if (strpos($page, 'forum') != false)
                $page = '../forumSimple/' . $page;

            if (strpos($page, 'messagerie') != false)
                $page = '../messagerie/' . $page;
        } else {
            $page = "mes_cours";
        }
    }
    else
    {
        header('Location: ../etudiant/index.php');
    }
}

if (isset($_SESSION["id"])) {
    $sql = "SELECT COUNT(*) as admin FROM etudiant WHERE id_etu = " . $_SESSION["id"] . " AND admin = 1";
    $reqAdmin = mysql_query($sql) or die(mysql_error());
    $admin = mysql_fetch_assoc($reqAdmin);
}
if (isset($admin['admin']))
    $cheminAdmin = "../";
else {
    $cheminAdmin = "";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../<?php echo $dossiercss; ?>style.css" />
        <link rel="stylesheet" href="../<?php echo $dossiercss; ?>popup.css" />
        <link rel="stylesheet" href="../<?php echo($dossiercss . $page . ".css"); ?>"/>
        <link rel="stylesheet" href="../css/onglets.css" />
        <link rel="stylesheet" href="../css/tableau.css" />
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
        <div id="haut">
            <a href="index.php"><img id="logo_titre" src="../<?php echo $dossierimg ?>logo_titre.png" alt="logo"/></a>
            <?php if (isset($_SESSION['nom'])) {
                
                $sql = "SELECT COUNT(*) FROM messages WHERE destinataire = " . $_SESSION['id'] . " AND lu = 0";
                $reqNewMails = mysql_query($sql) or die (mysql_error());
                $newMails = mysql_fetch_array($reqNewMails);
                $couleur = "white";
                if ($newMails['COUNT(*)'] > 0)
                    $couleur = "yellow";
                ?>


                <div id="box_identif"><a href="index.php?section=mon_compte" class="mon_compte_link"><?php echo $_SESSION["prenom"]; ?><?php echo $_SESSION["nom"]; ?></a>
                    &nbsp;&nbsp;<a style="text-decoration: none;" href="index.php?section=reception_messagerie"><?php echo '<span style="color: ' . $couleur . ';">' . $newMails['COUNT(*)'] . '</span>'; ?><img width="30" id="icone_mail" src="../images/mail.png" alt="Mails" title="Mes messages"/></a>&nbsp;&nbsp;<a href="../identification/deconnexion.php">Se déconnecter</a>
                </div>
            
            <div class="spacer"></div>
                
            <?php } ?>
        </div>
        <?php
        if ($admin['admin']) {
            ?>
            <header>
                <nav>
                    <ul class="menu">
                        <li  <?php
        if ($page == "mes_cours") {
            echo "class=\"current\"";
        }
            ?>><a href="index.php?section=mes_cours">Mes cours</a></li>
                        <li <?php
                            if ($page == "seance") {
                                echo "class=\"current\"";
                            }
                            ?>><a href="index.php?section=seance">Mes séances</a></li>
                        <li <?php
                            if ($page == "recherche") {
                                echo "class=\"current\"";
                            }
                            ?>><a href="index.php?section=recherche">Mes &eacute;tudiants</a></li>
                    </ul>
                </nav>

            </header>
    <?php
}
?>

        <div id="bloc_page">
            <section>
                <div id="loader" style="position: absolute;
                                        top: 8px;
                                        width: 100%;
                                        height: 100%;
                                        z-index: 9999;
                                        background: url('../images/loading.gif') 50% 50% no-repeat white;"></div>
<?php
if (isset($admin['admin']) ) {   //CONNECTE en tant que PROFESSEUR
    if (isset($_GET["section"]) && $_GET["section"] == "mon_compte")
        include("../etudiant/mon_compte.php");
    else if (isset($_GET["section"]) && $_GET["section"] == "messagerie")
        include("../messagerie/messagerie.php");
    else if (isset($_GET["section"]) && $_GET["section"] == "lire")
        include("../messagerie/lire.php");
    else if (isset($_GET["section"]) && $_GET["section"] == "envoyer")
        include("../messagerie/envoyer.php");
    else if (isset($_GET["section"]) && $_GET["section"] == "supprimer")
        include("../messagerie/supprimer.php");
    else
        include($page . ".php");
}
else {
    //NON CONNECTE
    //echo "<h1>Vous n'avez pas l'autorisation d'accéder à cette page. SORRY BRO'</h1>";
    include("connexion.php");
}
?>
            </section>
        </div>
        <!--Integration de Jquery-->
        <script type="text/javascript" src="../<?php echo ($dossierjs); ?>jquery-1.11.0.js"></script>
        <script type="text/javascript" src="../<?php echo ($dossierjs); ?>jquery-1.4.3.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/loading.js"></script>

        <!--Integration des fichiers js de chaque page-->
        <script type="text/javascript" src="../<?php echo ($dossierjs); ?>popup.js"></script>
        <script type="text/javascript" src="../<?php echo ($dossierjs . $page . ".js"); ?>"></script>
        <script type="text/javascript" src="../<?php echo ($dossierjs); ?>commun.js"></script>
        
        
    </body>
</html>
