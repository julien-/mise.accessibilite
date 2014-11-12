<?php 
include_once('../../lib/autoload.inc.php');
session_start();
$db = DBFactory::getMysqlConnexionStandard();
$daoCours = new DAOCours($db);

$daoCours->save(new Cours(array(
		'libelle' => $_POST['nom-cours'],
		'couleurCalendar' => 'null',
		'prof' => $_SESSION['currentUser']->getId(),
		'cle' => new Cle(array(
				'prof' => $_SESSION['currentUser']->getId(),
				'cle' => $_POST['cle-cours']
				))	
		)
));
$_SESSION['coursAdded'] = 'true';
header('Location: ' . $_SESSION['referrer']);
?>