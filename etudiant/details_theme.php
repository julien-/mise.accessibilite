<script type="text/javascript" src="../js/googleChartToolsBarChart.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php
include_once('../fonctions.php');
if (hasExercices($id_cours))
{
?>

<?php
$consignes = "  
                Vous trouverez sur cette page un diagramme en barres représentant votre évolution dans les exercices du thème choisi

    ";

$etudiant = $_SESSION['id'];
$theme = exists('theme', 'theme', 'id_theme');
$cours = exists('id_cours', 'cours', 'id_cours');
if ($theme != false && $cours != false)
{
    echo getFilArianne('selected_cours_perso', array('index.php?section=mes_cours' => 'Mes cours', 'index.php?section=evolution&id_cours=' . $id_cours => getCourse($id_cours), 'index.php?section=ma_progression&id_cours=' . $cours => 'Ma progression', 'final' => getTheme($theme)));
    include_once('../sql/connexion_mysql.php');
    $urlJSON = '../chart/get_json_barchart.php?theme=' . $theme . '&user=' . $etudiant;
    ?>
<h1 class="titre_page_school_no_space"><?php echo getTheme($theme); ?></h1>
<h2 class="titre_scolaire">Votre progression par exercice</h2>
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
        <div id="barChart" style="width: auto; height: auto;"></div>
        <h2 class="titre_scolaire">Mes bonus</h2>
    <?php
    include_once('../vues/tableau_bonus.php');
}
else
    header('Location: index.php?section=introuvable');
}
else
{
    ?>
    <p class="oldschool">Aucun exercice pour ce cours</p>
    <?php
}
?>

