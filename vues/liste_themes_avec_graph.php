<script type="text/javascript" src="../js/googleChartToolsPieChart.js"></script>
<table id="chemin">
<?php
$sql = 'SELECT * 
        FROM theme
        WHERE id_cours = ' . $cours;
        
$req_theme = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

while($donnees = mysql_fetch_array($req_theme))  // pour chaque th�me on va chercher les exos
{
    $theme = $donnees['id_theme'];
    $nomTheme = $donnees['titre_theme'];
    $urlJSON = '../chart/get_json_pie_chart.php?cours=' . $cours . '&theme=' . $theme . '&user=' . $etudiant;
?>
    <tr style="background-color:#f54f4f;">
        <td>
            <h1 class="titre_scolaire"> <?php echo $nomTheme; ?></h1>
        </td>
    </tr>
    <tr>
        <td>
            <script type="text/javascript">
                var optionsPieChart =   {
                                            is3D: 'false',
                                            width: 500,
                                            height: 300,
                                            tooltip: {text: 'percentage' },
                                            backgroundColor: { fill:'transparent' },
                                            slices: {
                                                0: { color: '#99FF33' },
                                                1: { color: '#FF6633' }
                                            }
                                        };
                setPieChartOptions('<?php echo $urlJSON ?>', optionsPieChart, <?php echo $theme ?>);
            </script>
            <div id="<?php echo $theme; ?>" style="width: 500px; height: auto;"></div>
        </td>
    </tr>
    <tr>
        <td>
            <a href="<?php echo $lienDetails.$theme; ?>">Details</a>
        </td>
    </tr>
<?php
}

?>
</table>