<?php
$id_cours = exists('id_cours', 'cours', 'id_cours');
$_SESSION['referrer'] = Outils::currentPageURL(); 
$daoCours = new DAOCours($db);
$daoCategorie = new DAOCategorie($db);

if ($id_cours == false)
{
    header('Location: index.php?section=introuvable');
}                             
 else 
{
	$cours = $daoCours->getByID($id_cours);
	$listeCategorie = $daoCategorie->getAllByCoursWithStats($id_cours);
	include_once('../../forum/vue/index_forum.php');
}