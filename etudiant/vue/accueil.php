<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="../../js/googleChartToolsLineChart.js"></script>
<?php 
if ($avatarAdd)
{
	$alerte = new AlerteSuccess('Avatar ajouté avec succès!');
	$alerte->show();
}
if ($fichierVide)
{
	$alerte = new AlerteDanger('Vous n\'avez pas inséré de fichier');
	$alerte->show();
}
if ($typeFichierInvalide)
{
	$alerte = new AlerteDanger('Type de fichier invalide (valides : .JPG, .JPEG, .BMP, .GIF, .PNG)');
	$alerte->show();
}
if ($nomFichierInvalide)
{
	$alerte = new AlerteDanger('Nom de fichier invalide');
	$alerte->show();
}
?>
<h1>Bienvenue <?php echo $_SESSION['currentUser']->getPrenom() . ' ' . $_SESSION['currentUser']->getNom(); ?></h1>
<div class="row show-grid">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-user"></i>&nbsp;&nbsp;Informations
				</h3>
			</div>
			<div class="panel-body" style="height: 300px;">
				<?php 
					if($_SESSION["currentUser"]->getCode_lien() != NULL)
					{
						$chemin = $daoEtudiant->getCheminByCodeLienAndEtu($_SESSION["currentUser"]->getCode_lien(),$_SESSION["currentUser"]->getId());
				?>
						<img class="center-block profile-image img-circle" width="150" height="150" src="../../upload/<?php echo $chemin; ?>" alt="avatar"/>
				<?php 
					}
					else
					{
				?>
						<a data-toggle="modal" href="modal/remotePage.php" data-target="#ViewAjoutPhoto" class="btn btn-sm btn-primary" title="Ajouter un avatar"><i class="glyphicon glyphicon-user"></i>&nbsp;+</a>
						<!-- Modal ajout Bonus-->  
						<div class="modal fade" id="ViewAjoutPhoto" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
						     <div class="modal-dialog">  
						        <div class="modal-content">
						            <div class="modal-header">
						                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						                <h4 class="modal-title">Ajouter un Avatar à mon profile</h4>
						            </div>
						            <form method="post" enctype="multipart/form-data" action="../requete/rq_accueil.php?addavatar">
						               <div class="modal-body">
						            		<div class="form-group">
						            			<label for="choix" class="col-xs-12 col-sm-12 col-md-6">Choisir un fichier : </label>
									            <span class="btn btn-default btn-file">
												    Télécharger <input type="file" name="fichier">
												</span>
									    	</div> 	              	
							           </div>
							           <div class="modal-footer">
						                	<input type="submit" class="soumettre_avatar btn btn-primary" alt='Ajouter un avatar' title='Ajouter un avatar' value="Ajouter"/>
						                	<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
						    			</div>
							    	</form>
						        </div>
						     </div>
						</div>  
						<br>
				<?php
					}
				?>	
				<br/>
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
								<a href="index.php?section=cours"><?php echo $nbcours; ?></a>
							</td>
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
					<i class="fa fa-line-chart"></i>&nbsp;&nbsp;Visites du site sur les 7 derniers jours (nombre de pages visitées)
				</h3>
			</div>
			<div class="panel-body" style="height: 300px;">
				<div id="morris-area-chart">
					<div id="morris-area-chart">
						<script type="text/javascript">
					        var optionsLineChart = {
					        		chartArea: {left:0, top:20, height:"80%", width: "100%"},
					        		backgroundColor: { fill:'transparent' },
					        		vAxis: {minValue: 0},
					        		  viewWindow: {
					        		        min:0
					        		    },
					        		legend: {position: 'none'},
					        };
					        setLineChartOptions('../../chart/get_json_visits.php?etudiant=<?php echo $_SESSION['currentUser']->getId();?>', optionsLineChart, 'lineChart');
					    </script>
						<div id=lineChart style="width: 100%; height: 250px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row show-grid">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-book"></i>&nbsp;&nbsp;Mes Cours
				</h3>
			</div>
			<div class="panel-body">
				<a class="btn btn-primary" href="index.php?section=inscription_cours">S'inscrire à un cours</a>
				<br/>
				<br/>
				<?php 
				if($nbcours != 0)
				{
				?>
				<table class="table table-striped table-bordered">
				    <thead>
				        <tr>
				            <th class="col-xs-3 col-sm-3 center-text">Cours</th>
				            <th class="col-xs-3 col-sm-3 center-text">Enseignant</th>
				            <th class="col-xs-6 col-sm-6 center-text">Progression</th>
				        </tr>
				    </thead>
				    <tbody>
				    	<?php
					    foreach ($listeCours as $cours)
					    {
					    ?>
				        <tr>
				            <!--Titre du cours-->
				            <td class="col-xs-3 col-sm-3">
				                <a href="index.php?section=evolution&id_cours=<?php echo $cours->getCours()->getId();?>">
				                	<?php echo $cours->getCours()->getLibelle(); ?>
				                </a>
				            </td>
				            <!--Nom du professeur-->
				            <td class="col-xs-3 col-sm-3">
				                <?php                	
				                    echo $cours->getCours()->getProf()->getNom() . ' ' . $cours->getCours()->getProf()->getPrenom(); 
				                ?>
				            </td> 
				            <!--Avancement-->
				            <td class="col-xs-6 col-sm-6">
				                 <?php
				                    $progression = $daoAvancement->getByCoursEtudiant($cours->getCours()->getId(), $_SESSION['currentUser']->getId());
				                    if ($progression <= 25)
				                        $color = '#FF6633';
				                    else if ($progression > 25 && $progression <= 50)
				                        $color = '#FFCC33';
				                    else
				                        $color = '#99FF33';
				                 ?>  
				                 
				                 <div class="progress progress-striped progress-borders">
									<div class="progress-bar progress-bar-primary vert-align" style="color: black; background-color: <?php echo Outils::colorChart($progression); ?>; width: <?php echo $progression; ?>%;">
				                    	<?php echo $progression; ?> %
				                    </div>
								</div>
				            </td>
				        </tr>
				        <?php } ?>
				    </tbody>
				</table>
				<?php 
				}
				?>
			</div>
		</div>
	</div>
</div>

