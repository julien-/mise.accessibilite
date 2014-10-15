<?php 

if (isset($_POST['cle']))
	$cle = $_POST['cle'];
else
	$cle = "";

if (isset($_POST['nom']))
	$nom = $_POST['nom'];
else
	$nom = "";

if (isset($_POST['prenom']))
	$prenom = $_POST['prenom'];
else
	$prenom = "";

if (isset($_POST['mail']))
	$mail = $_POST['mail'];
else
	$mail = "";

if (isset($_POST['pseudo']))
	$pseudo = $_POST['pseudo'];
else
	$pseudo = "";

if (isset($_POST['mdp']))
	$mdp = $_POST['mdp'];
else
	$mdp = "";

if (isset($_POST['confirmation']))
	$confirmation = $_POST['confirmation'];
else
	$confirmation = "";

$errorList = array();
if (isset($_POST['submit']))
{
	$daoProfesseur = new DAOProfesseur($db);
	$daoEtudiant = new DAOEtudiant($db);
	
	if ($daoProfesseur->existsByPseudo($pseudo))
	{
		$errorList[] = "Ce pseudo (<strong>" . $pseudo . "</strong>) existe déjà";
	}
	
	if ($daoProfesseur->existsByMail($mail))
	{
		$errorList[] = "Cette adresse e-mail (<strong>" . $mail . "</strong>) existe déjà";
	}	
	
	if (isset($_GET['prof']))
	{
		// VERFIIER LA CLE
	}
	/* Si pas d'erreur on enregistrer le prof dans la base */
	if (sizeof($errorList) == 0)
	{
		if (isset($_GET['prof']))
		{
					$professeur = new Professeur(array(	 
  								'nom' => $nom, 
  								'prenom' => $prenom, 
  								'mail' => $mail, 
  								'login' => $pseudo,
  								'pass' => $mdp,
  								'admin' => 1));
			$daoProfesseur->saveOrUpdate($professeur);
			$_SESSION['currentUser'] = $daoProfesseur->getByPseudo($pseudo);
			$userCreated = $daoProfesseur->getByPseudo($pseudo);
		}
		else 
		{
			$etudiant = new Etudiant(array(
					'nom' => $nom,
					'prenom' => $prenom,
					'mail' => $mail,
					'login' => $pseudo,
					'pass' => $mdp,
					'admin' => 0));
			$daoEtudiant->saveOrUpdate($etudiant);
			$_SESSION['currentUser'] = $daoEtudiant->getByPseudo($pseudo);
			$userCreated = $daoEtudiant->getByPseudo($pseudo);
		}

		$_SESSION['currentUser'] = $userCreated;
		if ($_SESSION['currentUser']->getAdmin())
			$typeUser = 'admin';
		else
			$typeUser = 'etudiant';
		?>
		<script language="Javascript">
			document.location.replace("<?php echo $typeUser?>/controleur/index.php");
		</script>
		<?php
	}
}
include_once('vue/inscription.php');
?>