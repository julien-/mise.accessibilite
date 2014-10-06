<?php

session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');
include_once('../modele/getCours.php');
include_once ('../lib/autoload.inc.php');
$db = DBFactory::getMysqlConnexionWithMySQLi();
$managerProfesseur = new ProfesseurManager($db);

$professeur = new Professeur();
$professeur = $managerProfesseur->getByID(17);

$managerProfesseur->add($professeur);
$managerProfesseur->getCours($professeur);

$listeCours = $managerProfesseur->getCours($professeur);
$_SESSION['currentUser'] = $professeur;

if (isset($_GET['section'])) {
    $page = $_GET['section'];
} else {
    $page = 'mes_cours';
}
include_once('../vues/accueil.php');
?>
