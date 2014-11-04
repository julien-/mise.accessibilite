<?php 
if (isset($_SESSION['cours']))
{
	unset($_SESSION['cours']);
}
$daoCours = new DAOCours($db);
$daoInscription = new DAOInscription($db);
$listeCours = $daoCours->getAllByProf($_SESSION['currentUser']->getId());
include_once('../vue/cours.php');
?>