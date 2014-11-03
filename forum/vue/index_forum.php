<h2><?php echo $cours->getLibelle(); ?></h2>
<?php
if ($_SESSION ['currentUser']->getAdmin ()) 
{
	?>
	<a class="btn btn-primary" href="index.php?section=insert_categorie_forum&id_cours=<?php echo $id_cours; ?>">
		Insérer une catégorie
	</a>
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
		        	<a href="../../forum/delete.php?section=<?php echo $_GET['section']; ?>&cours=<?php echo $id_cours; ?>&type=categorie&id=<?php echo $categorie->getId(); ?>">
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