<?php 
if (isset($_SESSION['inscriptionCleProfInValide']))
{
	unset($_SESSION['inscriptionCleProfInValide']);
	$inscriptionCleProfInValide = true;
}
else
{
	$inscriptionCleProfInValide = false;
}

if (isset($_SESSION['nomFichierInvalide']))
{
	unset($_SESSION['nomFichierInvalide']);
	$nomFichierInvalide = true;
}
else
{
	$nomFichierInvalide = false;
}

if (isset($_SESSION['typeFichierInvalide']))
{
	unset($_SESSION['typeFichierInvalide']);
	$typeFichierInvalide = true;
}
else
{
	$typeFichierInvalide = false;
}
include_once('vue/inscription.php');
?>
