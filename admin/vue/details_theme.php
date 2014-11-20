<script type="text/javascript"
	src="../../js/googleChartToolsPieChart.js"></script>
<script type="text/javascript"
	src="../../js/googleChartToolsColumnChart.js"></script>
<h1><?php echo $theme->getTitre(); ?></h1>

<div class="row">
	<div class="col-lg-12 center-content">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#general" data-toggle="tab">Informations
					générales <i class="fa"></i>
			</a></li>
			<li><a href="#etudiant" data-toggle="tab">Informations par étudiants
					<i class="fa"></i>
			</a></li>
						<li><a href="#details_exercices" data-toggle="tab">Informations par exercices
					<i class="fa"></i>
			</a></li>
		</ul>
	</div>
</div>
<div class="tab-content">
	<div class="tab-pane active" id="general">
		<div class="row">
			<div class="col-lg-12 center-content">
				</br>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<i class="fa fa-line-chart"></i> Progression globale de vos
							étudiants
						</h3>
					</div>
					<div class="panel-body">
						<div id="morris-area-chart">
							<div id="morris-area-chart">
								<script type="text/javascript"
									src="https://www.google.com/jsapi"></script>
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
                setPieChartOptions('../../chart/get_json_pie_chart.php?t=<?php echo $theme->getId();?>', optionsPieChart, "pieChart");
            </script>
								<div id="pieChart" style="width: 100%; height: 300px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="tab-pane" id="etudiant">
				<br/>
		<table class='interactive-table2 table table-striped table-bordered'>
			<thead>
				<tr>
					<th class="center-text">Etudiant</th>
					<th class="center-text">Progression</th>
					<th class="center-text">Details</th>
				</tr>
			</thead>
			<tbody>
    <?php
				
				foreach ( $listeEtudiants as $etudiant ) {
					$progression = $daoAvancement->getByThemeEtudiant($theme->getId(), $etudiant->getEtudiant()->getId());
					?>
                <tr>
					<td class='autre_colonne vert-align'><a
						href='index.php?section=details_cours_etudiant&c=<?php echo $theme->getCours()->getId(); ?>&e=<?php echo $etudiant->getEtudiant()->getId(); ?>'><?php echo $etudiant->getEtudiant()->getPrenomNom(); ?></a>
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
					<td class="autre_colonne vert-align"><a
						href="index.php?section=details_theme_etudiant&t=<?php echo $theme->getId(); ?>&e=<?php echo $etudiant->getEtudiant()->getId(); ?>"><i class="glyphicon glyphicon-search" title="Cliquez pour plus de d&eacute;tails sur cette personne"></i></a></td>
				</tr>
            <?php
				}
				?>
            </tbody>
		</table>
	</div>
	<div class="tab-pane" id="details_exercices">
				<br/>
		<table class='interactive-table1 table table-striped table-bordered'>
			<thead>
				<tr>
					<th class="center-text">Numéro</th>
					<th class="center-text">Titre</th>
					<th class="center-text">Progression</th>
				</tr>
			</thead>
			<tbody>
    <?php
				
				foreach ( $listeExos as $exos ) {
					$progression = $daoAvancement->getByExercice($exos->getId())
					?>
                <tr>
               		<td class='autre_colonne vert-align'>
               			<?php echo $exos->getNumero(); ?>
					</td>
					<td class='prem_colonne vert-align'><a
						href=''><?php echo $exos->getTitre(); ?></a>
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
