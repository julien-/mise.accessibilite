<h1 class="titre_page_school_no_space">Forum</h1>
<h2 class="titre_h2_school"><?php echo $cours->getLibelle(); ?></h2>

<?php

if ($_SESSION['currentUser']->getAdmin())
{
    ?>
<a class="button_1"
	href="index.php?section=insert_categorie_forum&id_cours=<?php echo $id_cours; ?>">Insérer
	une catégorie</a>
<?php         
}

?>
<br />
<br />

<?php


if (sizeof($listeCategorie) == 0) {
        ?>
<p class="oldschool">Forum vide :(</p>
<?php
}
else {
	?>
<table class="tableau">
	<thead>
		<tr>
			<th>Forum</th>
			<th>Sujets</th>
			<th>Messages</th>
                    <?php
                    if ($_SESSION['currentUser']->getAdmin())
                    {
                    ?>
                        <th>Supprimer</th>
                    <?php
                    }
                    ?>
  		</tr>
	</thead>

                    <?php
                    foreach ($listeCategorie as $categorie) {
                        ?>
                        <tr>
		<td class="prem_colonne"><a
			href="index.php?section=liste_posts_forum&categorie=<?php echo $categorie->getId(); ?>&id_cours=<?php echo $id_cours; ?>"><?php echo $categorie->getTitre() ?></a>
			<br /> <span><?php echo $categorie->getDescription(); ?></span></td>
		<td class="autre_colonne">
                                <?php echo $categorie->getNbSujets(); ?>
                            </td>
		<td class="autre_colonne">
                                <?php echo $categorie->getNbMessages(); ?>
                            </td>
                            <?php
                            if ($_SESSION['currentUser']->getAdmin())
                            {
                            ?>
                                <td class="autre_colonne"><a
			href="../../forum/delete.php?section=<?php echo $_GET['section']; ?>&cours=<?php echo $id_cours; ?>&type=categorie&id=<?php echo $categorie->getId(); ?>"><img
				src="../../images/admin/flat_supp.png" alt="Supprimer"
				title="Supprimer" /></a></td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
        </table>
        <?php }?>