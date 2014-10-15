<?php
$sujet = exists('numero_du_sujet', 'forum_sujets', 'id_sujet');
if ($sujet == false){
    header('Location: index.php?section=introuvable');
}
// on teste si le formulaire a été soumis
if (isset ($_POST['go']) && $_POST['go']=='Poster') {
	// on teste le contenu de la variable $auteur
	if (!isset($_POST['message']) || !isset($_GET['numero_du_sujet'])) {
	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
	if (empty($_POST['message']) || empty($_GET['numero_du_sujet'])) {
		$erreur = 'Au moins un des champs est vide.';
	}
	// si tout est bon, on peut commencer l'insertion dans la base
	else {

		// on recupere la date de l'instant présent
		$date = date("Y-m-d H:i:s");

		// préparation de la requête d'insertion (table forum_reponses)
		$sql = 'INSERT INTO forum_reponses VALUES("", '. $_SESSION['currentUser']->getId() .', "'.mysql_escape_string($_POST['message']).'", "'.$date.'", "'.$_GET['numero_du_sujet'].'")';

		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

		// préparation de la requête de modification de la date de la dernière réponse postée (dans la table forum_sujets)
		$sql = 'UPDATE forum_sujets SET date_derniere_reponse="'.$date.'" WHERE id_sujet="'.$_GET['numero_du_sujet'].'"';

		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

		// on ferme la connexion à la base de données
		mysql_close();

		// on redirige vers la page de lecture du sujet en cours
		?>
		    <script>
    	document.location.replace('<?php echo 'index.php?posted=true&section=lire_sujet_forum&categorie='.$_POST['categorie'].'&id_cours='.$_POST['cours'].'&id_sujet_a_lire='.$_GET['numero_du_sujet']?>');
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
<title>Insertion d'une nouvelle réponse</title>
</head>

<body>
    <h1 class="titre_page_school">Sujet: <?php echo getTopic($sujet); ?></h1>
    <p style="font-weight: bold;">10 derni&egrave;res r&eacute;ponses</p>
    <?php 
                
	// on prépare notre requête
	$sql = 'SELECT id_reponse, nom_etu, prenom_etu, message, date_reponse, id_etu FROM etudiant, forum_reponses WHERE etudiant.id_etu = forum_reponses.auteur AND correspondance_sujet="'.$sujet.'" ORDER BY date_reponse ASC LIMIT 10';

	// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    include_once('../../vues/topic.php'); ?>

<!-- on fait pointer le formulaire vers la page traitant les données -->
<form action="index.php?section=insert_reponse_forum&numero_du_sujet=<?php echo $_GET['numero_du_sujet']; ?>" method="post">
    <table class="tableau">
        <thead>
        <tr>
            <th>
                R&eacute;pondre
            </th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="autre_colonne">
                    <textarea name="message" cols="100" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <input type="submit" name="go" value="Poster" class="button_1">
                    <input type="hidden" name="cours" value="<?php echo $_GET['id_cours']; ?>" />
                    <input type="hidden" name="categorie" value="<?php echo $_GET['categorie']; ?>"/>
                </td>
            </tr>

        </tbody>
    </table>
</form>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
</html>