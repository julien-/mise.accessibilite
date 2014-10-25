<?php 
$daoMessagerie = new DAOMessagerie($db);

$listeMessages = $daoMessagerie->getAllSends($_SESSION['currentUser']->getId());

include_once('../../messagerie/vue/envoyes_messagerie.php');
?>