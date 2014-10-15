<script type="text/javascript"
	src="../../js/googleChartToolsLineChart.js"></script>
<script type="text/javascript"
	src="../../../js/googleChartToolsPieChart.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="row">
<h1><?php echo utf8_encode($cours->getLibelle());?></h1>
	<div class="col-lg-12 center-content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-comments"></i> 5 derniers sujets
					postés sur le forum
				</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="center-text">Sujet</th>
							<th class="center-text">Cat&eacute;gorie</th>
							<th class="center-text">Auteur</th>
							<th class="center-text">Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ( $liste5DerniersSujets as $sujet ) {
							?>
							<tr>
							<td class="prem_colonne"><?php echo Outils::raccourcirChaine($sujet->getTitre(), 20); ?></td>
							<td class="autre_colonne"><?php echo Outils::raccourcirChaine($sujet->getCategorie()->getTitre(), 40); ?></td>
							<td class="autre_colonne"><?php echo Outils::raccourcirChaine($sujet->getAuteur()->getNom(), 20);?></td>
							<td class="autre_colonne center-text"><?php echo Outils::sqlDateTimeToFr($sujet->getDateDerniereReponse())?></td>
						</tr>
						<?php
						}
						?>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 center-content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-line-chart"></i> Visites sur les 7
					derniers jours
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<div id="morris-area-chart">
						<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						<script type="text/javascript">
        var optionsBarChart = {
        		chartArea: {left:0,top:50,height:"75%", width: "100%"},
        		backgroundColor: { fill:'transparent' },
        		legend: {position: 'none'},
        };
        setBarChartOptions('../../chart/get_json_visits.php?c=<?php echo $cours->getId();?>', optionsBarChart, 'lineChart');
    </script>
						<div id=lineChart style="width: 100%; height: 300px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 center-content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-pie-chart"></i> Progression de la promo
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<script type="text/javascript">				            
                var optionsPieChart =   {
                                            is3D: 'false',
                                            chartArea: {left:"20%",top:50,width:"100%", height:"75%"},
                                            tooltip: {text: 'percentage' },
                                            backgroundColor: { fill:'transparent' },
                                            slices: {
                                                0: { color: '#99FF33' },
                                                1: { color: '#FF6633' }
                                            }
                                        };
                setPieChartOptions('../../chart/cours_global_pie_chart.php?e=-1&c=<?php echo $cours->getId();?>', optionsPieChart, "pieChart");
            </script>
					<div id="pieChart" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>