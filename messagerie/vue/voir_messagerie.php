<a class="btn btn-primary" href="index.php?section=reception_messagerie">Boite de reception</a>
<a class="btn btn-primary" href="index.php?section=envoyes_messagerie">Boite d'envoi</a>
<h1>Message reçu</h1>
<div class="row tt-input-group">
            <div class="col-lg-1">De :</div>
            <div class="col-lg-11">
            	<?php 
            	$identiteCompleteExpediteur = $message->getExpediteur()->getPrenom() . ' ' . $message->getExpediteur()->getNom() . ' (' . $message->getExpediteur()->getLogin() . ')';
            	?>
            	<input type="text" readonly="readonly" style="border: 1px solid darkgray;" class="form-control typeahead" value="<?php echo $identiteCompleteExpediteur;?>"/>
            </div>
</div>
<div class="row">
   		<br/>
            <div class="col-lg-1">Sujet: </div>
            <div class="col-lg-11">
            	<input type="text" readonly="readonly" style="border: 1px solid darkgray;" class="form-control typeahead" value="<?php echo $message->getTitre();?>"/>
            </div>
</div>
<div class="row">
        <br/>
        <div class="col-lg-1">Message: </div>
        <div class="col-lg-11">
        	<textarea readonly="readonly" style="width: 100%; height: 200px; resize:vertical;" class="form-control textarea"><?php echo $message->getTexte();?></textarea>
        </div>
</div>
<br/>
<div align="center"><a href="index.php?section=envoyer_messagerie&id_message_reponse=<?php echo $message->getId();?>" class="btn btn-primary">Répondre</a></div>