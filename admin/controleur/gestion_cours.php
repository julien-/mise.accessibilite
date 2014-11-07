<?php 
$daoTheme = new DAOTheme($db);
$daoExercice = new DAOExercice($db);
$daoCours = new DAOCours($db);
$daoFichiers = new DAOFichier($db);
$_SESSION ['referrer'] = Outils::currentPageURL();
if (isset($_GET['c']))
	$_SESSION['cours'] = $daoCours->getByID($_GET['c']);

if (isset($_POST['type']))
{
	if ($_POST['type'] == 'edit')
	{
		if (isset($_POST['titre-exo']))
		{	
			$exercice = $daoExercice->getByID($_POST['id-exo']);
			$exercice = $exercice->setTitre($_POST['titre-exo']);
			$daoExercice->update($exercice);
		}
		
		if (isset($_POST['titre-theme']))
		{
			$theme = $daoTheme->getByID($_POST['id-theme']);
			$theme = $theme->setTitre($_POST['titre-theme']);
			$daoTheme->update($theme);
		}
		
		if (isset($_POST['titre-cours']))
		{
			$cours = $daoCours->getByID($_POST['id-cours']);
			$cours = $cours->setLibelle($_POST['titre-cours']);
			$daoCours->update($cours);
			$_SESSION['cours'] = $cours;
		}
	}
	else if ($_POST['type'] == 'delete')
	{
		if (isset($_POST['id-exo']))
		{	
			$daoExercice->delete($_POST['id-exo']);
		}
		
		if (isset($_POST['id-theme']))
		{
			$daoTheme->delete($_POST['id-theme']);
		}
	}
}

$listeThemes = $daoTheme->getAllByCours($_SESSION['cours']->getId());
$cours = $_SESSION['cours'];

include_once('../vue/gestion_cours.php');
?>