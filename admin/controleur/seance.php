<?php
$_SESSION['referrer'] = Outils::currentPageURL();
$daoSeance = new DAOSeance($db);
$daoCours = new DAOCours($db);
$listeSeance = $daoSeance->getAllByCours($_SESSION['cours']->getId());
$listeCours = $daoCours->getAllByProf($_SESSION['currentUser']->getId());

include('../vue/seance.php');
?>
