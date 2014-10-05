<?php
include_once('../sql/connexion_mysql.php');
include_once('../fonctions.php');
$lienRepondre = '';
$titre = 'Envoyer un message';

if (isset($_GET['repondre']))
{
    $lienRepondre = "&repondre=" . $_GET['repondre'];
    $titre = 'Répondre';
}
echo getFilArianne(array('index.php?section=reception_messagerie' => 'Boîte de réception', 'index.php?section=envoyer_messagerie' . $lienRepondre => $titre));
// on vérifie toujours qu'il s'agit d'un membre qui est connecté

// on teste si le formulaire a bien été soumis
if (isset($_POST['go']) && $_POST['go'] == 'Envoyer le message') {
	if (empty($_POST['destinataire']) || empty($_POST['titre']) || empty($_POST['message'])) {
	$erreur = 'Au moins un des champs est vide.';
	}
	else {

	// si tout a été bien rempli, on insère le message dans notre table SQL
	$sql = 'INSERT INTO messages VALUES("", "'.$_SESSION['id'].'", "'.$_POST['destinataire'].'", "'.date("Y-m-d H:i:s").'", "'.date("H:i:s").'", "'.mysql_real_escape_string($_POST['titre']).'", "'.mysql_real_escape_string($_POST['message']).'", 0)';
	mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

        $sql = 'SELECT MAX(id_mess) as maxi FROM messages WHERE expediteur =' . $_SESSION['id'];
	$reqIDMess = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
        $IDMess = mysql_fetch_array($reqIDMess);
        
        $sql = 'SELECT * FROM etudiant WHERE id_etu =' . $_POST['destinataire'];
	$reqDestinataire = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
        $destinataire = mysql_fetch_array($reqDestinataire);
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $destinataire['mail_etu'])) // On filtre les serveurs qui rencontrent des bogues.
        {
                $passage_ligne = "\r\n";
        }
        else
        {
                $passage_ligne = "\n";
        }
        $message = "<html>Bonjour " . $destinataire['prenom_etu'] . "<br/><br/>";
        $message .= "Vous avez reçu un message de " . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . ' sur My Study Companion.' . "<br/><br/>";
        $message .= '<a href="http://projetir.free.fr/index.php?section=lire_messagerie&id_message=' . $IDMess['maxi'] . '">Cliquez ici pour le découvrir</a></html>';
        mailFree($destinataire['mail_etu'] ,"Nouveau message !" , $message);
        }
}
?>

<h1 class="titre_page_school">Envoyer un message</h1>

<?php
if (isset($_POST['go']) && $_POST['go'] == 'Envoyer le message')
{
    $envoye = true;
    echo "<p class=\"note\">Message envoyé !</p>";
}
else
    $envoye = false;
// on prépare une requete SQL selectionnant tous les login des membres du site en prenant soin de ne pas selectionner notre propre login, le tout, servant à alimenter le menu déroulant spécifiant le destinataire du message
$sql = 'SELECT pseudo_etu as nom_destinataire, nom_etu, prenom_etu, id_etu as id_destinataire FROM etudiant WHERE id_etu <> "'.$_SESSION['id'].'" ORDER BY prenom_etu ASC';
// on lance notre requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$nb = mysql_num_rows ($req);

if ($nb == 0) {
	// si aucun membre n'a été trouvé, on affiche tout simplement aucun formulaire
	echo 'Vous êtes le seul membre inscrit.';
}
else {
        $etuReponse = '';
        $titreReponse = '';
        $selected = '';
        if (isset($_GET['repondre']))
        {
            $sql = "SELECT * FROM messages WHERE id_mess=" . $_GET['repondre'];
            $reqReponse = mysql_query($sql) or die (mysql_error());
            $reponse = mysql_fetch_array($reqReponse);
            $etuReponse = $reponse['expediteur'];
            $titreReponse = 'RE: ' . $reponse['titre_mess'];
            
        }
        
        if (isset($_GET['aide']))
        {
            $sql = "SELECT * FROM avancement a, exercice e, theme t, etudiant et WHERE a.id_etu=et.id_etu AND t.id_theme = e.id_theme AND a.id_exo = e.id_exo AND a.id_etu =" . $_GET['p'] . " AND a.id_exo=" . $_GET['aide'];
            $reqReponse = mysql_query($sql) or die (mysql_error());
            $reponse = mysql_fetch_array($reqReponse);
            $etuReponse = $reponse['id_etu'];
            $titreReponse = 'Demande d\'aide pour l\'exercice ' . $reponse['num_exo'] . ' du thème ' . $reponse['titre_theme'] . ' (' . $reponse['titre_exo'] . ') !!!';
        }
        $etudiant = exists('etudiant', 'etudiant', 'id_etu');
                
	// si au moins un membre qui n'est pas nous même a été trouvé, on affiche le formulaire d'envoie de message
	?>
        <div class="envoyer_mess">
            <form action="index.php?section=envoyer_messagerie" method="post" class="form_envoyer">
            <span class="libelle_champ">Pour : <select name="destinataire">
            <?php
            // on alimente le menu déroulant avec les login des différents membres du site
            while ($data = mysql_fetch_array($req)) {
                if (($data['prenom_etu'] != 'test') && ($data['prenom_etu'] != 'lol'))
                {
                    if ($data['id_destinataire'] == $etudiant || $data['id_destinataire'] == $etuReponse && !$envoye)
                        $selected = 'selected="selected"';
                    else
                        $selected = '';
                    echo '<option ' . $selected . ' value="' , $data['id_destinataire'] , '">' , $data['prenom_etu'].' '.$data['nom_etu'] , '</option>';
                }
             }
            ?>
            </select><br />
            <span class="libelle_champ">Titre: </span><input type="text" name="titre" value="<?php if (isset($_GET['repondre'])  || isset($_GET['aide'])) echo $titreReponse; if (isset($_POST['titre']) && !$envoye) echo $_POST['titre']; ?>"><br />
            <span class="libelle_champ">Message : </span><textarea name="message"><?php if (isset($_POST['message']) && !$envoye) echo $_POST['message']; ?></textarea><br />
            <br/>
            <div align="center"><input class="button_1" style="width: auto;" type="submit" name="go" value="Envoyer le message"></div>
            </form>
        </div>
	<?php
}
mysql_free_result($req);
// si une erreur est survenue lors de la soumission du formulaire, on l'affiche
if (isset($erreur)) echo '<br /><br />',$erreur;
?>