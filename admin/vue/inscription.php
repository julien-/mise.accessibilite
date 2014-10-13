<style type="text/css">
#buttonGroupForm .btn-group .form-control-feedback {
	top: 0;
	right: -30px;
}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 center-content">
		<form id="inscription" class="form-horizontal" method="post">
			<div class="form-group">
				<label class="col-lg-5 control-label">Cl&eacute; d'inscription<sup>*</sup></label>
				<div class="col-lg-3">
					<input type="password" class="form-control" name="cle"
						value="<?php echo $cle; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-5 control-label">Nom<sup>*</sup></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="nom"
						value="<?php echo $nom; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-5 control-label">Pr&eacute;nom<sup>*</sup></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="prenom"
						value="<?php echo $prenom; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-5 control-label">E-mail<sup>*</sup></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="mail"
						value="<?php echo $mail; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-5 control-label">Pseudo<sup>*</sup></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="pseudo"
						value="<?php echo $pseudo; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-5 control-label">Mot de passe<sup>*</sup></label>
				<div class="col-lg-3">
					<input type="password" class="form-control" name="mdp"
						value="<?php echo $mdp; ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-5 control-label">Confirmation de mot de passe<sup>*</sup></label>
				<div class="col-lg-3">
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
				<div class="col-lg-3 col-md-offset-4">
					<?php
						foreach($errorList as $error)
						{
					?>
					<div class="alert alert-danger center-text">  
						<a class="close" data-dismiss="alert">×</a>  
							<span><?php echo $error; ?></span>
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


