<h1><?php echo $cours->getLibelle(); ?></h1>

<?php 
foreach($listeThemes as $theme)
{
?>



<div class="row">
	<div class="col-lg-12 center-content">
		<div class="panel panel-default" id="T<?php echo $theme->getId(); ?>">
			<div class="panel-heading header-theme" data-modif-theme-id="<?php echo $theme->getId(); ?>">
				<div class="row">
					<div class="col-lg-10">
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
</div>
<div class="col-lg-2">
					<div class="dropdown">
					  <button style="height: 30px;" id="edit-icon-theme-<?php echo $theme->getId(); ?>" data-modif-theme-id="<?php echo $theme->getId(); ?>" class="settings-icon hidden-base hidden btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown">
					    <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="options">
      					<li role="presentation">
	    					<a class="add-exercice" data-toggle="modal" data-target="#modalAddExercice" data-id-theme="<?php echo $theme->getId(); ?>">
								<i style="font-size: 15px;" class="glyphicon glyphicon-plus-sign" title="Ajouter un exercice à ce thème""></i>
					    		Ajouter un exercice
					    	</a>
				    	</li>
					    <li role="presentation">				
					    	<a class="edit-theme" data-modif-theme-id="<?php echo $theme->getId(); ?>">
								<i style="font-size: 15px;" class="glyphicon glyphicon-pencil" title="Modifier le titre de ce thème"></i>
								Modifier le titre
							</a>
						</li>
					    <li role="presentation">
	    					<a class="delete-theme" data-toggle="modal" data-target="#modalDeleteTheme" data-modif-theme-id="<?php echo $theme->getId(); ?>">
								<i style="font-size: 15px;" class="glyphicon glyphicon-trash" title="Supprimer ce thème"></i>
					    		Supprimer
					    	</a>
				    	</li>
					  </ul>
					</div>
					</div>
				</div>
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

<div class="modal fade" id="modalDeleteTheme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Supprimer</h4>
      </div>
      <div class="modal-body">
        Voulez-vous vraimez supprimer ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="delete-theme-confirm btn btn-primary" data-dismiss="modal">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAddExercice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" >Ajouter un exercice</h4>
      </div>
      <div class="modal-body">
       <form method="post" name="form_add_exo"
							action="../controleur/rq_add_cours.php">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-1"></div>
									<div class="col-sm-9">
										<div class="form-group">
											<label for="titre_exo">Titre de l'exercice</label> <input
												type="text" name="titre_exo" id="titre_exo" size="26"
												value="" title="Taper un titre d'exercice"
												class="form-control"> 
												<input type="hidden"
												name="id_theme" id="id_theme" /> 
										</div>
										<!--submit-->
										<div class="form-group center-content">
											<input type="submit" class="btn btn-primary"
												name="soumisajouexo" id="soumisajouexo"
												alt='Ajouter un exercice' title='Ajouter un exerccie'
												value="Ajouter" />
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
							</div>
						</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="delete-theme-confirm btn btn-primary" data-dismiss="modal">Supprimer</button>
      </div>
    </div>
  </div>
</div>
<?php 
}
?>