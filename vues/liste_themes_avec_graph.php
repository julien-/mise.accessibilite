<script type="text/javascript" src="../../../js/googleChartToolsPieChart.js"></script>
<table id="chemin">
<?php
$daoTheme = new DAOTheme($db);
$listeTheme = $daoTheme->getAllByCours($_GET['c']);

foreach($listeTheme as $theme) // pour chaque th�me on va chercher les exos
{
    $urlJSON = '../../chart/get_json_pie_chart.php?cours=' . $theme->getCours()->getId() . '&theme=' . $theme->getId() . '&user=' . $etudiant;
?>
    <tr style="background-color:#f54f4f;">
        <td>
            <h1 class="titre_scolaire"> <?php echo $theme->getTitre(); ?></h1>
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
                setPieChartOptions('<?php echo $urlJSON ?>', optionsPieChart, <?php echo $theme->getId() ?>);
            </script>
            <div id="<?php echo $theme->getId(); ?>" style="width: 500px; height: auto;"></div>
        </td>
    </tr>
    <tr>
        <td>
            <a href="<?php echo $lienDetails.$theme->getCours()->getId(); ?>">Details</a>
        </td>
    </tr>
<?php
}

?>
</table>