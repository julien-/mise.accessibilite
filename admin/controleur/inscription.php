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
	$daoEtudiant = new DAOEtudiant($db);
	
	if (!$daoEtudiant->existsByPseudo($pseudo))
	{
		$errorList[] = "Ce pseudo (<strong>" . $pseudo . "</strong>) existe déjà";
	}
}
include_once('../vue/inscription.php');
?>