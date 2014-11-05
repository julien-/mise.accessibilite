<h1><?php echo $cours->getLibelle(); ?></h1>

<?php 
foreach($listeThemes as $theme)
{
?>
<div class="row">
	<div class="col-lg-12 center-content">
		<div class="panel panel-default" id="T<?php echo $theme->getId(); ?>">
			<div class="panel-heading header-theme" data-modif-theme-id="<?php echo $theme->getId(); ?>">
				<input type="text" id="theme-<?php echo $theme->getId(); ?>" class="base-hidden form-control hidden input-theme" value="<?php echo $theme->getTitre(); ?>" data-input-theme-id="<?php echo $theme->getId(); ?>"/>
				<p class="center-text">
					<a id="edit-valid-theme-<?php echo $theme->getId(); ?>" class="hidden base-hidden validate-icon-theme" data-modif-theme-id="<?php echo $theme->getId(); ?>">
						<br/><i style="font-size: 50px;" class="glyphicon glyphicon-ok-circle" title="Valider"></i>
					</a>
					<a id="edit-abort-theme-<?php echo $theme->getId(); ?>" class="hidden base-hidden abort-icon-theme">
						<i style="font-size: 50px;" class="glyphicon glyphicon-remove-circle" title="Annuler"></i>
					</a>
				</p>
				<a class="base titre" id="titre-theme-<?php echo $theme->getId(); ?>" data-modif-theme-id="<?php echo $theme->getId(); ?>" data-toggle="collapse" data-target="#bloc-<?php echo $theme->getId(); ?>">
					<?php echo $theme->getTitre(); ?>
				</a>
				<a id="edit-icon-theme-<?php echo $theme->getId(); ?>" class="hidden-base edit-icon-theme hidden" data-modif-theme-id="<?php echo $theme->getId(); ?>">
					<i style="font-size: 15px;" class="glyphicon glyphicon-pencil" title="Modifier le titre de ce thème"></i>
				</a>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">

						<?php 
						$listeExos = $daoExercice->getByAllByTheme($theme->getId());
						foreach($listeExos as $exos)
						{
							$listeFichiers = $daoFichiers->getAllByExercice($exos->getId());
						?>
						
					<tr>
						<td>
							<div class="header-exo" id="E<?php echo $exos->getId();?>" data-modif-exo-id="<?php echo $exos->getId(); ?>">
								<input type="text" id="exo-<?php echo $exos->getId(); ?>" class="base-hidden form-control hidden input-exo" value="<?php echo $exos->getTitre(); ?>" data-input-exo-id="<?php echo $exos->getId(); ?>"/>
								<p class="center-text">
									<a id="edit-valid-exo-<?php echo $exos->getId(); ?>" class="hidden base-hidden validate-icon-exo" data-modif-exo-id="<?php echo $exos->getId(); ?>">
										<br/><i style="font-size: 50px;" class="glyphicon glyphicon-ok-circle" title="Valider"></i>
									</a>
									<a id="edit-abort-exo-<?php echo $exos->getId(); ?>" class="hidden base-hidden abort-icon-exo">
										<i style="font-size: 50px;" class="glyphicon glyphicon-remove-circle" title="Annuler"></i>
									</a>
								</p>
								<a class="base titre" id="titre-exo-<?php echo $exos->getId(); ?>" data-modif-exo-id="<?php echo $exos->getId(); ?>" data-toggle="collapse" data-target="#bloc-<?php echo $exos->getId(); ?>">
									<?php echo $exos->getTitre(); ?>
								</a>
								<a id="edit-icon-exo-<?php echo $exos->getId(); ?>" class="hidden-base edit-icon-exo hidden" data-modif-exo-id="<?php echo $exos->getId(); ?>">
									<i style="font-size: 15px;" class="glyphicon glyphicon-pencil" title="Modifier le titre de cet exercice"></i>
								</a>
							</div>
							 
							<div id="bloc-<?php echo $exos->getId(); ?>" class="collapse">
							<hr>
									<table style="background-color: #F0F0F0 ; width: 100%;" >
									<?php 
									foreach($listeFichiers as $fichier)
									{
									?>
										<ul>
											<li>
												<a href="../../controleur/download.php?f=<?php echo $fichier->getCodeLien();?>"><?php echo $fichier->getNom();?></a> 
											</li>
										<?php echo $fichier->getCommentaire();?>
										</ul>
									<?php 
									}
									?>
									</table>
							</div>
					</tr>
						</td>
						<?php 
						}
						?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php 
}
?>