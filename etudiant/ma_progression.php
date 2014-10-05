<script type="text/javascript" src="../js/googleChartToolsBarChart.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php
include_once('../sql/connexion_mysql.php');
include_once('../fonctions.php');
if ($id_cours != false)
{
    if (hasExercices($id_cours))
    {
        $cours = $id_cours;
        $consignes = "  
                        <br/>
                        Chaque <b>diagramme</b> représente votre <b>progression globale</b> dans le thème correspondant. La <b>partie bleue</b> correpond à ce qui a été <b>fait</b>.
                        <br/>
                        <br/>                    
                        Vous pouvez <b>cliquer</b> sur le lien en dessous de chaque diagramme pour avoir une <b>vue détaillée de votre progression</b> dans le thème.
            ";
        $etudiant = $_SESSION['id'];
        $lienDetails = "index.php?section=details_theme&id_cours=" . $cours . "&theme=";
        ?>
        <h1 class="titre_page_school">Ma progression</h1>
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
            setBarChartOptions('../chart/get_json_barchart_etudiant.php?e=<?php echo $etudiant ?>&c=<?php echo $cours ?>', optionsBarChart, 'barChart');
        </script>
        <div id="barChart" style="width: auto; height: auto;"></div>
        <h2 class="titre_scolaire">Progression par th&egrave;mes et exercices</h2>
        <?php   
        
        include('../vues/liste_themes_avec_graph.php');
    }
    else
    {
        ?>
        <p class="oldschool">Aucun exercice pour ce cours</p>
        <?php
    }
}
else
    header('Location: index.php?section=introuvable');
?>