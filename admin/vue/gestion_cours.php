
<div class="row">
	<div class="col-lg-9"></div>
	<div class="col-lg-3">
		<div class="dropdown">
			<button id="icon-cours"
				data-cours-id="<?php echo $cours->getId(); ?>"
				class="settings-icon btn btn-default dropdown-toggle"
				type="button" id="dropdownMenu1" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> Outils
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="options">
				<li role="presentation"><a data-id-cours="<?php echo $cours->getId(); ?>" class="pointer add-theme" data-toggle="modal"
					data-target="#modalAddTheme"> <i style="font-size: 15px;"
						class="glyphicon glyphicon-plus-sign"
						title="Ajouter un thème à ce cours"></i> Ajouter un thème
				</a></li>
				<li role="presentation"><a class="pointer edit-cours"
					data-id-cours="<?php echo $cours->getId(); ?>"> <i
						style="font-size: 15px;" class="glyphicon glyphicon-pencil"
						title="Modifier le titre de ce cours"></i> Modifier le titre du cours
				</a></li>
				<li role="presentation"><a class="pointer delete-cours" data-toggle="modal"
					data-target="#modalDeleteCours"
					data-id-cours="<?php echo $cours->getId(); ?>"> <i
						style="font-size: 15px;" class="glyphicon glyphicon-trash"
						title="Supprimer ce cours"></i> Supprimer le cours
				</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<input type="text" id="input-cours"
			class="base-hidden form-control hidden input-cours"
			value="<?php echo $cours->getLibelle(); ?>"
			data-cours-id="<?php echo $cours->getId(); ?>" />
		<p class="center-text button-group base-hidden">
			<a id="valid-cours" class="pointer hidden base-hidden valid-cours"
				data-cours-id="<?php echo $cours->getId(); ?>"> <br />
			<i style="font-size: 50px;" class="glyphicon glyphicon-ok-circle"
				title="Valider"></i>
			</a> <a id="abort-cours" class="pointer hidden base-hidden abort-cours"> <i
				style="font-size: 50px;" class="glyphicon glyphicon-remove-circle"
				title="Annuler"></i>
			</a>
		</p>

		<h1 class="base titre header-cours" id="titre-cours"
			data-cours-id="<?php echo $cours->getId(); ?>">
							<?php echo $cours->getLibelle(); ?>
					</h1>
	</div>
</div>
<?php
foreach ( $listeThemes as $theme ) {
	?>



<div class="row">
	<div class="col-lg-12 center-content">
		<div class="panel panel-default" id="T<?php echo $theme->getId(); ?>">
			<div class="panel-heading header-theme"
				data-modif-theme-id="<?php echo $theme->getId(); ?>">
				<div class="row">
					<div class="col-lg-10">
						<input type="text" id="theme-<?php echo $theme->getId(); ?>"
							class="base-hidden form-control hidden input-theme"
							value="<?php echo $theme->getTitre(); ?>"
							data-input-theme-id="<?php echo $theme->getId(); ?>" />
						<p class="center-text">
							<a id="edit-valid-theme-<?php echo $theme->getId(); ?>"
								class="pointer hidden base-hidden validate-icon-theme"
								data-modif-theme-id="<?php echo $theme->getId(); ?>"> <br />
							<i style="font-size: 50px;" class="glyphicon glyphicon-ok-circle"
								title="Valider"></i>
							</a> <a id="edit-abort-theme-<?php echo $theme->getId(); ?>"
								class="pointer hidden base-hidden abort-icon-theme"> <i
								style="font-size: 50px;"
								class="glyphicon glyphicon-remove-circle" title="Annuler"></i>
							</a>
						</p>

						<a class="pointer base titre"
							id="titre-theme-<?php echo $theme->getId(); ?>"
							data-modif-theme-id="<?php echo $theme->getId(); ?>"
							data-toggle="collapse"
							data-target="#bloc-<?php echo $theme->getId(); ?>">
						<?php echo $theme->getTitre(); ?>
					</a>
					</div>
					<div class="col-lg-2">
						<div class="dropdown">
							<button style="height: 30px;"
								id="edit-icon-theme-<?php echo $theme->getId(); ?>"
								data-modif-theme-id="<?php echo $theme->getId(); ?>"
								class="settings-icon hidden-base hidden btn btn-default dropdown-toggle glyphicon glyphicon-cog"
								type="button" id="dropdownMenu1" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="options">
								<li role="presentation"><a class="pointer add-exercice"
									data-toggle="modal" data-target="#modalAddExercice"
									data-id-theme="<?php echo $theme->getId(); ?>"> <i
										style="font-size: 15px;" class="glyphicon glyphicon-plus-sign"
										title="Ajouter un exercice à ce thème""></i> Ajouter un
										exercice
								</a></li>
								<li role="presentation"><a class="pointer edit-theme"
									data-modif-theme-id="<?php echo $theme->getId(); ?>"> <i
										style="font-size: 15px;" class="glyphicon glyphicon-pencil"
										title="Modifier le titre de ce thème"></i> Modifier le titre
								</a></li>
								<li role="presentation"><a class="pointer delete-theme"
									data-toggle="modal" data-target="#modalDeleteTheme"
									data-modif-theme-id="<?php echo $theme->getId(); ?>"> <i
										style="font-size: 15px;" class="glyphicon glyphicon-trash"
										title="Supprimer ce thème"></i> Supprimer
								</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">

						<?php
	$listeExos = $daoExercice->getByAllByTheme ( $theme->getId () );
	foreach ( $listeExos as $exos ) {
		$listeFichiers = $daoFichiers->getAllByExercice ( $exos->getId () );
		?>
						
					<tr class="header-exo" id="E<?php echo $exos->getId();?>"
								data-modif-exo-id="<?php echo $exos->getId(); ?>">
						<td>
							<div>
								<div class="row">
									<div class="col-lg-10">
										<input type="text" id="exo-<?php echo $exos->getId(); ?>"
											class="base-hidden form-control hidden input-exo"
											value="<?php echo $exos->getTitre(); ?>"
											data-input-exo-id="<?php echo $exos->getId(); ?>" />
										<p class="center-text">
											<a id="edit-valid-exo-<?php echo $exos->getId(); ?>"
												class="pointer hidden base-hidden validate-icon-exo"
												data-modif-exo-id="<?php echo $exos->getId(); ?>"> <br />
											<i style="font-size: 50px;" class="glyphicon glyphicon-ok-circle"
												title="Valider"></i>
											</a> <a id="edit-abort-exo-<?php echo $exos->getId(); ?>"
												class="pointer hidden base-hidden abort-icon-exo"> <i
												style="font-size: 50px;"
												class="glyphicon glyphicon-remove-circle" title="Annuler"></i>
											</a>
										</p>
				
										<a class="pointer base titre"
											id="titre-exo-<?php echo $exos->getId(); ?>"
											data-modif-exo-id="<?php echo $exos->getId(); ?>"
											data-toggle="collapse"
											data-target="#bloc-<?php echo $exos->getId(); ?>">
										<?php echo $exos->getTitre(); ?>
									</a>
									</div>
									<div class="col-lg-2">
										<div class="dropdown">
											<button style="height: 30px;"
												id="edit-icon-exo-<?php echo $exos->getId(); ?>"
												data-modif-exo-id="<?php echo $exos->getId(); ?>"
												class="settings-icon hidden-base hidden btn btn-default dropdown-toggle glyphicon glyphicon-cog"
												type="button" id="dropdownMenu1" data-toggle="dropdown">
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu" aria-labelledby="options">
												<li role="presentation"><a class="pointer add-fichier-exo"
													data-toggle="modal" data-target="#modalAddFichier"
													data-id-exo="<?php echo $exos->getId(); ?>"> <i
														style="font-size: 15px;" class="glyphicon glyphicon-plus-sign"
														title="Ajouter un exercice à ce thème""></i> Ajouter un
														fichier
												</a></li>
												<li role="presentation"><a class="pointer edit-exo"
													data-modif-exo-id="<?php echo $exos->getId(); ?>"> <i
														style="font-size: 15px;" class="glyphicon glyphicon-pencil"
														title="Modifier le titre de ce thème"></i> Modifier le titre de l'exercice
												</a></li>
												<li role="presentation"><a class="pointer delete-exo"
													data-toggle="modal" data-target="#modalDeleteExo"
													data-modif-exo-id="<?php echo $exos->getId(); ?>"> <i
														style="font-size: 15px;" class="glyphicon glyphicon-trash"
														title="Supprimer ce thème"></i> Supprimer l'exercice
												</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>

							<div id="bloc-<?php echo $exos->getId(); ?>" class="collapse">
								<hr>
								<?php 
								if (sizeof($listeFichiers) > 0)
								{
								?>
								<table style="background-color: #F0F0F0; width: 100%;">
									<?php
									foreach ( $listeFichiers as $fichier ) {
									?>
										<ul>
											<li class="header-fichier" data-fichier-id="<?php echo $fichier->getId(); ?>">
													<a href="../../controleur/download.php?f=<?php echo $fichier->getCodeLien();?>"><?php echo $fichier->getNom();?></a>
													<br/>
													<label class="control-label" for="online-fichier-<?php echo $fichier->getId(); ?>">Visible en ligne    </label>
											      	<input name="online-fichier-<?php echo $fichier->getId(); ?>" id="online-fichier-<?php echo $fichier->getId(); ?>" class="online-fichier" type="checkbox" data-id-fichier="<?php echo $fichier->getId(); ?>" name="online" value="" <?php if ($fichier->getEnLigne()) echo 'checked="checked"';?>>
													<hr>	
													<span class="desc-fichier-texte" id="desc-fichier-<?php echo $fichier->getId(); ?>" data-id-fichier=""<?php echo $exos->getId(); ?>""><?php echo $fichier->getCommentaire();?></span>
										</li>
										</ul>
								<?php
									}
								?>
		
									</table>
								<?php
								}
								else 
								{
								?>
								<p class="no_results">Aucun fichier pour cet exercice</p>
								<?php 
								}
								?>
								
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

<!--  Modales exercices -->
<div class="modal fade" id="modalDeleteExo" tabindex="-1"
	role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Supprimer l'exercice</h4>
			</div>
			<div class="modal-body">Voulez-vous vraiment supprimer cet exercice ?</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<button type="button" class="delete-exo-confirm btn btn-danger"
					data-dismiss="modal">Supprimer</button>
			</div>
		</div>
	</div>
</div>

<!--  Modales thème -->
<div class="modal fade" id="modalDeleteTheme" tabindex="-1"
	role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Supprimer</h4>
			</div>
			<div class="modal-body">Voulez-vous vraiment supprimer ?</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<button type="button" class="delete-theme-confirm btn btn-danger"
					data-dismiss="modal">Supprimer</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAddExercice" tabindex="-1"
	role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title">Ajouter un exercice</h4>
			</div>
			<form method="post" name="form_add_exo"
					action="../requetes/rq_add_exercice.php">
			<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-9">
								<div class="form-group">
									<label for="titre_exo">Titre de l'exercice</label> <input
										type="text" name="titre_exo" id="titre_exo" size="26" value=""
										title="Taper un titre d'exercice" class="form-control"> <input
										type="hidden" name="id_theme" id="id_theme" />
								</div>
							</div>
							<div class="col-sm-1"></div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<input type="submit" class="btn btn-primary"
					name="soumisajouexo" id="soumisajouexo"
					alt='Ajouter un exercice' title='Ajouter un exercice'
					value="Ajouter" />
			</div>
			</form>
		</div>
	</div>
</div>
<?php
}
?>

<!--  Modales cours -->
<div class="modal fade" id="modalAddTheme" tabindex="-1"
	role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fermrt</span>
				</button>
				<h4 class="modal-title">Ajouter un thème</h4>
			</div>
					<form method="post" name="form_add_theme"
					action="../requetes/rq_add_theme.php">
			<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-1"></div>
							<div class="col-sm-9">
								<div class="form-group">
									<label for="titre_exo">Titre du thème</label> <input
										type="text" name="titre_theme" id="titre_theme" size="26" value=""
										title="Taper un titre de thème" class="form-control"> 
										<input
										type="hidden" name="id-cours" id="id-cours" />
								</div>
							</div>
							<div class="col-sm-1"></div>
						</div>
					</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<input type="submit" class="btn btn-primary"
					alt='Ajouter un thème' title='Ajouter un thème'
					value="Ajouter" />
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalDeleteCours" tabindex="-1"
	role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Supprimer</h4>
			</div>
			<form action="../controleur/delete.php" method="GET">
				<div class="modal-body">Voulez-vous vraiment supprimer ce cours ?</div>
				<input type="hidden" name="cours-delete" id="cours-delete"/>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
					<input type="submit" class="btn btn-danger"
						title="Supprimer le cours"
						value="Supprimer" />
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAddFichier" tabindex="-1"
	role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Supprimer</h4>
			</div>
			<form class="form-horizontal" action="../requetes/rq_add_fichier.php" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<fieldset>
						<!-- File Button --> 
						<div class="form-group">
						  <label class="col-md-4 control-label" for="fichier">Fichier</label>
						  <div class="col-md-4">
						    <input id="fichier" name="fichier" class="input-file" type="file">
						    <input id="exercice-fichier" name="exercice-fichier" type="hidden">
						  </div>
						</div>
						<!-- Textarea -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="desc-fichier">Description</label>
						  <div class="col-md-4">                     
						    <textarea class="form-control" id="desc-fichier" name="desc-fichier" cols="50"></textarea>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-md-4 control-label" for="online">En ligne</label>
						  <div class="col-md-4">
						  	<div class="radio">
						      <input type="checkbox" name="online" id="online" value="" checked="checked">
							</div>
						  </div>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<input type="submit" class="btn btn-primary" name="submit"
							title="Supprimer le cours"
							value="Ajouter" />
				</div>
			</form>
		</div>
	</div>
</div>