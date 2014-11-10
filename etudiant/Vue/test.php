<form method="post" name="form_modif_couleur" action="../Requete/rq_modification_couleur.php?section=test&modifiercouleur">
	<input type="color" name="couleur" value="<?php echo $daoInscription->getCouleur($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());?>"/>
	<input type="hidden" name="cours" value="<?php echo $_SESSION['cours']->getId();?>" />
	<input type="submit" class="soumettre_couleur btn btn-primary" alt="Modification couleur cours" title="Modification couleur cours" value="Modification couleur cours"/>
</form>