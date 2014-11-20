<?php
include_once ('../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoEtudiant= new DAOEtudiant($db);
$daoFichiers = new DAOFichier($db);


if (isset($_GET["inscription"])) {
	if(isset($_POST["cle"]))
	{
		if($_POST["cle"] == "cleprofesseur")
		{
			$tmp_file = $_FILES['fichier']['tmp_name'];
			$name_file = $_FILES['fichier']['name'];
			$type_file = $_FILES['fichier']['type'];
			
			if(!is_uploaded_file($tmp_file))
			{
				//Fichier introuvable
				$chemin = false;
				
				$professeur = new Professeur(array(
						'nom' => $_POST['nom_minuscules'],
						'prenom' => $_POST['prenom'],
						'mail' => $_POST['email'],
						'login' => $_POST['pseudo'],
						'pass' => md5($_POST['password']),
						'code_lien' => $chemin,
						'admin' => 1));
			}
			elseif(preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file))
			{
				//Nom de fichier invalide
				$_SESSION['nomFichierInvalide'] = 'true';
			}
			elseif( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png'))
			{
				//Type de fichier invalide
				$_SESSION['typeFichierInvalide'] = 'true';
			}
			else
			{
				$chemin = Outils::upload('fichier', '../', Outils::$UPLOAD_FOLDER);
				
				$professeur = new Professeur(array(
						'nom' => $_POST['nom_minuscules'],
						'prenom' => $_POST['prenom'],
						'mail' => $_POST['email'],
						'login' => $_POST['pseudo'],
						'pass' => md5($_POST['password']),
						'code_lien' => $chemin,
						'admin' => 1));
			}
			
			if(isset($professeur))
			{
				$daoEtudiant->add($professeur);
				$id_etu = $daoEtudiant->getLastInsertEtudiant();				
				$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
				$_SESSION['inscriptionAdd'] = 'true';
			}
		}
		else 
		{
			$_SESSION['inscriptionCleProfInValide'] = 'true';
		}
	}
	else 
	{
		$tmp_file = $_FILES['fichier']['tmp_name'];
		$name_file = $_FILES['fichier']['name'];
		$type_file = $_FILES['fichier']['type'];
		
		if(!is_uploaded_file($tmp_file))
		{
			//Fichier introuvable
			$chemin = false;
			
			$etudiant = new Etudiant(array(
					'nom' => $_POST['nom_minuscules'],
					'prenom' => $_POST['prenom'],
					'mail' => $_POST['email'],
					'login' => $_POST['pseudo'],
					'pass' => md5($_POST['password']),
					'code_lien' => $chemin,
					'admin' => 0));
		}
		elseif(preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file))
		{
			//Nom de fichier invalide
			$_SESSION['nomFichierInvalide'] = 'true';
		}
		elseif( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png'))
		{
			//Type de fichier invalide
			$_SESSION['typeFichierInvalide'] = 'true';
		}
		else
		{
			$chemin = Outils::upload('fichier', '../', Outils::$UPLOAD_FOLDER);
			
			$etudiant = new Etudiant(array(
					'nom' => $_POST['nom_minuscules'],
					'prenom' => $_POST['prenom'],
					'mail' => $_POST['email'],
					'login' => $_POST['pseudo'],
					'pass' => md5($_POST['password']),
					'code_lien' => $chemin,
					'admin' => 0));
		}
		
		if(isset($etudiant))
		{
			$daoEtudiant->add($etudiant);
			$id_etu = $daoEtudiant->getLastInsertEtudiant();
			$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
			$_SESSION['inscriptionAdd'] = 'true';
		}		
	}
}

if(!isset($_SESSION['currentUser']))
	header('Location: ../index.php?section=inscription');
else
{
	if ($_SESSION['currentUser']->getAdmin())
		$typeUser = 'admin';
	else
		$typeUser = 'etudiant';

	header('Location: ../' . $typeUser . '/controleur/index.php');
}
?>