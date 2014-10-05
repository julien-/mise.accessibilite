<script type="text/javascript" src="../js/googleChartToolsBarChart.js"></script>
<?php
include_once('../fonctions.php');
$theme = exists('theme', 'theme', 'id_theme');
$cours = exists('c', 'cours', 'id_cours');

if ($theme != false && $cours!= false)
{
    echo getFilArianne('selected_cours_perso', array('index.php?section=mes_cours' => 'Mes cours', 'index.php?section=progression_globale&e=-1&c=' . $cours => getCourse($cours), 'final' => 'Progression des étudiants par exercice'));
    $urlJSON = '../chart/get_json_barchart.php?theme=' . $theme . '&user=-1';
    ?>
    <h1 class="titre_page_school"><?php echo getTheme($theme); ?></h1>
    <h2 class="titre_scolaire">Progression de vos &eacute;tudiants par exercices</h2>
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
    <ul class="conteneur-onglets">
        <li class="inactif onglet" id="affiche-contenu-1" onclick="Affiche('1');">Progression par exercices</li>
        <li class="inactif onglet" id="affiche-contenu-2" onclick="Affiche('2');">Bonus r&eacute;alis&eacute;s dans ce th&egrave;me</li>
    </ul>

    <div class="contenu" id="contenu_1">
        <h2 class="titre_scolaire">Progression par exercices</h2>
        <div id="barChart" style="width: auto; height: auto;"></div>
    </div>
    <div class="contenu" id="contenu_2">
        <h2 class="titre_scolaire">Bonus r&eacute;alis&eacute;s</h2>
        <?php $etudiant = -1; include('../vues/tableau_bonus.php'); ?>
    </div>

    <script type="text/javascript">
        Affiche(Onglet_afficher);
    </script>
    <?php
}
else
    header('Location: index.php?section=introuvable');
?>

