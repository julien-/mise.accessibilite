<form method="post" name="form_modif_couleur" action="../Requete/rq_modification_couleur.php?section=test&modifiercouleur">
	Couleur de fond <input type="color" name="couleur_fond" value="<?php echo $daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());?>"/>
	<br>Couleur du texte <input type="color" name="couleur_texte" value="<?php echo $daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());?>"/><br>
	<input type="hidden" name="cours" value="<?php echo $_SESSION['cours']->getId();?>" />
	<input type="submit" class="soumettre_couleur btn btn-primary" alt="Modification couleur cours" title="Modification couleur cours" value="Modification couleur cours"/>
</form>