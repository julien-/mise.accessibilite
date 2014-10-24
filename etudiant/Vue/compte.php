<!-- infos perso -->
<div class="col-md-7 personal-info" id="infosperso">
	<div id="erreur_nom"></div>
	<div id="erreur_prenom"></div>
	<div id="erreur_email"></div>
	<div id="erreur_username"></div>
	<h3>Informations personnelles</h3>

	<form class="form-horizontal" method="post" name="form_modify_infos" action="../Requete/rq_compte.php?section=compte&modifycompte">
		<div class="form-group">
			<label class="col-lg-3 control-label">Nom:</label>
			<div class="col-lg-8">
				<input class="form-control" type="text" name="nom"
					value="<?php echo $_SESSION['currentUser']->getNom();?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label">Prénom:</label>
			<div class="col-lg-8">
				<input class="form-control" type="text" name="prenom"
					value="<?php echo $_SESSION['currentUser']->getPrenom();?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label">Email:</label>
			<div class="col-lg-8">
				<input class="form-control" type="text" name="mail"
					value="<?php echo $_SESSION['currentUser']->getMail();?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Username:</label>
			<div class="col-md-8">
				<input class="form-control" type="text" name="login"
					value="<?php echo $_SESSION['currentUser']->getLogin();?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-8">
				<input id="validerinfos" type="submit" class="btn btn-primary" name="valider"
					value="Sauvegarder les changements"> <span></span> <input
					type="reset" class="btn btn-default" value="Annuler">
			</div>
		</div>
	</form>
</div>

<!-- mdp -->
<div class="col-md-7 personal-info" id="infospassword">
	<div id="erreur_ancien_vide"></div>
	<div id="erreur_nouveau_vide"></div>
	<div id="erreur_confirmation_vide"></div>
	<div id="erreur_anciens_differents"></div>
	<div id="erreur_nouveau_confirmation_differents"></div>
	<h3>Mot de passe</h3>

	<form class="form-horizontal" method="post" name="form_modify_password" action="../Requete/rq_compte.php?section=compte&modifypassword">
		 <div class="form-group">
            <label class="col-md-3 control-label">Ancien Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="ancien">
            </div>
         </div>
		 <div class="form-group">
            <label class="col-md-3 control-label">Nouveau Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="nouveau">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirmez Nouveau Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="confirmation">
            </div>
          </div>
		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-8">
				<input id="validerpassword" type="submit" class="btn btn-primary" name="valider"
					value="Sauvegarder le nouveau mot de passe">
			</div>
		</div>
		<input type="hidden" name="ancien_currentUser" value="<?php echo $_SESSION['currentUser']->getPass();?>"/>
	</form>
</div>



