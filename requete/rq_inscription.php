<?php
include_once ('../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoEtudiant= new DAOEtudiant($db);
$daoFichiers = new DAOFichier($db);

if (isset($_GET["inscription"])) {
	
	$erreur = false;

	if (isset($_POST['nom_minuscules']) && !empty($_POST['nom_minuscules']))
		$nom = Outils::securite_bdd_string($_POST['nom_minuscules']);
	else
		$erreur = true;
	
	if (isset($_POST['prenom']) && !empty($_POST['prenom']))
		$prenom = Outils::securite_bdd_string($_POST['prenom']);
	else
		$erreur = true;
	
	if (isset($_POST['email']) && !empty($_POST['email']))
		$email = Outils::securite_bdd_string($_POST['email']);
	else
		$erreur = true;
	
	if (isset($_POST['pseudo']) && !empty($_POST['pseudo']))
		$pseudo = Outils::securite_bdd_string($_POST['pseudo']);
	else
		$erreur = true;
	
	if (isset($_POST['password']) && !empty($_POST['password']))
		$password = Outils::securite_bdd_string($_POST['password']);
	else
		$erreur = true;
	
	if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password']))
		$confirm_password = Outils::securite_bdd_string($_POST['confirm_password']);
	else
		$erreur = true;
	
	if($erreur == false)//Si les différents éléments ne sont pas invalides ou vides
	{
		if($daoEtudiant->existsByPseudo($pseudo))//Si le pseudo est deja utilise
		{
			$_SESSION['pseudoUtilise'] = 'true';
			$erreur = true;
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
			}
			elseif(preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file))
			{
				//Nom de fichier invalide
				$_SESSION['nomFichierInvalide'] = 'true';
				$erreur = true;
			}
			elseif( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png'))
			{
				//Type de fichier invalide
				$_SESSION['typeFichierInvalide'] = 'true';
				$erreur = true;
			}
			else
			{
				$chemin = Outils::upload('fichier', '../', Outils::$UPLOAD_FOLDER);
			}	
	
			if($erreur == false)//Si il n'y a pas d'erreur avec les fichiers
			{
				if (isset($_POST['cle']) && !empty($_POST['cle']))
				{
					$cle = Outils::securite_bdd_string($_POST['cle']);
					
					$daoCleEnseignant = new DAOCleEnseignant($db);
					
					if($daoCleEnseignant->correspond(md5($cle)))
					{
						$professeur = new Professeur(array(
								'nom' => $nom,
								'prenom' => $prenom,
								'mail' => $email,
								'login' => $pseudo,
								'pass' => md5($password),
								'code_lien' => $chemin,
								'admin' => 1));
						
						$daoEtudiant->add($professeur);
						$id_etu = $daoEtudiant->getLastInsertEtudiant();
						$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
						$_SESSION['inscriptionAdd'] = 'true';
					}
					else 
					{
						$_SESSION['cleInvalide'] = 'true';
						$erreur = true;
					}
				}
				else 
				{
					$etudiant = new Etudiant(array(
							'nom' => $nom,
							'prenom' => $prenom,
							'mail' => $email,
							'login' => $pseudo,
							'pass' => md5($password),
							'code_lien' => $chemin,
							'admin' => 0));
					
					$daoEtudiant->add($etudiant);
					$id_etu = $daoEtudiant->getLastInsertEtudiant();
					$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
					$_SESSION['inscriptionAdd'] = 'true';
				}		
			}
		}
	}
}

if(!isset($_SESSION['currentUser']) && $erreur == true)
	header('Location: ' . $_SESSION['referrer']);
else
{
	if ($_SESSION['currentUser']->getAdmin())
		$typeUser = 'admin';
	else
		$typeUser = 'etudiant';

	header('Location: ../' . $typeUser . '/controleur/index.php');
}
?>