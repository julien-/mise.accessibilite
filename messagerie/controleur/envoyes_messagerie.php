<?php 
if (isset($_SESSION['messageAdded']))
{
	unset($_SESSION['messageAdded']);
	$messageAdded = true;
}
else
{
	$messageAdded = false;
}

$daoMessagerie = new DAOMessagerie($db);

$listeMessages = $daoMessagerie->getAllSends($_SESSION['currentUser']->getId());

include_once('../../messagerie/vue/envoyes_messagerie.php');
?>