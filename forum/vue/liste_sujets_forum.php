<?php

if (sizeof ( $listeSujets ) == 0) {
	?>
<p class="oldschool">Aucun sujet</p>
<?php
} else {
	?>
<a class="btn btn-primary" data-toggle="modal" href="#"
	data-target="#ajoutSujet">Créer un sujet</a>
	<br/><br/>
<table class="interactive-table table">
	<thead>
		<tr style="background-color: #e8e8e8;">
			<th>Titre du sujet</th>
			<th class="center-text">Messages</th>
			<th class="center-text">Dernier message</th>
                        <?php
	if ($_SESSION ['currentUser']->getAdmin ()) {
		?>
                            <th class="center-text">Supprimer</th>
                        <?php
	}
	?>
                    </tr>
	</thead>
	<tbody>
		            <?php
	foreach ( $listeSujets as $sujet ) {
		sscanf ( $sujet->getDateDerniereReponse (), "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde );
		?>
            <tr>
			<td class="vert-align"><a
				href="index.php?section=voir_sujet_forum&s=<?php echo $sujet->getId()?>"><?php echo htmlentities(trim($sujet->getTitre()));?></a>
				<br /> <span style="font-size: 11px">
            		Post&eacute; par 
					<?php echo htmlentities(trim($sujet->getAuteur()->getPrenom() . ' ' . $sujet->getAuteur()->getNom())); ?>
		</span></td>
			<td class="vert-align center-text">
		<?php echo $daoSujet->getNbMessages($sujet->getId()); ?>
		</td>
			<td class="vert-align center-text">
			<span style="display: none"><?php echo $annee.$mois.$jour.$heure.$minute.$seconde; ?></span>
            <?php
		echo $jour, '/', $mois, '/', $annee, ' ', $heure, ':', $minute, ':', $seconde;
		?>
            </td>
            <?php
		if ($_SESSION ['currentUser']->getAdmin ()) {
			?>
            <td class="vert-align center-text"><a
				href="../../forum/controleur/delete_sujet.php?s=<?php echo $sujet->getId(); ?>">
					<i class="glyphicon glyphicon-minus-sign"
					alt="Supprimer ce sujet" title="Supprimer ce sujet"></i>
			</a></td>
            <?php
		}
	}
	?>
           			</tr>
	</tbody>
</table>

<?php
}
?>
<a class="btn btn-primary" data-toggle="modal" href="#"
	data-target="#ajoutSujet">Créer un sujet</a>
<!-- Modal ajout cours-->
<div class="modal fade" id="ajoutSujet" tabindex="-1" role="dialog"
	aria-labelledby="remoteModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">
					<span aria-hidden="true">×</span><span class="sr-only">Fermer</span>
				</button>
				<h4 id="myModalLabel" class="modal-title">Créer un sujet</h4>
			</div>
			<br />
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-9">
						<form role="form" method="post"
							action="../../forum/controleur/ajout_sujet.php">
							<div class="form-group">
								<label for="titre">Titre</label> <input type="text"
									class="form-control" name="titre">
							</div>
							<div class="form-group">
								<label for="message">Message</label>
								<textarea name="message" class="form-control" cols="50"
									rows="10"></textarea>
							</div>
							<input type="hidden" name="id_categorie"
								value="<?php echo $_GET['categorie']; ?>" />
							<div class="form-group center-content">
								<button type="submit" class="btn btn-primary">Créer</button>
							</div>
							<br />
						</form>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<br/><br/><br/>