<?php
include("../fonctions.php");

    $nbPokemonLigne = 0;
    $sql = "SELECT id_exo FROM exercice";
    $reqExos = mysql_query($sql) or die(mysql_error());
    if (isset($_GET['e']))
    {
        $etudiant = $_GET['e'];
        $sql = "SELECT * FROM etudiant WHERE id_etu = " . $_GET['e'];
        $reqVerifEtudiant = mysql_query($sql) or die (mysql_error());
        if (mysql_num_rows($reqVerifEtudiant) == 0)
            echo '<p class="oldschool">Etudiant inconnu</p>';
        else
        {
            $etudiant = $_GET['e'];
            echo '<h1 class="titre_page_school">Profil de l\'étudiant ' . $_GET['e'] . '</h1>';
            echo '<h2 class="titre_scolaire">Sa progression globale</h2>';
            include('../chart/creer_bar_chart_etudiant.php');
            echo '<h2 class="titre_scolaire">Ses Pokémons</h2>';
            include('../vues/tableau_pokemons.php');
        ?>
            <h2 class="titre_scolaire">Ses bonus</h2>
            <?php include('../vues/tableau_bonus_etudiant.php'); ?>
        <?php
        }
    }


    
    

