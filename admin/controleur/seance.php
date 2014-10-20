<?php
$_SESSION['referrer'] = current_page_url();
$daoSeance = new DAOSeance($db);
$daoCours = new DAOCours($db);
$listeSeance = $daoSeance->getAll();
$listeCours = $daoCours->getAllByProf($_SESSION['currentUser']->getId());

include('../vue/seance.php');
?>
