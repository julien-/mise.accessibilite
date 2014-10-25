<?php
$daoMessagerie = new DAOMessagerie($db);
$daoInscription = new DAOInscription($db);
$daoEtudiant = new DAOEtudiant($db);

if (isset($_POST['go']) && $_POST['go'] == 'Envoyer le message') 
{
	if (empty($_POST['destinataire']) || empty($_POST['titre']) || empty($_POST['message'])) 
	{
		$erreur = 'Au moins un des champs est vide.';
	}
	else 
	{
		$message = new Messagerie(array(
				'destinataire' => $daoEtudiant->getByID($_POST['destinataire']),
				'expediteur' => $daoEtudiant->getByID($_SESSION['currentUser']->getId()),
				'date' => date("Y-m-d H:i:s"),
				'heure' => date("H:i:s"),
				'titre' => mysql_real_escape_string($_POST['titre']),
				'texte' => mysql_real_escape_string($_POST['message']),
				'lu' => 0
		));
		$daoMessagerie->send($message);
	}
}
?>

<h1>Envoyer un message</h1>

<?php
if (isset($_POST['go']) && $_POST['go'] == 'Envoyer le message')
{
    $envoye = true;
    echo "<p class=\"note\">Message envoyé !</p>";
}
else
    $envoye = false;

$listeClassmates = $daoInscription->getClassmates($_SESSION['currentUser']->getId());

if (sizeof($listeClassmates) == 0) 
{
	// si aucun membre n'a été trouvé, on affiche tout simplement aucun formulaire
	echo 'Vous êtes le seul membre inscrit.';
}
else {     
	// si au moins un membre qui n'est pas nous même a été trouvé, on affiche le formulaire d'envoie de message
	?>
        <div class="row tt-input-group">
            <form action="index.php?section=envoyer_messagerie" method="post" class="form_envoyer">
            <div class="col-lg-1">Pour :</div>
            <div class="col-lg-11">
            <input type="text" style="border: 1px solid darkgray;" class="typeahead" id="nom_destinataire" /><br/>
            <input type="hidden" class="typeahead" name="destinataire" id="destinataire" /><br/>
            </div>
   		</div>
   		<div class="row">
   		<br/>
            <div class="col-lg-1">Titre: </div>
            <div class="col-lg-11"><input type="text" style="width: 100%;" name="titre" value="<?php if (isset($_GET['repondre'])  || isset($_GET['aide'])) echo $titreReponse; if (isset($_POST['titre']) && !$envoye) echo $_POST['titre']; ?>"></div>
        </div>
        <div class="row">
        <br/>
            <div class="col-lg-12"><textarea style="width: 100%; height: 200px;" name="message"><?php if (isset($_POST['message']) && !$envoye) echo $_POST['message']; ?></textarea><div/>
        </div>
        <br/>
            <div align="center"><input class="btn btn-primary" style="width: auto;" type="submit" name="go" value="Envoyer le message"></div>
            </form>
        </div>
	<?php
}
// si une erreur est survenue lors de la soumission du formulaire, on l'affiche
if (isset($erreur)) echo '<br /><br />',$erreur;
?>