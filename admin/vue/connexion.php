<style type="text/css">
#buttonGroupForm .btn-group .form-control-feedback {
	top: 0;
	right: -30px;
}
</style>


<div class="container-fluid">
	<div class="row" style="padding-top: 80px;">
		<div class="col-sm-12 center-content">
			<form id="connexion" method="post" class="form-horizontal">
			 <div class="form-group" id="errors">
            </div>
				<div class="form-group">
					<label class="col-lg-4 control-label">Pseudo</label>
					<div class="col-lg-3">
						<input type="text" class="form-control" name="pseudo"
							value="<?php echo $pseudo; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-4 control-label">Mot de passe</label>
					<div class="col-lg-3">
						<input type="password" class="form-control" name="mdp"
							value="<?php echo $mdp; ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-4 col-md-offset-5">
						<button type="submit" name="submit" class="btn btn-default">Login</button>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-5 col-md-offset-5">
						<a href="../controleur/index.php?section=inscription">Pas encore
							inscrit ?</a>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-3 col-md-offset-4">
						<?php
						foreach ( $errorList as $error ) {
							?>
						<div id="errors"class="alert alert-danger center-text">
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
	<!--/row-->
</div>

<!--/container-->


