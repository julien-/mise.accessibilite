<?php
$_SESSION['referrer'] = current_page_url();
include_once('../../fonctions.php');
$categorie = exists('categorie', 'forum_categorie', 'id_categorie');
$cours = exists('id_cours', 'cours', 'id_cours');
if ($cours != false && $categorie != false)
{
    $titreCategorie = getCategorie($categorie);
    echo getFilArianne('selected_cours_perso', array('index.php?section=index_forum&id_cours=' . $cours => 'Index du forum', 'index.php?section=liste_posts_forum&categorie=' . $categorie . '&id_cours=' . $cours => $titreCategorie));
    ?>
    <h1 class="titre_page_school_no_space"><?php echo $titreCategorie ?></h1>
    <?php

    $messagesParPage = 10;
    if (!isset($_GET['page']))
        $page = 1;
    else
        $page = $_GET['page'];
    
    // comptage du nombre de pages
    $sql = 'SELECT count(DISTINCT(forum_reponses.id_reponse)) as nbMessages, forum_sujets.id_sujet, nom_etu, prenom_etu, titre, date_derniere_reponse FROM etudiant, forum_sujets LEFT JOIN forum_reponses ON correspondance_sujet = forum_sujets.id_sujet WHERE id_categorie = ' . $categorie . ' AND forum_sujets.auteur = etudiant.id_etu GROUP BY forum_sujets.id_sujet ORDER BY date_derniere_reponse DESC';
    $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    $nbPages = ceil(mysql_num_rows($req)/$messagesParPage);
    
    // préparation de la requete
    $sql = 'SELECT count(DISTINCT(forum_reponses.id_reponse)) as nbMessages, forum_sujets.id_sujet, nom_etu, prenom_etu, titre, date_derniere_reponse FROM etudiant, forum_sujets LEFT JOIN forum_reponses ON correspondance_sujet = forum_sujets.id_sujet  WHERE id_categorie = ' . $categorie . ' AND forum_sujets.auteur = etudiant.id_etu GROUP BY forum_sujets.id_sujet ORDER BY date_derniere_reponse DESC LIMIT '. (($page - 1)*$messagesParPage) . ',' . $messagesParPage;

    // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
    $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

    // on compte le nombre de sujets du forum
    $nb_sujets = mysql_num_rows ($req);

    if ($nb_sujets == 0) {
            ?>
                <p class="oldschool">Aucun sujet</p>
            <?php
            include_once('insert_sujet_forum.php');
    }
    else {
            ?>
            <table class="tableau">
                <thead>
                    <tr>
                        <th>
                            Auteur
                        </th>
                        <th>
                            Titre du sujet
                        </th>
                        <th>
                            Messages
                        </th>
                        <th>
                            Dernier message
                        </th>
                        <?php
                        if ($_SESSION['currentUser']->getAdmin())
                        {
                        ?>
                            <th>
                                Supprimer
                            </th>
                        <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
            <?php
            // on va scanner tous les tuples un par un
            while ($data = mysql_fetch_array($req)) {

            // on décompose la date
            sscanf($data['date_derniere_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

            // on affiche les résultats
            echo '<tr>';
            echo '<td class="autre_colonne">';

            // on affiche le nom de l'auteur de sujet
            echo htmlentities(trim($data['prenom_etu'] . ' ' . $data['nom_etu']));
            echo '</td><td class="prem_colonne">';

            // on affiche le titre du sujet, et sur ce sujet, on insère le lien qui nous permettra de lire les différentes réponses de ce sujet
            echo '<a href="index.php?section=lire_sujet_forum&id_cours=' . $cours . '&categorie=' . $categorie . '&id_sujet_a_lire=' , $data['id_sujet'] , '">' , htmlentities(trim($data['titre'])) , '</a>';
            
            echo '</td><td class="autre_colonne">'.$data['nbMessages'].'</td><td class="autre_colonne">';

            // on affiche la date de la dernière réponse de ce sujet
            echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;
            if ($_SESSION['currentUser']->getAdmin())
            {
            ?>
            <td class="autre_colonne">
                <a href="../../forum/controleur/delete.php?section=<?php echo $_GET['section']; ?>&categorie=<?php echo $categorie; ?>&cours=<?php echo $id_cours; ?>&type=sujet&id=<?php echo $data['id_sujet']; ?>"><img src="../../images/admin/flat_supp.png" alt="Supprimer" title="Supprimer" /></a>
            </td>
            <?php
            }
            }
            ?>
            </td>
            </tr></body></table>
            <p>
            <?php
            if ($nbPages > 1 && $page != 1)
            {
                ?>
                    <a href="index.php?section=liste_posts_forum&page=1&id_cours=<?php echo $cours; ?>&categorie=<?php echo $categorie; ?>"><img width="40" src="../images/page_first.png" alt="Premi&egrave;re page" title="Premi&egrave;re page"/></a>
                    <a href="index.php?section=liste_posts_forum&page=<?php echo $page - 1; ?>&id_cours=<?php echo $cours; ?>&categorie=<?php echo $categorie; ?>"><img width="40" src="../images/page_back.png" alt="Page pr&eacute;c&eacute;dente" title="Page pr&eacute;c&eacute;dente"/></a>
                <?php
            }
            if ($nbPages > 1 && $page != $nbPages)
            {
                ?>
                    <a href="index.php?section=liste_posts_forum&page=<?php echo $page + 1; ?>&id_cours=<?php echo $cours; ?>&categorie=<?php echo $categorie; ?>"><img width="40" src="../images/page_next.png" alt="Page suivante" title="Page suivante"/></a>
                    <a href="index.php?section=liste_posts_forum&page=<?php echo $nbPages; ?>&id_cours=<?php echo $cours; ?>&categorie=<?php echo $categorie; ?>"><img width="40" src="../images/page_last.png" alt="Derni&egrave;re page" title="Derni&egrave;re page"/></a>
                <?php
            }
            ?>
        </p>
            <?php
            include_once('insert_sujet_forum.php');
    }
}
else
    header('Location: index.php?section=introuvable');