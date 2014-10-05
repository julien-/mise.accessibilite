<script type="text/javascript" src="../js/googleChartToolsBarChart.js"></script>

<?php

include_once('../fonctions.php');
$theme = exists('theme', 'theme', 'id_theme');
$etudiant = exists('e', 'etudiant', 'id_etu');
$cours = exists('c', 'cours', 'id_cours');

if ($theme != false && $etudiant != false && $cours!= false)
{
    $infosEtudiant = getStudent($etudiant);
    echo getFilArianne('selected_cours_perso', array('index.php?section=mes_cours' => 'Mes cours', 'index.php?section=progression_globale&e=-1&c=' . $cours => getCourse($cours),'index.php?section=progression_etudiant&e=' . $etudiant . '&c=' . $cours => $infosEtudiant['prenom'] . ' ' . $infosEtudiant['nom'], 'final' => 'Progression par exercice'));
    ?>
    
    <?php
    $urlJSON = '../chart/get_json_barchart.php?theme=' . $theme . '&user=' . $etudiant;
    ?>
    <script type="text/javascript">
        var optionsBarChart =   {
                            chartArea: {left:"10%",top:50,height:"75%"},
                            width:1200, height:600,
                            legend: {position: 'none'},
                            vAxis: {title: "Exercices"},
                            backgroundColor: { fill:'transparent' },
                            hAxis: {title: "Avancement en %" , maxValue: 100,  minValue: 0}
                        };
        setBarChartOptions('<?php echo $urlJSON ?>', optionsBarChart, 'barChart');
    </script>
    <h1 class="titre_page_school"><?php echo getTheme($theme); ?></h1>
    <h2 class="titre_scolaire">Progression par exercices</h2>
    <ul class="conteneur-onglets">
        <li class="inactif onglet" id="affiche-contenu-1" onclick="Affiche('1');">Progression par th&egrave;mes et exercices</li>
        <li class="inactif onglet" id="affiche-contenu-2" onclick="Affiche('2');">Bonus r&eacute;alis&eacute;s</li>
    </ul>
    <div class="contenu" id="contenu_1">
        <h2 class="titre_scolaire">Progression par exercices</h2>
        <div id="barChart" style="width: auto; height: auto;"></div>
    </div>
    <div class="contenu" id="contenu_2">
        <h2 class="titre_scolaire">Bonus r&eacute;alis&eacute;s dans ce th&egrave;me</h2>
        <?php include('../vues/tableau_bonus.php'); ?>
    </div>

    <script type="text/javascript">
        Affiche(Onglet_afficher);
    </script>
    
    <?php
}
else
    header('Location: index.php?section=introuvable');
?>

