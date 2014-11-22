<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	
<div class="row">
	<div class="col-lg-12 center-content">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#global" data-toggle="tab">Progression globale <i class="fa"></i></a>
			</li>
			<li>
				<a href="#theme" data-toggle="tab">Progression par thème <i class="fa"></i></a>
			</li>
			<!--<li>
				<a href="#seance" data-toggle="tab">Progression par séance <i class="fa"></i></a>
			</li>-->
			<li>
				<a href="#badge" data-toggle="tab">Badges débloqués <i class="fa"></i></a>
			</li>
		</ul>
	</div>
</div>
<div class="tab-content">
	<div class="tab-pane active" id="global">
		<br><br>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-align-left"></i>&nbsp;&nbsp;Progression globale
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<?php include('graphiques_avancement_global.php'); ?>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-line-chart"></i>&nbsp;&nbsp;Progression par séance
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
						<?php include('graphiques_avancement_seance.php'); ?>					
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="theme">
		<br><br>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-pie-chart"></i>&nbsp;&nbsp;Progression par thème
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<?php include('graphiques_avancement_theme.php'); ?>
				</div>
			</div>
		</div>
	</div>
	<!--<div class="tab-pane" id="seance">
		<br><br>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-leaf"></i>&nbsp;&nbsp;Progression par séance
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
						<?php //include('graphiques_avancement_seance.php'); ?>					
				</div>
			</div>
		</div>
	</div>-->
	<div class="tab-pane" id="badge">
		<br><br>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-leaf"></i>&nbsp;&nbsp;Badges débloqués
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<?php 
					$minimum_un_objectif = false;
					foreach ($listeAssignationsObjectifs as $assignation)
					{
						if ($assignation->getPourcentage() >= 100)
						{
							$objectif = str_replace(' ', '_', $assignation->getObjectif()->getObjectif()); 
							$objectif = stripAccents($objectif);
					?>
						
							<div class="col-xs-4 col-sm-2 text-center">
								<img src="<?php echo '../../images/Badges/' . $objectif . '.png'; ?>" alt="<?php echo $assignation->getObjectif()->getObjectif(); ?>" title="<?php echo $assignation->getObjectif()->getDescription(); ?>" />
								<br>
								<span class="bold"><?php echo $assignation->getObjectif()->getObjectif(); ?></span>
							</div>
					<?php 
							$minimum_un_objectif= true;
						}
					}
					if(!$minimum_un_objectif)
					{
					?>
						<span>Aucun badge n'a encore été obtenu, voir la liste des badges dans le menu Mes Badges</span>
					<?php 
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>













