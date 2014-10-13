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
	
	if ($daoProfesseur->existsByPseudo($pseudo))
	{
		$errorList[] = "Ce pseudo (<strong>" . $pseudo . "</strong>) existe déjà";
	}
	
	if ($daoProfesseur->existsByMail($mail))
	{
		$errorList[] = "Cette adresse e-mail (<strong>" . $mail . "</strong>) existe déjà";
	}	
	
	/* Si pas d'erreur on enregistrer le prof dans la base */
	if (sizeof($errorList) == 0)
	{
		$professeur = new Professeur(array(	 
  								'nom' => $nom, 
  								'prenom' => $prenom, 
  								'mail' => $mail, 
  								'login' => $pseudo,
  								'pass' => $mdp,
  								'admin' => 0));
		$daoProfesseur->saveOrUpdate($professeur);
		$_SESSION['currentUser'] = $daoProfesseur->getByPseudo($pseudo);
		?>
		<script language="Javascript">
			document.location.replace("index.php");
		</script>
		<?php
	}
}
include_once('../vue/inscription.php');
?>