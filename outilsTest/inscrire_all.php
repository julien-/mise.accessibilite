<?php
/* lol */
include_once('/sql/connexion_mysql.php');
mysql_query("START TRANSACTION") or die (mysql_error());
$sql = "SELECT * FROM etudiant WHERE id_etu != 17";
$reqEtudiant = mysql_query($sql) or die (mysql_error());

while($etudiant = mysql_fetch_array($reqEtudiant))
{
        mysql_query("INSERT INTO inscription VALUES (1, " . $etudiant['id_etu'] . ")") or die (mysql_error());
}

mysql_query("COMMIT") or die (mysql_error());
