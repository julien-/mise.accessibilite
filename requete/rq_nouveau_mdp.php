<?php 
include_once('../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$erreur = false;

if (isset($_GET["nouveau_mdp"]))
{	
	if (isset($_POST['new_password']) && !empty($_POST['new_password']))
		$password = Outils::securite_bdd_string($_POST['new_password']);
	else
		$erreur = true;
	
	if (isset($_POST['confirm_new_password'])  && !empty($_POST['confirm_new_password']))
		$confirm_password = Outils::securite_bdd_string($_POST['confirm_new_password']);
	else
		$erreur = true;
	
	if (isset($_POST['cle'])  && !empty($_POST['cle']))
		$cle = Outils::securite_bdd_string($_POST['cle']);
	else
		$erreur = true;
	
	if($erreur == false)//Si le pass et la confirmation ne sont pas invalides ou vides
	{		
		if ($password == $confirm_password)
		{
			$daoOubliPassword = new DAOOubliPassword($db);
			$daoEtudiant = new DAOEtudiant($db);
			$oubli = $daoOubliPassword->getByCle($cle);
			$_SESSION['currentUser'] = $daoEtudiant->getByID($oubli->getEtudiant()->getId());
			$daoEtudiant->updatePasswordByEtudiant($password, $oubli->getEtudiant()->getId());
		}	
		else
			$erreur = true;
	}
}

if($erreur == true)
	header('Location: ' . $_SESSION['referrer']);
else
{
	if ($_SESSION['currentUser']->getAdmin())
		$typeUser = 'admin';
	else
		$typeUser = 'etudiant';

	header('Location: ../' . $typeUser . '/controleur/index.php');
}

