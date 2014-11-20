<?php 
if ($inscriptionCleProfInValide)
{
	$alerte = new AlerteDanger('Clé enseignant invalide');
	$alerte->show_racine();
}
if ($typeFichierInvalide)
{
	$alerte = new AlerteDanger('Type de fichier invalide (valides : .JPG, .JPEG, .BMP, .GIF, .PNG)');
	$alerte->show_racine();
}
if ($nomFichierInvalide)
{
	$alerte = new AlerteDanger('Nom de fichier invalide');
	$alerte->show_racine();
}
?>
<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8" style="background-color:#FFFFFF;">
	<h1>Inscription</h1>
	<h4>Tous les champs sont requis</h4>
	<form id="form_inscription" class="form-horizontal" method="post" enctype="multipart/form-data" action="../ProjetSynthese/requete/rq_inscription.php?inscription">
	    <div class="form-group has-feedback">
	        <label for="nom" class="control-label col-xs-12 col-sm-5 col-md-5">Nom</label>
	        <div class="col-xs-12 col-sm-7 col-md-5">
	            <input type="text" name="nom_minuscules" id="nom_minuscules" class="form-control" />
	            <span class="glyphicon form-control-feedback" id="nom_minuscules1"></span>
	       </div>
	    </div>
	    <div class="form-group has-feedback">
	        <label for="prenom" class="control-label col-xs-12 col-sm-5 col-md-5">Prénom</label>
	        <div class="col-xs-12 col-sm-7 col-md-5">
	            <input type="text" name="prenom" id="prenom" class="form-control" />
	            <span class="glyphicon form-control-feedback" id="prenom1"></span>
	        </div>
	    </div>
	    <div class="form-group has-feedback">
	        <label for="email" class="control-label col-xs-12 col-sm-5 col-md-5">Email</label>
	        <div class="col-xs-12 col-sm-7 col-md-5">
	            <input type="text" name="email" id="email" class="form-control" />
	            <span class="glyphicon form-control-feedback" id="email1"></span>
	        </div>
	    </div>
	    <div class="form-group has-feedback">
	        <label for="pseudo" class="control-label col-xs-12 col-sm-5 col-md-5">Pseudo</label>
	        <div class="col-xs-12 col-sm-7 col-md-5">
	            <input type="text" name="pseudo" id="pseudo" class="form-control" />
	            <span class="glyphicon form-control-feedback" id="pseudo1"></span>
	        </div>
	    </div>
	    <!-- Upload photo -->
	    <div class="form-group">
	        <label for="photo" class="control-label col-xs-12 col-sm-5 col-md-5">Avatar</label>
	        <div class="col-xs-12 col-sm-7 col-md-5">
	            <span class="btn btn-default btn-file">
				    Télécharger <input type="file" name="fichier">
				</span>
	        </div>
	    </div> 
	    <div class="form-group has-feedback">
	        <label for="nouveau_pwd" class="control-label col-xs-12 col-sm-5 col-md-5">Mot de passe</label>
	        <div class="col-xs-12 col-sm-7 col-md-5">
	            <input type="password" name="password" id="password" class="form-control" />
	            <span class="glyphicon form-control-feedback" id="password1"></span>
	        </div>
	    </div>
	    <div class="form-group has-feedback">
	        <label for="confirm_pwd" class="control-label col-xs-12 col-sm-5 col-md-5">Confirmation du mot de passe</label>
	        <div class="col-xs-12 col-sm-7 col-md-5">
	            <input type="password" name="confirm_password" id="confirm_password" class="form-control" />
	            <span class="glyphicon form-control-feedback" id="confirm_password1"></span>
	        </div>
	    </div>	    
	    <div class="form-group">
	        <label for="enseignant" class="control-label col-xs-12 col-sm-5 col-md-5">Enseignant</label>
	        <div class="col-xs-12 col-sm-7 col-md-5">
	            <input type="checkbox" name="enseignant" id="enseignant"/>
	        </div>
	    </div>	    
	    <div class="form-group has-feedback" id="cle">
	    </div>	    	      
	    <button type="submit" class="btn btn-primary">S'inscrire</button>
	    <button	type="reset" class="btn btn-default">Annuler</button>
	</form>		
</div>






