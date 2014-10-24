<script type="text/javascript"
	src="../../js/googleChartToolsLineChart.js"></script>
<script type="text/javascript"
	src="../../../js/googleChartToolsPieChart.js"></script>

<h1><?php echo $titre;?></h1>
<div class="row">
	<div class="col-lg-12 center-content">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#general" data-toggle="tab">Informations
					générales <i class="fa"></i>
			</a></li>
			<li><a href="#theme" data-toggle="tab">Informations par thèmes <i
					class="fa"></i></a></li>
		</ul>
	</div>
</div>
<div class="tab-content">
	<div class="tab-pane active" id="general">
		<div class="row">
			<div class="col-lg-6 center-content">
			<br/>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<i class="fa fa-line-chart"></i> Visites sur les 7 derniers jours
						</h3>
					</div>
					<div class="panel-body">
						<div id="morris-area-chart">
							<div id="morris-area-chart">
								<script type="text/javascript"
									src="https://www.google.com/jsapi"></script>
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
        setBarChartOptions('../../chart/get_json_visits.php?c=<?php echo $cours->getId();?>', optionsBarChart, 'lineChart');
    </script>
								<div id=lineChart style="width: 100%; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 center-content">
			</br>
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
                setPieChartOptions('<?php echo $urlJSONPieChart;?>', optionsPieChart, "pieChart");
            </script>
							<div id="pieChart" style="width: 100%; height: 300px;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	

<?php
if (sizeof ( $liste5DerniersSujets ) > 0) {
	?>
<div class="row">
		<div class="col-lg-12 center-content">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-comments"></i> 5 derniers sujets postés sur le
						forum
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
								<td class="autre_colonne cut-text" style="max-width: 100px;"><?php echo $sujet->getCategorie()->getTitre(); ?></td>
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
<?php
}
?>
<div class="row">
		<div class="col-lg-8 center-content">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-bell fa-fw"></i> Derni&egrave;res
						actualit&eacute;s
					</h3>
				</div>
				<div class="panel-body">
					<div class="list-group">
                            <?php
																												foreach ( $listeNews as $news ) {
																													?>
                                <a href="#" class="list-group-item">
                                    <?php
																													if ($news->getActivite () == 'inscription') {
																														?><i
							class="glyphicon glyphicon-star blue"></i>  <?php
																														echo $news->getEtudiant ()->getPrenom () . ' ' . $news->getEtudiant ()->getNom () . ' s\'est inscrit à ce cours ';
																														?>                                   
                           				 <span
							class="pull-right text-muted small"> <span
								class="badge badge-success pull-right blue-bg"><?php echo Outils::determineDate($news->getDate());?></span>
						</span>
                                   		 <?php
																													} 

																													else if ($news->getActivite () == 'avancement') {
																														?><i
							class="glyphicon glyphicon-circle-arrow-up green"></i>  <?php
																														echo $news->getEtudiant ()->getPrenom () . ' ' . $news->getEtudiant ()->getNom () . ' a mis à jour son avancement ';
																														?>                                   
                           				 <span
							class="pull-right text-muted small"> <span
								class="badge badge-success pull-right green-bg"><?php echo Outils::determineDate($news->getDate());?></span>
						</span>
                                   		 <?php
																													}
																													?>
                                </a>
                         	<?php
																												}
																												?>
                            </div>
				</div>
			</div>
		</div>
		</div>
			</div>
		<div class="tab-pane" id="theme">
			<div class="row">
				<br />
				<table class='table table-striped table-bordered'>
					<thead>
						<tr>
							<th class="center-text">Thème</th>
							<th class="center-text">Progression</th>
						</tr>
					</thead>
					<tbody>
    <?php
				
				foreach ( $listeThemes as $theme ) {
					$progression = $daoAvancement->getByTheme ( $theme->getId () );
					?>
                <tr>
							<td class='autre_colonne vert-align'><a
								href='index.php?section=details_themel&c='><?php echo $theme->getTitre(); ?></a>
							</td>
							<td class="prem_colonne vert-align">


								<div class="progress progress-striped progress-borders"
									style="margin-top: 12px;">
									<div class="progress-bar progress-bar-primary vert-align" 
                                    style="color: black; background-color: <?php echo Outils::colorChart($progression); ?>; width: <?php echo $progression; ?>%;">
                                    	<?php echo $progression; ?> %
                                    </div>
								</div>

							</td>
						</tr>
            <?php
				}
				?>
            </tbody>
				</table>
			</div>
		</div>
	</div>