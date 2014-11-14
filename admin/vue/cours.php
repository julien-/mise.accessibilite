<?php 
if ($coursAdded)
{
	$alerte = new AlerteSuccess('Cours ajouté !');
	$alerte->show();
}
?>

<table class="interactive-table table table-bordered table-striped">
	<thead>
		<tr>
			<th>Cours</th>
			<th class="center-text">Inscrits</th>
			<th class="center-text">Nombre de thèmes</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	foreach($listeCours as $cours)
	{
	?>
		<tr>
			<td>
				<a href="../controleur/index.php?section=gestion_cours&c=<?php echo $cours->getId(); ?>"><?php echo $cours->getLibelle(); ?></a>
			</td>
			<td class="autre_colonne">
				<?php echo $daoInscription->countByCours($cours->getId()); ?>
			</td>
			<td class="autre_colonne">
				<?php echo $daoTheme->countByCours($cours->getId()); ?>
			</td>
		</tr>
	<?php 
	}
	?>
	</tbody>
</table>

<a class="btn btn-primary" id="addCours" data-toggle="modal"
	 data-target="#modalAddCours">Ajouter un
	cours</a>
				
<div class="modal fade" id="modalAddCours" tabindex="-1"
	role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Ajouter un cours</h4>
			</div>
			<br/>
			<form class="form-horizontal" action="../requetes/rq_add_cours.php" method="POST">
				<fieldset>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-2 control-label" for="nom-cours">Nom</label>  
					  <div class="col-md-9">
					  	<input id="nom-cours" name="nom-cours" type="text" placeholder="" class="form-control input-md" required="">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-md-2 control-label" for="cle-cours">Clé</label>  
					  <div class="col-md-9">
					  	<input id="cle-cours" name="cle-cours" type="text" placeholder="" class="form-control input-md" required="">
					  </div>
					</div>
				</fieldset>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
					<input type="submit" class="btn btn-primary"
						title="Ajouter"
						value="Ajouter" />
				</div>
			</form>			
		</div>
	</div>
</div>