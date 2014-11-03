<h2><?php echo $cours->getLibelle(); ?></h2>
<?php
if ($_SESSION ['currentUser']->getAdmin ()) 
{
	?>
<a class="btn btn-primary" data-toggle="modal" href="#"
	data-target="#ajoutCategorie">Créer une catégorie</a>
<div class="modal fade" id="ajoutCategorie" tabindex="-1" role="dialog"
	aria-labelledby="remoteModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">
					<span aria-hidden="true">×</span><span class="sr-only">Fermer</span>
				</button>
				<h4 id="myModalLabel" class="modal-title">Créer une catégorie</h4>
			</div>
			<br />
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-9">
						<form role="form" method="post"
							action="../../forum/controleur/ajout_categorie.php">
							<div class="form-group">
								<label for="titre">Titre</label> 
								<input type="text"
									class="form-control" name="titre">
							</div>
							<div class="form-group">
								<label for="description">Description</label>
								<input type="text"
									class="form-control" name="description">
							</div>
							<input type="hidden" name="cours"
								value="<?php echo $_GET['id_cours']; ?>" />
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
	<?php
}
?>
<br />
<br />
<?php
if (sizeof ( $listeCategorie ) == 0) 
{
	?>
	<p class="oldschool">Forum vide :(</p>
	<?php
} 
else 
{
	?>
	<table class="table">
		<thead>
			<tr style="background-color: #e8e8e8;">
				<th>Forum</th>
				<th class="center-text">Sujets</th>
				<th class="center-text">Messages</th>
		        <?php
				if ($_SESSION ['currentUser']->getAdmin ()) 
				{
					?>
		            <th class="center-text">Supprimer</th>
					<?php
				}
					?>
	  		</tr>
		</thead>
	
	    <?php
		foreach ( $listeCategorie as $categorie ) 
		{
		?>
		<tr>
			<td style="width: 40%;">
				<a href="index.php?section=liste_sujets_forum&categorie=<?php echo $categorie->getId(); ?>&id_cours=<?php echo $id_cours; ?>">
					<?php echo $categorie->getTitre() ?>
				</a>
				<br />
				<span>
					<?php echo $categorie->getDescription(); ?>
				</span>
			</td>
			<td class="center-text" style="width: auto;">
	        	<?php echo $categorie->getNbSujets(); ?>
	        </td>
			<td class="center-text" style="width: auto;">
				<?php echo $categorie->getNbMessages(); ?>
	        </td>
	        <?php
			if ($_SESSION ['currentUser']->getAdmin ()) 
			{
				?>
		        <td class="center-text" style="width: auto;">
		        	<a href="../../forum/controleur/delete_categorie.php?c=<?php echo $categorie->getId(); ?>">
		        		<i class="glyphicon glyphicon-minus-sign" alt="Supprimer cette catégorie" title="Supprimer cette catégorie"></i>
		        	</a>
		        </td>
		        <?php
			}
		?>
	    </tr>
	    <?php
		}
		?>
	</table>
<?php 
}
?>