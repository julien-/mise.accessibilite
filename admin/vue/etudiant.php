<script type="text/javascript"
	src="../../js/googleChartToolsLineChart.js"></script>

<h1><?php echo $etudiant->getPrenom() . ' ' . $etudiant->getNom(); ?></h1>
<div class="row show-grid">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-user"></i> Informations sur l'&eacute;tudiant
				</h3>
			</div>
			<div class="panel-body">
				<table
					class="table table-condensed table-responsive table-user-information">
					<tbody>
						<tr>
							<td>Adresse mail</td>
							<td><a href="mailto:<?php echo $etudiant->getMail(); ?>"
								id="mail">
        	<?php echo $etudiant->getMail(); ?>
        </a></td>
						</tr>
						<tr>
							<td>Cours suivis</td>
							<td><span id="nbcours">
        	<?php echo $daoInscription->countByEtudiantProf($idEtudiant, $_SESSION['currentUser']->getId()); ?>
        </span></td>
						</tr>
						<tr>
							<td>Score total</td>
							<td><span class="bold">
        	<?php  echo $score; ?>
        </span></td>
						</tr>
						<tr>
							<td>Sujets</td>
							<td><span class="bold">
        	<?php  echo $nbSujets; ?>
        </span></td>
						
						<tr>
							<td>Bonus</td>
							<td><span class="bold">
        	<?php  echo $bonus; ?>
        </span></td></tbody>
				</table>
			</div>
	
					
						</div>

	</div>
	<div class="col-md-8">
	<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-line-chart"></i> Visites du site sur les 7
					derniers jours (tous cours confondus)
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
        		vAxis: {minValue: 0},
        		  viewWindow: {
        		        min:0
        		    },
        		legend: {position: 'none'},
        };
        setBarChartOptions('../../chart/get_json_visits.php?etudiant=<?php echo $_GET['e']; ?>', optionsBarChart, 'lineChart');
    </script>
						<div id=lineChart style="width: 100%; height: 300px;"></div>
					</div>
				</div>
			</div>
		</div>
		</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="fa fa-book"></i> Cours suivis
		</h3>
	</div>
	<div class="panel-body">
		<table class='table table-striped table-bordered'>
			<thead>
				<tr>
					<th class="center-text">Cours</th>
					<th class="center-text">Progression</th>
					<th class="center-text">D&eacute;tails pour ce cours</th>
				</tr>
			</thead>
			<tbody>
    <?php
				
				foreach ( $listeInscription as $inscription ) {
					$progression = $daoAvancement->getByCoursEtudiant ( $inscription->getCours ()->getId (), $idEtudiant );
					?>
                <tr>
					<td class='autre_colonne vert-align'><a
						href='index.php?section=details_cours&c=<?php echo $inscription->getCours()->getId(); ?>'><?php echo $inscription->getCours()->getLibelle() ?></a>
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
						href='index.php?section=details_cours_etudiant&e=<?php echo $inscription->getEtudiant()->getId(); ?>&c=<?php echo $inscription->getCours()->getId(); ?>'>
							<i class="glyphicon glyphicon-search"></i>
					</a></td>
				</tr>
            <?php
				}
				?>
            </tbody>
		</table>
	</div>
</div>

