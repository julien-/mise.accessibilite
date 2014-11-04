<script type="text/javascript" src="../../js/googleChartToolsPieChart.js"></script>
<?php
$daoTheme = new DAOTheme($db);
$listeTheme = $daoTheme->getAllByCours($_SESSION['cours']->getId());

foreach($listeTheme as $theme) // pour chaque th�me on va chercher les exos
{
    $urlJSON = '../../chart/get_json_pie_chart.php?c=' . $_SESSION['cours']->getId() . '&t=' . $theme->getId() . '&e=' . $_SESSION['currentUser']->getId();
?>
	<div class="col-md-4">
        <h2><?php echo $theme->getTitre(); ?></h2>
        <script type="text/javascript">
                var optionsPieChart =   {
                                            is3D: 'false',
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
        <div id="<?php echo $theme->getId(); ?>"></div>
	    <a href="#">Details</a>
    </div>
<?php
}
?>