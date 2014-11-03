<?php
$_SESSION['referrer'] = Outils::currentPageURL();
$daoSujet = new DAOSujet($db);
$listeSujets = $daoSujet->getAllByCategorieWithStats($_GET['categorie']);

include_once('../../forum/vue/liste_sujets_forum.php');
?>

    