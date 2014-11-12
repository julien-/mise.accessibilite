<div class="row show-grid">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-wrench"></i> Gestion du thème
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<form method="post" name="form_modif_couleur" action="../requete/rq_modification_couleur.php?section=informations&modifiercouleur">
						Couleur de fond <input type="color" name="couleur_fond" value="<?php echo $daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());?>"/>
						<br>Couleur du texte <input type="color" name="couleur_texte" value="<?php echo $daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());?>"/><br>
						<input type="hidden" name="cours" value="<?php echo $_SESSION['cours']->getId();?>" />
						<input type="submit" class="soumettre_couleur btn btn-primary" alt="Modification couleur cours" title="Modification couleur cours" value="Modification couleur cours"/>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-user"></i> Enseignant
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<?php echo $_SESSION['cours']->getProf()->getNom()."&nbsp;".$_SESSION['cours']->getProf()->getPrenom();?>
					<br>
					<?php echo $_SESSION['cours']->getProf()->getMail();?>
				</div>
			</div>
		</div>
	</div>
</div>