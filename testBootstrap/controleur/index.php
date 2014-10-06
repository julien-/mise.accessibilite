<?php

session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');
include_once ('../lib/autoload.inc.php');
$db = DBFactory::getMysqlConnexionWithMySQLi();
$managerProfesseur = new ProfesseurManager($db);
$managerEtudiant = new EtudiantManager($db);
$managerCours = new CoursManager($db);

$professeur = new Professeur();
$professeur = $managerProfesseur->getByID(17);

$thisCours = $managerCours->getByID(1);
$managerCours->add($thisCours);
$managerProfesseur->add($professeur);
$managerProfesseur->getCours($professeur);

$listeCours = $managerProfesseur->getCours($professeur);
$listeEtudiants = $managerEtudiant->getAll();
$listeCours = $managerCours->getAll();
$_SESSION['currentUser'] = $professeur;

if (isset($_GET['section'])) {
    $page = $_GET['section'];
} else {
    $page = 'mes_cours';
}
include_once('../vues/accueil.php');
?>
