<?php

include_once('connexion_mysql.php');

$sql = "SELECT id_etu FROM etudiant";
$reqEtudiant = mysql_query($sql) or die (mysql_error());

while($etudiant = mysql_fetch_array($reqEtudiant))
{
    mysql_query("INSERT INTO historique VALUES ('', 'accueil', '2014-03-29', '23:26:53'," . $etudiant['id_etu'] . ')') or die (mysql_error());
    mysql_query("INSERT INTO historique VALUES ('', 'accueil', '2014-03-30', '23:26:54'," . $etudiant['id_etu'] . ')') or die (mysql_error());
}

?>