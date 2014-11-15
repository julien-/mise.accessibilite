<?php
include_once ('../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoEtudiant= new DAOEtudiant($db);


if (isset($_GET["inscription"])) {
	if(isset($_POST["cle"]))
	{
		if($_POST["cle"] == "cleprofesseur")
		{
			$professeur = new Professeur(array(
					'nom' => $_POST['nom_minuscules'],
					'prenom' => $_POST['prenom'],
					'mail' => $_POST['email'],
					'login' => $_POST['pseudo'],
					'pass' => md5($_POST['password']),
					'admin' => 1));
			
			$daoEtudiant->add($professeur);
			$id_etu = $daoEtudiant->getLastInsertEtudiant();
				
			$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
			$_SESSION['inscriptionAdd'] = 'true';
		}
		else 
		{
			$_SESSION['inscriptionCleProfInValide'] = 'true';
		}
	}
	else 
	{
		$etudiant = new Etudiant(array(
				'nom' => $_POST['nom_minuscules'],
				'prenom' => $_POST['prenom'],
				'mail' => $_POST['email'],
				'login' => $_POST['pseudo'],
				'pass' => md5($_POST['password']),
				'admin' => 0));
		
		$daoEtudiant->add($etudiant);
		$id_etu = $daoEtudiant->getLastInsertEtudiant();
		 
		$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
		$_SESSION['inscriptionAdd'] = 'true';
	}
}

if(isset($_SESSION['inscriptionCleProfInValide']))
	header('Location: controleur/inscription.php');
else
{
	if ($_SESSION['currentUser']->getAdmin())
		$typeUser = 'admin';
	else
		$typeUser = 'etudiant';

	header('Location: ' . $typeUser . '/controleur/index.php');
}
?>