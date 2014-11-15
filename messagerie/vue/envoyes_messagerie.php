<a class="btn btn-primary" href="index.php?section=reception_messagerie">Boite de reception</a>
<a class="btn btn-primary" href="index.php?section=envoyer_messagerie">Envoyer un message</a>
<?php 
if ($messageAdded)
{
	$alerte = new AlerteSuccess('Message envoyé !');
	$alerte->show();
}
?>
<h1>Boite d'envoi</h1>
<?php
if (sizeof($listeMessages) == 0) 
{
	echo 'Vous n\'avez envoyé aucun message.';
}
else 
{
?>
<br/>
<br/>
<table id="tableau" class="interactive-table table table-striped table-bordered">
	<thead>
	<tr>
		<th class="center-text">Destinataire</th>
		<th class="center-text">Sujet</th>
		<th class="center-text">Date</th>
	</tr>
	</thead>
	<tbody>

<?php 
	// si on a des messages, on affiche la date, un lien vers la page lire.php ainsi que le titre et l'auteur du message
	foreach($listeMessages as $message)
    {
    	?>
    	<tr class="<?php if (!$message->getLu()) echo "bold"?>" title="<?php if (!$message->getLu()) echo "Message non lu par le destinataire"; else echo "Message lu par le destinataire";?>">
    		<td class="autre_colonne">
    			<?php echo $message->getDestinataire()->getPrenom()."&nbsp;". $message->getDestinataire()->getNom(); ?>
    		</td>
    		<td class="prem_colonne"><?php echo $message->getTitre(); ?></td>
    		<td class="autre_colonne center-text"><span style="display:none"><?php echo $message->getId();?></span><?php echo Outils::dateToFr(substr($message->getDate(), 0, 10)) . " à " . $message->getHeure() ; ?></td>
    	</tr>
    	<?php
	}
?>
	</tbody>
</table>
<?php
}
?>
