<html>
<head>
<title>Lecture d'un sujet</title>
</head>
<body>

<?php
$sujet = exists('id_sujet_a_lire', 'forum_sujets', 'id');
$categorie = exists('categorie', 'forum_categorie', 'id_categorie');
$cours = exists('id_cours', 'cours', 'id_cours');
if ($sujet == false || $categorie == false || $cours == false) {
	header('Location: index.php?section=introuvable');
}
else {
        $titreSujet = getTopic($sujet);
        echo getFilArianne('selected_cours_perso', array('index.php?section=index_forum&id_cours=' . $cours => 'Index du forum', 'index.php?section=liste_posts_forum&categorie=' . $categorie . '&id_cours=' . $cours => getCategorie($categorie), 'final' => $titreSujet));

        $messagesParPage = 15;
        // on prépare notre requête
        $sql = 'SELECT id, nom_etu, prenom_etu, message, date_reponse, id_etu FROM etudiant, forum_reponses WHERE etudiant.id_etu = forum_reponses.auteur AND correspondance_sujet="'.$sujet.'" ORDER BY date_reponse';

        // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
        $reqNbpages = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        $nbPages = ceil(mysql_num_rows($reqNbpages) / $messagesParPage);
        if ($nbPages == 0 && isset($_GET['deleted']))
        {
            deleteSujet($sujet);
            header('Location: index.php?section=liste_posts_forum&id_cours='. $cours . '&categorie=' . $categorie);
        }
?>
        <h1 class="titre_page_school_no_space"><?php echo $titreSujet; ?></h1>
        <a class="button_1" href="index.php?section=insert_reponse_forum&categorie=<?php echo $categorie; ?>&id_cours=<?php echo $cours; ?>&numero_du_sujet=<?php echo $sujet; ?>">R&eacute;pondre</a>
        <a class="button_1" href="index.php?section=liste_posts_forum&categorie=<?php echo $categorie; ?>&id_cours=<?php echo $cours; ?>">Retour liste des sujets</a>
        <br/>
        <br/>
        
	<?php    
        
        if (!isset($_GET['page']))
            $page = 1;
        else
            $page = $_GET['page'];

        
        
        if (isset($_GET['posted']))
        {
            $page = $nbPages;
        }  
	// on prépare notre requête
	$sql = 'SELECT id, nom_etu, prenom_etu, message, date_reponse, id_etu FROM etudiant, forum_reponses WHERE etudiant.id_etu = forum_reponses.auteur AND correspondance_sujet="'.$sujet.'" ORDER BY date_reponse ASC LIMIT '. (($page - 1)*$messagesParPage) . ',' . $messagesParPage;

	// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

        include_once ('../vues/topic.php'); ?>
        <p>
            <?php
            if ($nbPages > 1 && $page != 1)
            {
                ?>
            <a href="index.php?section=lire_sujet_forum&page=1&categorie=<?php echo $categorie; ?>&id_cours=<?php echo $cours; ?>&id_sujet_a_lire=<?php echo $sujet; ?>"><img width="40" src="../images/page_first.png" alt="Premi&egrave;re page" title="Premi&egrave;re page"/></a>
                    <a href="index.php?section=lire_sujet_forum&page=<?php echo $page - 1; ?>&categorie=<?php echo $categorie; ?>&id_cours=<?php echo $cours; ?>&id_sujet_a_lire=<?php echo $sujet; ?>"><img width="40" src="../images/page_back.png" alt="Page pr&eacute;c&eacute;dente" title="Page pr&eacute;c&eacute;dente"/></a>
                <?php
            }
            if ($nbPages > 1 && $page != $nbPages)
            {
                ?>
                    <a href="index.php?section=lire_sujet_forum&page=<?php echo $page + 1; ?>&categorie=<?php echo $categorie; ?>&id_cours=<?php echo $cours; ?>&id_sujet_a_lire=<?php echo $sujet; ?>"><img width="40" src="../images/page_next.png" alt="Page suivante" title="Page suivante"/></a>
                    <a href="index.php?section=lire_sujet_forum&page=<?php echo $nbPages; ?>&categorie=<?php echo $categorie; ?>&id_cours=<?php echo $cours; ?>&id_sujet_a_lire=<?php echo $sujet; ?>"><img width="40" src="../images/page_last.png" alt="Derni&egrave;re page" title="Derni&egrave;re page"/></a>
                <?php
            }
            ?>
        </p>
	<!-- on insère un lien qui nous permettra de rajouter des réponses à ce sujet -->
        <a class="button_1" href="index.php?section=insert_reponse_forum&categorie=<?php echo $categorie; ?>&id_cours=<?php echo $cours; ?>&numero_du_sujet=<?php echo $sujet; ?>">R&eacute;pondre</a>
	<?php
}
?>
</body>
</html>