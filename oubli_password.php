<ul id="loginTab" class="nav tabs" style="font-weight: bold;">
	<li class="active"><a href="#modificationpassword" data-toggle="tab">Modification du Mot de passe</a></li>
</ul>
<div id="loginTabContent" class="tab-content form-login-content">
	<div class="tab-pane fade active in" id="modificationpassword">
		<?php 
		$daoOubliPassword = new DAOOubliPassword($db);
		$oubli = $daoOubliPassword->getByCle($_GET["cle"]);
		$now = date("Y-m-d");
		if($oubli->getDate() <= $now)
		{
		?>
		<h1>Nouveau Mot de passe</h1>
		<p>Veuillez renseigner votre mouveau Mot de passe.</p>
		<form id="form_nouveau_mdp" class="form-horizontal" method="post" action="requete/rq_nouveau_mdp.php?nouveau_mdp">
			<div class="form-group has-feedback">
				<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
					<input type="password" name="new_password" id="new_password"
						class="form-control" placeholder="Mot de passe" /> <span
						class="glyphicon form-control-feedback" id="new_password1"></span>
				</div>
			</div>
			<div class="form-group has-feedback">
				<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
					<input type="password" name="confirm_new_password"
						id="confirm_new_password" class="form-control"
						placeholder="Confirmation Mot de passe" /> <span
						class="glyphicon form-control-feedback" id="confirm_new_password1"></span>
				</div>
			</div>
			<input type="hidden" name="cle" value="<?php echo $_GET["cle"];?>" />
			<button type="submit" class="btn btn-primary">Enregistrer</button>
			<button type="reset" class="btn btn-default">Effacer</button>
		</form>
		<?php 
		}
		else
		{
		?>
		<h1>Erreur</h1>
		<p>Vous avez dépassé la date limite de modification de votre mot de passe.</p>
		<?php 
		}
		?>
	</div>
</div>