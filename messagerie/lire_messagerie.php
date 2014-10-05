<?php
    echo getFilArianne(array('index.php?section=reception_messagerie' => 'Boîte de réception', 'index.php?section=lire_messagerie&id_message=' . $_GET['id_message'] => 'Message reçu'));
?>
<h1 class="titre_page_school">Message reçu</h1>
<?php
// on teste si notre paramètre existe bien et qu'il n'est pas vide
if (!isset($_GET['id_message']) || empty($_GET['id_message'])) {
	echo 'Aucun message reconnu.';
}
else {
    include_once('../fonctions.php');
	// on prépare une requete SQL selectionnant la date, le titre et l'expediteur du message que l'on souhaite lire, tout en prenant soin de vérifier que le message appartient bien au membre connecté
	$sql = 'SELECT nom_etu, prenom_etu, titre_mess as titre, date_mess as date, heure_mess as heure, texte_mess as message, etudiant.pseudo_etu as expediteur FROM messages, etudiant WHERE destinataire="'.$_SESSION['id'].'" AND expediteur=etudiant.id_etu AND messages.id_mess="'.$_GET['id_message'].'"';
	// on lance cette requete SQL à MySQL
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$nb = mysql_num_rows($req);
        
        $sql = "UPDATE messages SET lu = 1 WHERE id_mess = " . $_GET['id_message'];
	mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	if ($nb == 0) {
	echo 'Aucun message reconnu.';
	}
	else {
	// si le message a été trouvé, on l'affiche
	$data = mysql_fetch_array($req);
?>
<span style="text-align:right;"><a class="button_1" href="supprimer.php?id_message=' , <?php echo $_GET['id_message']; ?> , '">Supprimer ce message</a></span>
<br/><br/>
        <div class="envoyer_mess">
            <form class="form_envoyer">
                <span class="libelle_champ"><label>De: <?php echo $data['prenom_etu'] . ' ' . $data['nom_etu']; ?></label></span><br />
                <span class="libelle_champ"><label>Le: <?php echo transformerDate(substr($data['date'], 0, 10)); ?> à <?php echo $data['heure']; ?></label></span><br />
                <span class="libelle_champ"><label>Titre: <?php echo $data['titre']; ?></label></span><br />
                <span class="libelle_champ"></span><textarea readonly name="message"><?php echo $data['message']; ?></textarea><br />
                <p><a class="button_1" href="index.php?section=envoyer_messagerie&repondre=<?php echo $_GET['id_message']; ?>">Répondre</a></p>
            </form>
        </div>
<?php
	}
	mysql_free_result($req);
	mysql_close();
}
?>

