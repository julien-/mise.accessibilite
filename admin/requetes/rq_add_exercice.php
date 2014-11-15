<?php 
include_once('../../lib/autoload.inc.php');
session_start();
$db = DBFactory::getMysqlConnexionStandard();
$daoExercice = new DAOExercice($db);

$daoExercice->save(new Exercice(array(
		'titre' => $_POST['titre_exo'],
		'theme' => $_POST['id_theme']
)));
$_SESSION['exerciceAdded'] = 'true';
header('Location: ' . $_SESSION['referrer']);
?>