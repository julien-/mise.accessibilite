<?php

session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');
include_once('../modele/getCours.php');

$listeCours = getCours($_SESSION['id']);

if (isset($_GET['section'])) {
    $page = $_GET['section'];
} else {
    $page = 'mes_cours';
}
include_once('../vues/accueil.php');
?>
