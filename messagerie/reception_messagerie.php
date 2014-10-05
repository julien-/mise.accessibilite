

<link rel="stylesheet" href="../<?php echo $dossiercss; ?>messagerie.css" />
<h1 class="titre_page_school">Mes messages</h1>
<a class="button_1" href="index.php?section=envoyer_messagerie">Envoyer un message</a>

<?php
include_once("../fonctions.php");
// on prépare une requete SQL cherchant tous les titres, les dates ainsi que l'auteur des messages pour le membre connecté
$sql = 'SELECT titre_mess, date_mess, heure_mess, etudiant.prenom_etu as prenom_expediteur, etudiant.nom_etu as nom_expediteur, messages.id_mess as id_message, lu FROM messages, etudiant WHERE destinataire="'.$_SESSION['id'].'" AND expediteur=etudiant.id_etu ORDER BY date_mess DESC';
// lancement de la requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$nb = mysql_num_rows($req);

if ($nb == 0) {
	echo 'Vous n\'avez aucun message.';
}
else {
    echo "<br/>";echo "<br/>";
        echo "<table id=\"tableau\">";
        echo "<thead><th>Expéditeur</th><th>Titre</th><th>Date</th></tr></thead><tbody>";
	// si on a des messages, on affiche la date, un lien vers la page lire.php ainsi que le titre et l'auteur du message
	while ($data = mysql_fetch_array($req)) 
        {
            echo "<tr><td class=\"col_expediteur\""; if (!$data['lu']) echo ' style="font-weight: bold;" '; echo ">" . $data['prenom_expediteur'] . ' ' . $data['nom_expediteur'] . "</td><td class=\"col_titre\""; if (!$data['lu']) echo ' style="font-weight: bold; " '; echo "><a href=\"index.php?section=lire_messagerie&id_message=" . $data['id_message'] , '">' . $data['titre_mess'] . "</a></td><td class=\"col_date\""; if (!$data['lu']) echo ' style="font-weight: bold;" '; echo ">" . transformerDate(substr($data['date_mess'], 0, 10)) . " à " . $data['heure_mess'] . "</td></tr>";
	}
        echo "</tbody></table>";
}
mysql_free_result($req);
mysql_close();
?>
