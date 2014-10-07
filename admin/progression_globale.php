<script type="text/javascript" src="../../../js/googleChartToolsBarChart.js"></script>
<?php
$etudiant = -1;
$cours = exists('c', 'cours', 'id_cours');
if ($cours != false)
{
    $titreCours = getCourse($cours);
    $exercice = -1;
    echo getFilArianne('selected_cours_perso', array('index.php?section=mes_cours' => 'Mes cours', 'final' => $titreCours));
    ?>
    <h1 class="titre_page_school"><?php echo $titreCours; ?></h1>
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
        setBarChartOptions('../../chart/get_json_barchart_etudiant.php?e=<?php echo $etudiant ?>&c=<?php echo $cours ?>', optionsBarChart, 'barChart');
    </script>
    <div id="barChart" style="width: auto; height: auto;"></div>
    
    <ul class="nav nav-tabs">
        <li class="<?php if (!isset($_GET['r'])) echo "active";?>"><a href="#progression" data-toggle="tab">Progression par th&egrave;mes et exercices</a></li>
        <li class="<?php if (isset($_GET['r'])) echo "active";?>"><a href="#bonus" data-toggle="tab">Bonus r&eacute;alis&eacute;s dans ce cours</a></li>
    	<li class="<?php if (isset($_GET['r'])) echo "active";?>"><a href="#inscrits" data-toggle="tab">Liste des inscrits</a></li>
    </ul>

   	<div class="tab-content">
    <div class="tab-pane active" id="progression">
        <h2 class="titre_scolaire">Progression par th&egrave;mes et exercices</h2>
        <?php 
            $lienDetails = "index.php?section=progression_globale_exercices&e=-1&c=" . $cours ."&theme="; 
            include('../../vues/liste_themes_avec_graph.php'); 
            $theme = null;
        ?>
    </div>
    <div class="tab-pane" id="bonus">
        <h2 class="titre_scolaire">Bonus r&eacute;alis&eacute;s dans ce cours</h2>
        <?php $etudiant = -1; include('../../vues/tableau_bonus.php'); ?>
    </div>
    <div class="tab-pane" id="inscrits">
        <h2 class="titre_scolaire">Liste des inscrits</h2>
        <?php include('../../vues/liste_inscrits.php'); ?>
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