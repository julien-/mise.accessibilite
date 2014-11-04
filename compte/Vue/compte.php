<div class="col-md-8">
	<h2>Informations personnelles</h2>
	<form id="form_info_perso" class="form-horizontal" method="post" action="../Requete/rq_compte.php?section=compte&modifycompte">
	    <div class="form-group has-feedback">
	        <label for="nom" class="control-label col-lg-3">Nom</label>
	        <div class="col-lg-5">
	            <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $_SESSION['currentUser']->getNom();?>" />
	            <span class="glyphicon form-control-feedback" id="nom1"></span>
	       </div>
	    </div>
	    <div class="form-group has-feedback">
	        <label for="prenom" class="control-label col-lg-3">Prénom</label>
	        <div class="col-lg-5">
	            <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo $_SESSION['currentUser']->getPrenom();?>" />
	            <span class="glyphicon form-control-feedback" id="prenom1"></span>
	        </div>
	    </div>
	    <div class="form-group has-feedback">
	        <label for="email" class="control-label col-lg-3">Email</label>
	        <div class="col-lg-5">
	            <input type="text" name="email" id="email" class="form-control" value="<?php echo $_SESSION['currentUser']->getMail();?>" />
	            <span class="glyphicon form-control-feedback" id="email1"></span>
	        </div>
	    </div>
	    <div class="form-group has-feedback">
	        <label for="pseudo" class="control-label col-lg-3">Pseudo</label>
	        <div class="col-lg-5">
	            <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?php echo $_SESSION['currentUser']->getLogin();?>" />
	            <span class="glyphicon form-control-feedback" id="pseudo1"></span>
	        </div>
	    </div>
	    <!-- Upload photo -->
	    <!-- 
	    <div class="form-group">
	        <label for="photo" class="control-label col-lg-3">Photo</label>
	        <div class="col-lg-5">
	            <span class="btn btn-default btn-file">
				    Télécharger <input type="file">
				</span>
	        </div>
	    </div>
	    -->	      
	    <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
	    <button	type="reset" class="btn btn-default">Annuler</button>
	</form>
</div>
<br>
<br>
<div class="col-md-8">
	<h3>Mot de passe</h3>
	<form id="form_mdp" class="form-horizontal" method="post" action="../Requete/rq_compte.php?section=compte&modifypassword">
	    <div class="form-group has-feedback">
	        <label for="nouveau_pwd" class="control-label col-lg-3">Nouveau mot de passe</label>
	        <div class="col-lg-5">
	            <input type="password" name="nouveau_pwd" id="nouveau_pwd" class="form-control" />
	            <span class="glyphicon form-control-feedback" id="nouveau_pwd1"></span>
	        </div>
	    </div>
	    <div class="form-group has-feedback">
	        <label for="confirm_pwd" class="control-label col-lg-3">Confirmation mot de passe</label>
	        <div class="col-lg-5">
	            <input type="password" name="confirm_pwd" id="confirm_pwd" class="form-control" />
	            <span class="glyphicon form-control-feedback" id="confirm_pwd1"></span>
	        </div>
	    </div>  
	    <button type="submit" class="btn btn-primary">Sauvegarder le nouveau mot de passe</button>
	</form>
</div>