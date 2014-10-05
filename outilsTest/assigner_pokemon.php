<?php

include_once('connexion_mysql.php');
mysql_query("START TRANSACTION") or die (mysql_error());
$sql = "SELECT * FROM etudiant WHERE id_etu != 17";
$reqEtudiant = mysql_query($sql) or die (mysql_error());

while($etudiant = mysql_fetch_array($reqEtudiant))
{

        mysql_query("INSERT INTO avancement VALUES (".$etudiant['id_etu'].",45,0,0,0,4)") or die (mysql_error());
        mysql_query("INSERT INTO avancement VALUES (".$etudiant['id_etu'].",46,0,0,0,4)") or die (mysql_error());
}

mysql_query("COMMIT") or die (mysql_error());
