<?php
$id_cours = exists('id_cours', 'cours', 'id_cours');
$_SESSION['referrer'] = current_page_url(); 
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
    echo getFilArianne('selected_cours_perso', array('index.php?section=mes_cours' => 'Mes cours', 'index.php?section=evolution&id_cours=' . $id_cours => getCourse($id_cours), 'final' => 'Index du forum'));
	include_once('../../forum/vue/index_forum.php');
}