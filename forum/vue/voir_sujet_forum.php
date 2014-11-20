<table class="<?php if (!isset($_GET['repondre'])) echo 'interactive-table'; ?> table">
	<thead>
		<tr style="background-color: #e8e8e8;">
			<th style="display: none;"></th>
			<th>
				<?php echo $sujet->getTitre(); ?>
			</th>
			
		</tr>
	</thead>
	<?php 
	foreach($listeMessages as $message)
	{
	?>
		<tr>
			<td style="display: none;">
			</td>
			<td>
				<a href="#" class="bold"><?php echo $message->getAuteur()->getPrenomNom(); ?></a>
				<span style="position: relative; top: 0; color: #9996b3;"> Le <?php echo Outils::sqlDateTimeToFr($message->getDateReponse()); ?></span>
				<?php if ($_SESSION['currentUser']->getAdmin()) {?>
		        	<a href="../../forum/controleur/delete_message.php?m=<?php echo $message->getId(); ?>">
		        		<i class="glyphicon glyphicon-minus-sign" alt="Supprimer ce message" title="Supprimer ce message"></i>
		        	</a>
		        <?php }?>
				<br/><br/>
				<?php echo nl2br($message->getMessage()); ?>
			</td>

		</tr>
	<?php 
	}
	?>
</table>
<?php 
if (!isset($_GET['repondre']))
{
?>
	<a class="btn btn-primary" href="<?php echo Outils::currentPageURL().'&repondre=true#form_reponse';?>">Répondre</a>
<?php 
}
?>
<br/>
<br/>