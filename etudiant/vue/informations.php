<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="../../js/googleChartToolsLineChart.js"></script>
<?php 
if ($themeAdded)
{
	$alerte = new AlerteSuccess('Thème modifié !');
	$alerte->show();
}
?>
<img src="../../images/Badges.jpg" alt="badges" title="Mes Badges"/>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="panel panel-default" style="height:200px;">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-user"></i> Enseignant
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<?php 
					if($_SESSION['cours']->getProf()->getCode_lien() != NULL)
					{
						$chemin = $daoEtudiant->getCheminByCodeLienAndEtu($_SESSION['cours']->getProf()->getCode_lien(),$_SESSION['cours']->getProf()->getId());
					?>
						<img class="center-block profile-image img-circle" width="75" height="75" src="../../upload/<?php echo $chemin; ?>" alt="avatar"/>&nbsp; 
						<br>
					<?php 
					}
					echo $_SESSION['cours']->getProf()->getNom()."&nbsp;".$_SESSION['cours']->getProf()->getPrenom();
					?>
					<br>
					<?php echo $_SESSION['cours']->getProf()->getMail();?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="panel panel-default" style="height:200px;">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-wrench"></i> Gestion du thème
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<form method="post" name="form_modif_couleur" action="../requete/rq_modification_couleur.php?modifiercouleur">
						<input type="color" name="couleur_fond" value="<?php echo $daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());?>"/>&nbsp;&nbsp;Couleur de fond<br><br>
						<input type="color" name="couleur_texte" value="<?php echo $daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());?>"/>&nbsp;&nbsp;Couleur du texte<br><br>
						<input type="hidden" name="cours" value="<?php echo $_SESSION['cours']->getId();?>" />
						<input type="submit" class="soumettre_couleur btn btn-primary" alt="Modification thème cours" title="Modification thème cours" value="Modification thème cours"/>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-line-chart"></i> Visites du cours sur les 7 derniers jours (nombre de pages visitées)
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<div id="morris-area-chart">
						<script type="text/javascript">
					        var optionsLineChart = {
					        		chartArea: {left:0,top:50,height:"75%", width: "100%"},
					        		backgroundColor: { fill:'transparent' },
					        		vAxis: {minValue: 0},
					        		  viewWindow: {
					        		        min:0
					        		    },
					        		legend: {position: 'none'},
					        };
					        setLineChartOptions('../../chart/get_json_visits.php?etudiant=<?php echo $_SESSION['currentUser']->getId();?>&cours=<?php echo $_SESSION['cours']->getId();?>', optionsLineChart, 'lineChart');
					    </script>
						<div id="lineChart" style="width: 100%; height: 300px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>