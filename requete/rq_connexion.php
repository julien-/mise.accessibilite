<?php 
include_once('../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$erreur = false;

if (isset($_GET["connexion"]))
{	
	if (isset($_POST['pseudo_conn']) && !empty($_POST['pseudo_conn']))
		$pseudo = Outils::securite_bdd_string($_POST['pseudo_conn']);
	else
		$erreur = true;
	
	if (isset($_POST['password_conn'])  && !empty($_POST['password_conn']))
		$mdp = Outils::securite_bdd_string($_POST['password_conn']);
	else
		$erreur = true;
	
	if($erreur == false)//Si le login et le mdp ne sont pas invalides ou vides
	{
		$daoEtudiant = new DAOEtudiant($db);
		
		if ($daoEtudiant->existsByPseudoAndPassword($pseudo, $mdp))
		{
			$etudiant = $daoEtudiant->getByPseudo($pseudo);
			$_SESSION['currentUser'] = $daoEtudiant->getByID($etudiant->getId());
			if ($_SESSION['currentUser']->getAdmin())
				$typeUser = 'admin';
			else
				$typeUser = 'etudiant';
		}	
		else
		{
			$_SESSION['utilisateurInconnu'] = 'true';
			$erreur = true;
		}
	}
}

if($erreur == true)
	header('Location: ' . $_SESSION['referrer']);
else 
{
?>
			
	<script language="Javascript">
		document.location.replace("../<?php echo $typeUser?>/controleur/index.php");
	</script>
<?php	
}
?>