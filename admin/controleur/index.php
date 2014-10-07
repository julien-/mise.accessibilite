<?php
session_start();
include_once('../../lib/autoload.inc.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoProfesseur = new DAOProfesseur($db);

$professeur = $daoProfesseur->getByID($_SESSION['id']);

$_SESSION['currentUser'] = $professeur; 
if (isset($_GET['section'])) {
	$page = $_GET['section'];
} else {
	$page = 'mes_cours';
}
include_once ('../vue/index.php');