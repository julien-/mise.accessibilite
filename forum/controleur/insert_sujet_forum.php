<?php
// on teste si le formulaire a été soumis
if (isset ($_POST['go']) && $_POST['go']=='Poster') {
	// on teste la déclaration de nos variables
	if (!isset($_POST['titre']) || !isset($_POST['message'])) {
	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
	// on teste si les variables ne sont pas vides
	if (empty($_POST['titre']) || empty($_POST['message'])) {
		$erreur = 'Au moins un des champs est vide.';
	}

	// si tout est bon, on peut commencer l'insertion dans la base
	else {

		// on calcule la date actuelle
		$date = date("Y-m-d H:i:s");

		// préparation de la requête d'insertion (pour la table forum_sujets)
		$sql = 'INSERT INTO forum_sujets VALUES("", "'.mysql_escape_string($_SESSION['currentUser']->getId()).'", "'.mysql_escape_string($_POST['titre']).'", "'.$date.'", "'.mysql_escape_string($_POST['categorie']).'")';

		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

		// on recupère l'id qui vient de s'insérer dans la table forum_sujets
		$id_sujet = mysql_insert_id();

		// lancement de la requête d'insertion (pour la table forum_reponses
		$sql = 'INSERT INTO forum_reponses VALUES("", "'.mysql_escape_string($_SESSION['currentUser']->getId()).'", "'.mysql_escape_string($_POST['message']).'", "'.$date.'", "'.$id_sujet.'")';

		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

		// on ferme la connexion à la base de données
		mysql_close();

		// on redirige vers la page d'accueil
		header('Location: index.php?section=liste_posts_forum&id_cours='.$_POST['cours'] . '&categorie=' . $_POST['categorie']);
		?>
		<script>
		document.location.replace('<?php echo 'index.php?section=liste_posts_forum&id_cours='.$_POST['cours'] . '&categorie=' . $_POST['categorie']?>');
		</script>
		<?php 
		// on termine le script courant
		exit;
	}
	}
}
?>
<html>
<head>
<title>Insertion d'un nouveau sujet</title>
</head>

<body>
<?php

?>
    
<!-- on fait pointer le formulaire vers la page traitant les données -->
<form action="index.php?section=insert_sujet_forum" method="post">
    <table class="tableau">
        <thead>
            <tr>
                <th colspan="2">
                    Nouveau sujet
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="autre_colonne_right" style="font-weight:bold;" align="right">Titre </td>
                <td class="autre_colonne_left">
                    <input type="text" name="titre" maxlength="47" size="47" value="<?php if (isset($_POST['titre'])) echo htmlentities(trim($_POST['titre'])); ?>">
                </td>
            </tr>
            <tr>
                <td class="autre_colonne_right" style="font-weight:bold;" align="right">Message </td>
                <td class="autre_colonne_left">
                    <textarea name="message" cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="autre_colonne" colspan="2">
                    <input type="submit" name="go" value="Poster" class="button_1">
                    <input type="hidden" name="categorie" value="<?php echo $categorie; ?>">
                    <input type="hidden" name="cours" value="<?php echo $cours; ?>">
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