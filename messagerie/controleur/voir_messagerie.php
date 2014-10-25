<?php 
if(isset($_GET['id_message']) && !empty($_GET['id_message']))
{
	$daoMessagerie = new DAOMessagerie($db);
	$daoEtudiant = new DAOEtudiant($db);
	
	$message = $daoMessagerie->getById($_GET['id_message']);
	
	if($message->getLu() == 0)
		$daoMessagerie->updateLuById($message->getId());
	
	include_once('../../messagerie/vue/voir_messagerie.php');
}
else 
	echo "Page introuvable";
?>