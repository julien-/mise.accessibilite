<?php

include_once('connexion_mysql.php');
include_once('fonctions.php');
$sql = "SELECT id_etu FROM etudiant";
$reqEtudiant = mysql_query($sql) or die (mysql_error());

while($etudiant = mysql_fetch_array($reqEtudiant))
{
    envoyerMessage(17, $etudiant['id_etu'], "Nouveautés !", "Bonjour à toutes et à tous !

Comme vous pouvez le constater, le site a beaucoup changé ces derniers temps. En plus de l'arrivée des Pokémon, une messagerie est désormais à votre disposition pour pouvoir communiquer entre vous si vous avez besoin d'aide pour résoudre un exercice.

D'autres nouveautés sont à prévoir dans les prochains jours !

Bon travail ;)");
}

?>