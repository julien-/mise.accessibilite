<h1>Objectifs</h1>

<?php 
foreach ($listeAssignationsObjectifs as $assignation)
{
?>
	<div class="row">
		<div class="col-lg-3">
			<img class="<?php if ($assignation->getPourcentage() < 100) echo 'blur';?>" src="<?php echo Outils::getServerURL() . '/images/Badges/' . str_replace(' ', '_', $assignation->getObjectif()->getObjectif()) . '.png'; ?>" alt="<?php echo $assignation->getObjectif()->getObjectif(); ?>" />
		</div>
		<div class="col-lg-8">
			<span class="bold"><?php echo $assignation->getObjectif()->getObjectif(); ?></span><span class="italic" style="font-size: 12px;"><?php if ($assignation->getPourcentage() == 100) echo ' Obtenu le ' . Outils::dateToFr($assignation->getDate()); ?></span>
			<br/>
			<?php echo $assignation->getObjectif()->getDescription(); ?>
				<div class="progress progress-striped progress-borders"
					style="margin-top: 12px;">
					<div class="progress-bar progress-bar-primary vert-align" 
                         style="color: black; background-color: <?php echo Outils::colorChart($assignation->getPourcentage()); ?>; width: <?php echo $assignation->getPourcentage(); ?>%;">
                         <?php echo $assignation->getPourcentage(); ?> %
                    </div>
				</div>
		</div>
	</div>
<?php 
}
?>

