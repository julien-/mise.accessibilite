<?php

include_once('../sql/connexion_mysql.php');

$sql = "SELECT chemin_fichier, nom FROM fichiers WHERE code_lien = '" . $_GET['f'] . "'";
$result = mysql_query($sql) or die(mysql_error());
$res = mysql_fetch_assoc($result);
header("Content-disposition: attachment; filename= " . $res['nom']);
header("Content-type: application/multipart");
readfile($res['chemin_fichier']);
?>