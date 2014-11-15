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
include_once('vue/inscription.php');
?>
