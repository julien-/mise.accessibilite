<div class="container-fluid">
	<div class="row" style="padding-top: 90px;">
		<div class="col-xs-3"></div>
		<div class="col-xs-6">
		<div class="panel panel-primary panel-transparent">
   <div class="panel-body">
			<div class="form-wrap">
				<h1>Bienvenue !</h1>
				<h4>Connectez-vous avec votre pseudo ou votre adresse email</h4>
				<form role="form" method="post" id="connexion">
					<div class="form-group">
						<label for="pseudo" class="sr-only">Email</label> <input
							type="pseudo" name="pseudo" id="pseudo" class="form-control"
							placeholder="Pseudo ou email">
					</div>
					<div class="form-group">
						<label for="password" class="sr-only">Password</label> <input
							type="password" name="mdp" id="mdp" class="form-control"
							placeholder="Mot de passe">
					</div>
					<div class="checkbox">
						<label><input type="checkbox" onclick="showPassword()"> Afficher le mot de passe</label>
					</div>
					<input type="submit" name="submit" id="btn-login"
						class="btn btn-custom btn-lg btn-block blue-bg" value="Connexion">
				</form>
				<div class="form-group">
				<a href="../index.php?section=inscription" class="forget">Pas encore inscrit ?</a>
				</div>
				<a href="javascript:;" class="forget" data-toggle="modal"
					data-target=".forget-modal">Mot de passe oublié ?</a>
				<hr>
				<div class="form-group">
						<?php
						foreach ( $errorList as $error ) {
							?>
						<div id="errors" class="alert alert-danger center-text">
							<a class="close" data-dismiss="alert">×</a> <span><?php echo $error; ?></span>
						</div>
						<?php
						}
						?>
				</div>
			</div>
			</div>
			</div>
		</div>
		<div class="col-xs-3"></div>
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


