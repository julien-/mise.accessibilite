<?php 

$_SESSION['referrer'] = Outils::currentPageURL();
$daoMessagerie = new DAOMessagerie($db);

$listeMessages = $daoMessagerie->getAllReceived($_SESSION['currentUser']->getId());

include_once('../../messagerie/vue/reception_messagerie.php');
?>
