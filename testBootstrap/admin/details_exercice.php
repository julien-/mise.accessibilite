<script type="text/javascript" src="../js/googleChartToolsBarChart.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php
include_once('../sql/connexion_mysql.php');
include_once('../fonctions.php');
$etudiant = -1;
$cours = exists('c', 'cours', 'id_cours');
$exercice = exists('ex', 'exercice', 'id_exo');
if ($cours != false && $exercice != false)
{
    echo getFilArianne(array('index.php?section=mes_cours' => 'Mes cours'));
    ?>
    <h1 class="titre_page_school"><?php echo getExercice($exercice); ?></h1>
    <h2 class="titre_scolaire">Progression sur tout le cours</h2>
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
        setBarChartOptions('../chart/get_json_barchart_etudiant.php?ex=<?php echo $exercice ?>&c=<?php echo $cours ?>', optionsBarChart, 'barChart');
    </script>
    <div id="barChart" style="width: auto; height: auto;"></div>
    <ul class="conteneur-onglets">
        <li class="inactif onglet" id="affiche-contenu-1" onclick="Affiche('1');">Progression par étudiant</li>
        <li class="inactif onglet" id="affiche-contenu-2" onclick="Affiche('2');">Gestion des fichiers</li>
    </ul>

    <div class="contenu" id="contenu_1">
        <h2 class="titre_scolaire">Progression par étudiant</h2>
        <?php 
            include('../vues/liste_inscrits.php'); 
        ?>
    </div>
    <div class="contenu" id="contenu_2">
        <h2 class="titre_scolaire">Gestion des fichiers</h2>
        <?php include('fichiers_exo.php'); ?>
    </div>

    <script type="text/javascript">
        Affiche(Onglet_afficher);
    </script>
    <?php
    
}
else
    header('Location: index.php?section=introuvable');