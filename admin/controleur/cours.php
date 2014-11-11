<?php 
if (isset($_SESSION['cours']))
{
	unset($_SESSION['cours']);
}
$_SESSION['referrer'] = Outils::currentPageURL();
if (isset($_SESSION['coursAdded']))
{
	unset($_SESSION['coursAdded']);
	$coursAdded = true;
}
else 
{
	$coursAdded = false;
}
$daoCours = new DAOCours($db);
$daoInscription = new DAOInscription($db);
$listeCours = $daoCours->getAllByProf($_SESSION['currentUser']->getId());
include_once('../vue/cours.php');
?>