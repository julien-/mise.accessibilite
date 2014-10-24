<h1>Mes messages</h1>
<a class="btn btn-primary" href="index.php?section=envoyer_messagerie">Envoyer un message</a>

<?php
if (sizeof($listeMessages) == 0) 
{
	echo 'Vous n\'avez aucun message.';
}
else 
{
?>
<br/>
<br/>
<table id="tableau" class="interactive-table table table-striped table-bordered">
	<thead>
	<tr>
		<th class="center-text">Expéditeur</th>
		<th class="center-text">Titre</th>
		<th class="center-text">Date</th>
	</tr>
	</thead>
	<tbody>

<?php 
	// si on a des messages, on affiche la date, un lien vers la page lire.php ainsi que le titre et l'auteur du message
	foreach($listeMessages as $message)
    {
    	?>
    	<tr class="<?php if (!$message->getLu()) echo "bold"?>">
    		<td class="autre_colonne"><?php echo $message->getExpediteur()->getPrenom() . ' ' . $message->getExpediteur()->getNom(); ?></td>
    		<td class="prem_colonne"><?php echo $message->getTitre(); ?></td>
    		<td class="autre_colonne center-text"><?php echo Outils::dateToFr(substr($message->getDate(), 0, 10)) . " à " . $message->getHeure() ; ?></td>
    	</tr>
    	<?php
	}
?>
	</tbody>
</table>
<?php
}
?>
