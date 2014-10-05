<?php
session_start();
include('../sql/connexion_mysql.php');
include('../fonctions.php');
if ($_SESSION['admin'])
{
    if (isset($_GET['type']) && isset($_GET['id']))
    {
        $type = $_GET['type'];
        $id = $_GET['id'];
        
        if ($type == 'categorie')
        {
            deleteCategorie ($id);
        }
        else if ($type == 'sujet')
        {
            deleteSujet ($id);
        }
        else if ($type == 'post')
        {
            deletePost ($id);        
        }
    }
    if (isset($_GET['id_sujet_a_lire']))
    {
        $sujet = '&id_sujet_a_lire='.$_GET['id_sujet_a_lire'];
    }
    else
        $sujet = "";
    
    if (isset($_GET['categorie']))
    {
        $categorie = '&categorie='.$_GET['categorie'];
    }
    else
        $categorie = "";
    
    header("Location: ../etudiant/index.php?deleted=true&section=" . $_GET['section'] . '&id_cours=' . $_GET['cours'] . $sujet . $categorie);
}

