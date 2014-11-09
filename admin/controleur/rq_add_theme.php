<?php 
include_once('../../lib/autoload.inc.php');
session_start();
$db = DBFactory::getMysqlConnexionStandard();
$daoTheme = new DAOTheme($db);

$daoTheme->save(new Theme(array(
		'titre' => $_POST['titre_theme'],
		'cours' => $_POST['id-cours']
)));

header('Location: ' . $_SESSION['referrer']);
?>