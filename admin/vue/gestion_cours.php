<h1><?php echo $cours->getLibelle(); ?></h1>

<?php 
foreach($listeThemes as $theme)
{
?>
<div class="row">
	<div class="col-lg-12 center-content">
		<div class="panel panel-default" id="T<?php echo $theme->getId(); ?>">
			<div class="panel-heading">
				<h3 class="panel-title" style="font-weight: bold;">
					<i class="fa fa-comments"></i> <?php echo $theme->getTitre();?>
				</h3>
			</div>
			<div class="panel-body">
						<?php 
						$listeExos = $daoExercice->getByAllByTheme($theme->getId());
						foreach($listeExos as $exos)
						{
							$listeFichiers = $daoFichiers->getAllByExercice($exos->getId());
						?>
						
							<div class="row" id="E<?php echo $exos->getId();?>">
								<a href="#" data-toggle="collapse" data-target="#bloc-<?php $exos->getId(); ?>">
									<?php echo $exos->getTitre(); ?>
								</a>
							</div>
							<div id="bloc-<?php $exos->getId(); ?>" class="collapse">
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
						
						<?php 
						}
						?>
			</div>
		</div>
	</div>
</div>
<?php 
}
?>