<?php 
include_once('../../lib/autoload.inc.php');
if (isset($_POST['pseudo']))
	$pseudo = $_POST['pseudo'];
else
	$pseudo = "";

if (isset($_POST['mdp']))
	$mdp = $_POST['mdp'];
else
	$mdp = "";

$errorList = array();
if (isset($_POST['submit']))
{
	$daoEtudiant = new DAOEtudiant($db);
	
	if (!$daoEtudiant->existsByPseudoAndPassword($pseudo, $mdp))
	{
		$errorList[] = "Utilisateur inconnu";
	}
	
	if (sizeof($errorList) > 0)
		include_once('../vue/connexion.php');
	else 
	{
		$etudiant = $daoEtudiant->getByPseudo($pseudo);
		$_SESSION['currentUser'] = $daoEtudiant->getByID($etudiant->getId());
		?>
		<script language="Javascript">
			document.location.replace("index.php?");
		</script>
		<?php
	}
}
else 
	include_once('../vue/connexion.php');
?>