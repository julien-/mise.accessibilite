<script type="text/javascript" src="../js/googleChartToolsBarChart.js"></script>

<?php

include_once('../sql/connexion_mysql.php');
include_once('../fonctions.php');
$etudiant = exists('e', 'etudiant', 'id_etu');
$cours = exists('c', 'cours', 'id_cours');
if ($etudiant != false && $cours != false)
{
    echo getFilArianne('selected_cours_perso', array('index.php?section=mes_cours' => 'Mes cours', 'index.php?section=progression_globale&e=-1&c=' . $cours => getCourse($cours)));
    $urlJSON = '../chart/get_json_barchart_etudiant.php?e=' . $etudiant;
    $infosEtudiant = getStudent($etudiant);
    ?>
     <h1 class="titre_page_school"><?php echo $infosEtudiant['prenom'] . ' ' . $infosEtudiant['nom']; ?></h1>
     <h2 class="titre_scolaire">Progression sur tous le cours</h2>
    <script type="text/javascript">
        var optionsBarChart =   {
                            title:"",
                            enableInteractivity: false,
                            width:1000, height:100, axisTitlesPosition: 'none',
                            legend: {position: 'none'},
                            chartArea: {left:"20%",top:0,width:500,height:"75%"},
                            vAxis: {title: "Exercices"},
                            backgroundColor: { fill:'transparent' },
                            hAxis: {title: "Avancement en %" , maxValue: 100,  minValue: 0}
                        };
        setBarChartOptions('../chart/get_json_barchart_etudiant.php?e=<?php echo $etudiant ?>&c=<?php echo $cours ?>', optionsBarChart, 'barChart');
    </script>
    <div id="barChart" style="width: auto; height: auto;"></div>
    <?php
    $lienDetails = "index.php?section=progression_etudiant_exercices&e=" . $etudiant . "&c=" . $cours ."&theme=";
    ?>
    <ul class="conteneur-onglets">
        <li class="inactif onglet" id="affiche-contenu-1" onclick="Affiche('1');">Progression par th&egrave;mes et exercices</li>
        <li class="inactif onglet" id="affiche-contenu-2" onclick="Affiche('2');">Bonus r&eacute;alis&eacute;s</li>
    </ul>

    <div class="contenu" id="contenu_1">
        <h2 class="titre_scolaire">Progression par th&egrave;mes et exercices</h2>
        <?php include('../vues/liste_themes_avec_graph.php'); $theme = null;?>
    </div>
    <div class="contenu" id="contenu_2">
        <h2 class="titre_scolaire">Bonus r&eacute;alis&eacute;s</h2>
        <?php include('../vues/tableau_bonus.php'); ?>
    </div>

    <?php
    if (isset($_GET['d']))
        $Onglet_afficher = 2;
    else
        $Onglet_afficher = 1;
    ?>
    <script type="text/javascript">
            Affiche(<?php echo $Onglet_afficher; ?>);
    </script>
    <?php
}
else
    header('Location: index.php?section=introuvable');

?>

