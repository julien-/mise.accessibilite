<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="../../js/googleChartToolsLineChart.js"></script>

<h1>Bienvenue <?php echo $_SESSION['currentUser']->getPrenom() . ' ' . $_SESSION['currentUser']->getNom(); ?></h1>
<div class="row show-grid">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-user"></i> Informations
				</h3>
			</div>
			<div class="panel-body">
				<table class="table table-condensed table-responsive table-user-information">
					<tbody>
						<tr>
							<td>Email</td>
							<td>
								<a href="index.php?section=compte"><?php echo $_SESSION['currentUser']->getMail(); ?></a>
							</td>
						</tr>
						<tr>
							<td>Nombre de messages non lus</td>
							<td>
								<a href="index.php?section=reception_messagerie"><?php echo $nbMessagesNnLu; ?></a>
							</td>
						</tr>
						<tr>
							<td>Cours suivis</td>
							<td>
								<a href="index.php?section=cours"><?php echo $nbCours; ?></a>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-line-chart"></i> Visites du site sur les 7 derniers jours (nombre de pages visitées)
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<div id="morris-area-chart">
						<script type="text/javascript">
					        var optionsBarChart = {
					        		chartArea: {left:0,top:50,height:"75%", width: "100%"},
					        		backgroundColor: { fill:'transparent' },
					        		vAxis: {minValue: 0},
					        		  viewWindow: {
					        		        min:0
					        		    },
					        		legend: {position: 'none'},
					        };
					        setBarChartOptions('../../chart/get_json_visits.php?etudiant=<?php echo $_SESSION['currentUser']->getId();?>', optionsBarChart, 'lineChart');
					    </script>
						<div id=lineChart style="width: 100%; height: 300px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
