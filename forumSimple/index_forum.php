<html>
<head>
<title>Index de notre forum</title>
</head>
<body>
<?php
$id_cours = exists('id_cours', 'cours', 'id_cours');
if ($id_cours == false)
{
    header('Location: index.php?section=introuvable');
}
 else 
{
    echo getFilArianne('selected_cours_perso', array('index.php?section=mes_cours' => 'Mes cours', 'index.php?section=evolution&id_cours=' . $id_cours => getCourse($id_cours), 'final' => 'Index du forum'));

?>
<h1 class="titre_page_school_no_space">Forum</h1>
<h2 class="titre_h2_school"><?php echo getCourse($id_cours) ?></h2>

<?php

if ($_SESSION['admin'])
{
    ?>
    <a class="button_1" href="index.php?section=insert_categorie_forum&id_cours=<?php echo $id_cours; ?>">Insérer une catégorie</a>
    <?php
}

?>
<br /><br />

<?php
// on se connecte à notre base de données
include('../sql/connexion_mysql.php');

// préparation de la requete
$sql = 'SELECT titre_categorie, description_categorie, c.id_categorie, count(DISTINCT(s.id)) as nbSujets, count(r.id) as nbMessages
        FROM forum_categorie c
        LEFT JOIN forum_sujets s ON s.id_categorie = c.id_categorie
        LEFT JOIN forum_reponses r ON r.correspondance_sujet = s.id
        WHERE c.id_cours = ' . $id_cours .' 
        GROUP BY c.id_categorie
        ORDER BY s.id_categorie ASC
        ';

// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on compte le nombre de sujets du forum
$nb_sujets = mysql_num_rows ($req);

if ($nb_sujets == 0) {
        ?>
            <p class="oldschool">Forum vide :(</p>
         <?php
}
else {
	?>
	<table class="tableau">
            <thead>
                <tr>
                    <th>
                        Forum
                    </th>
                    <th>
                        Sujets
                    </th>
                    <th>
                        Messages
                    </th>
                    <?php
                    if ($_SESSION['admin'])
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

                    <?php
                    while ($data = mysql_fetch_array($req)) {
                        ?>
                        <tr>
                            <td class="prem_colonne">
                                <a href="index.php?section=liste_posts_forum&categorie=<?php echo $data['id_categorie']; ?>&id_cours=<?php echo $id_cours; ?>"><?php echo $data['titre_categorie']; ?></a>
                                <br/>
                                <span><?php echo $data['description_categorie']; ?></span>
                            </td>
                            <td class="autre_colonne">
                                <?php echo $data['nbSujets']; ?>
                            </td>
                            <td class="autre_colonne">
                                <?php echo $data['nbMessages']; ?>
                            </td>
                            <?php
                            if ($_SESSION['admin'])
                            {
                            ?>
                                <td class="autre_colonne">
                                    <a href="../forumSimple/delete.php?section=<?php echo $_GET['section']; ?>&cours=<?php echo $id_cours; ?>&type=categorie&id=<?php echo $data['id_categorie']; ?>"><img src="../images/admin/flat_supp.png" alt="Supprimer" title="Supprimer" /></a>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
        </table>
	<?php
}

// on libère l'espace mémoire alloué pour cette requête
mysql_free_result ($req);
// on ferme la connexion à la base de données.
mysql_close ();
}
?>
</body>
</html>