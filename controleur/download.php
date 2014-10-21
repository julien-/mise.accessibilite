<?php

include_once('../sql/connexion_mysql.php');
include_once('../lib/autoload.inc.php');
$daoFichier = new DAOFichier(null);
$fichier = $daoFichier->getByCodeLien($_GET['f']);
$fichier->setTelechargements($fichier->getTelechargements()+1);
$daoFichier->update($fichier);
header("Content-disposition: attachment; filename=" . $fichier->getNom());
header("Content-type: application/multipart");
readfile('../upload/'.$fichier->getChemin());
?>