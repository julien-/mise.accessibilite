<?php
$_SESSION['referrer'] = Outils::currentPageURL(); 
$daoCours = new DAOCours($db);
$daoCategorie = new DAOCategorie($db);


$cours = $daoCours->getByID($_SESSION['cours']->getId());
$listeCategorie = $daoCategorie->getAllByCoursWithStats($_SESSION['cours']->getId());
include_once('../../forum/vue/index_forum.php');
