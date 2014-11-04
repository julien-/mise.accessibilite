<style type="text/css">
#buttonGroupForm .btn-group .form-control-feedback {
	top: 0;
	right: -30px;
}
</style>



<div class="container-fluid">
	<div class="row" style="padding-top: 90px;">
		<div class="col-xs-2"></div>
		<div class="col-xs-8">
		<div class="panel panel-primary panel-transparent">
   <div class="panel-body">
			<div class="form-wrap">
				<h1>Inscription</h1>
				<h4>Tous les champs sont requis</h4>
				
<form id="inscription" class="form-horizontal" method="post">
		<?php
		if (isset ( $_GET ['prof'] )) {
			?>
			<div class="form-group">
					<label class="col-lg-5 control-label">Cl&eacute; d'inscription<sup>*</sup></label>
					<div class="col-lg-4">
						<input type="password" class="form-control" name="cle"
							value="<?php echo $cle; ?>" />
					</div>
				</div>
		<?php
		}
		?>
			<div class="form-group">
					<label class="col-lg-5 control-label">Nom<sup>*</sup></label>
					<div class="col-lg-4">
						<input type="text" class="form-control" name="nom"
							value="<?php echo $nom; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-5 control-label">Pr&eacute;nom<sup>*</sup></label>
					<div class="col-lg-4">
						<input type="text" class="form-control" name="prenom"
							value="<?php echo $prenom; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-5 control-label">E-mail<sup>*</sup></label>
					<div class="col-lg-4">
						<input type="text" class="form-control" name="mail"
							value="<?php echo $mail; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-5 control-label">Pseudo<sup>*</sup></label>
					<div class="col-lg-4">
						<input type="text" class="form-control" name="pseudo"
							value="<?php echo $pseudo; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-5 control-label">Mot de passe<sup>*</sup></label>
					<div class="col-lg-4">
						<input type="password" class="form-control" id="mdp" name="mdp"
							value="<?php echo $mdp; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-5 control-label">Confirmation de mot de passe<sup>*</sup></label>
					<div class="col-lg-4">
						<input type="password" class="form-control" name="confirmation"
							value="<?php echo $confirmation; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-5 col-md-offset-5">
						<button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-5 col-md-offset-3">
					<?php
					foreach ( $errorList as $error ) {
						?>
					<div class="alert alert-danger center-text">
							<a class="close" data-dismiss="alert">×</a> <span><?php echo $error; ?></span>
						</div>
					<?php
					}
					?>
				</div>
				</div>
			</form>
			</div>
			</div>
			</div>
		</div>
		<div class="col-xs-2"></div>
		<!-- /.col-xs-12 -->
	</div>
	<!--/row-->
</div>
<!--/container-->

<div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title">Mot de passe oublié</h4>
			</div>
			<div class="modal-body">
				<p>Tapez votre adresse email</p>
				<input type="email" name="recovery-email" id="recovery-email" class="form-control" autocomplete="off">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-custom">Envoyer</button>
			</div>
		</div> <!-- /.modal-content -->
	</div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->





