<?php
// on teste si le formulaire a été soumis
$cours = exists('id_cours', 'cours', 'id_cours');

if (isset ($_POST['go']) && $_POST['go']=='Poster') {
        if ($cours == false){
            header('Location: index.php?section=introuvable');
        }
            
	// on teste la déclaration de nos variables
	if (!isset($_POST['titre']) || !isset($_POST['description'])) {
	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
	// on teste si les variables ne sont pas vides
	if (empty($_POST['titre']) || empty($_POST['description'])) {
		$erreur = 'Au moins un des champs est vide.';
	}

	// si tout est bon, on peut commencer l'insertion dans la base
	else {
		// on se connecte à notre base
                include('../sql/connexion_mysql.php');

		// on calcule la date actuelle
		$date = date("Y-m-d H:i:s");

		// préparation de la requête d'insertion (pour la table forum_sujets)
		$sql = 'INSERT INTO forum_categorie VALUES("", "'.mysql_escape_string($_POST['titre']).'", "'.mysql_escape_string($_POST['description']).'", "'.mysql_escape_string($_POST['id_cours']).'", NULL)';

		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

		// on ferme la connexion à la base de données
		mysql_close();

		// on redirige vers la page d'accueil
		header('Location: index.php?section=index_forum&id_cours='.mysql_escape_string($_POST['id_cours']));

		// on termine le script courant
		exit;
	}
	}
}
?>
<html>
<head>
<title>Ajout d'une nouvelle catégorie</title>
</head>

<body>
<h1 class="titre_page_school">Nouvelle cat&eacute;gorie</h1>
<!-- on fait pointer le formulaire vers la page traitant les données -->
<form action="index.php?section=insert_categorie_forum" method="post">
    <table class="tableau">
        <thead>
        <tr>
            <th colspan="2">
                Cat&eacute;gorie
            </th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="autre_colonne_right" style="font-weight:bold;" align="right">Titre </td>
                <td class="autre_colonne_left">
                    <input type="text" name="titre" maxlength="50" size="50" value="<?php if (isset($_POST['titre'])) echo htmlentities(trim($_POST['titre'])); ?>">
                </td>
            </tr>
            <tr>
                <td class="autre_colonne_right" style="font-weight:bold;" align="right">Description </td>
                <td class="autre_colonne_left">
                    <textarea name="description" maxlength="90" cols="50" rows="2"><?php if (isset($_POST['description'])) echo htmlentities(trim($_POST['description'])); ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="autre_colonne">
                    <input class="button_1" type="submit" name="go" value="Poster">
                    <input  type="hidden" name="id_cours" value="<?php echo $_GET['id_cours']; ?>">
                </td>
            </tr>
        </tbody>
    </table>
</form>
<?php
// on affiche les erreurs éventuelles
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
</html>