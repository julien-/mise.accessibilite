<a class="btn btn-primary" href="index.php?section=reception_messagerie">Boite de reception</a>
<a class="btn btn-primary" href="index.php?section=envoyes_messagerie">Boite d'envoi</a>
<h1>Envoyer un message</h1>

<form class="form-horizontal" method="post" name="form_envoyer_message" action="../../messagerie/requete/rq_envoyer_message.php?section=envoyes_messagerie&envoyermessage<?php if(isset($message_reponse)) echo "&id_message_reponse=".$message_reponse->getId();?>">
	<div class="row tt-input-group">  
      	<div class="col-lg-1">Pour :</div>
       	<div class="col-lg-11">
            	<?php 
            	if(isset($message_reponse))
            	{
            	?>
            		<input type="text" readonly="readonly" style="border: 1px solid darkgray;" class="form-control typeahead" value="<?php echo $message_reponse->getExpediteur()->getPrenomNom();?>">
            		<input type="hidden" class="typeahead" name="destinataire" value="<?php echo $message_reponse->getExpediteur()->getId();?>">
            	<?php 
            	}
            	elseif(isset($aideur))
            	{
            	?>
            		<input type="text" readonly="readonly" style="border: 1px solid darkgray;" class="form-control typeahead" value="<?php echo $aideur->getPrenomNom();?>">
            		<input type="hidden" class="typeahead" name="destinataire" value="<?php echo $aideur->getId();?>">
            	<?php 
            	}
            	elseif(isset($destinataire))
            	{
            	?>
            	    <input type="text" readonly="readonly" style="border: 1px solid darkgray;" class="form-control typeahead" value="<?php echo $destinataire->getPrenomNom();?>">
            	    <input type="hidden" class="typeahead" name="destinataire" value="<?php echo $destinataire->getId();?>">
            	<?php 
            	}
            	elseif(isset($listeClassmates) && sizeof($listeClassmates) != 0) 
            	{
            	?>
            		<input type="text" style="border: 1px solid darkgray;" class="form-control typeahead" id="nom_destinataire">
            		<input type="hidden" class="typeahead" name="destinataire" id="destinataire">
            	<?php 
            	}
            	else
            	{
            	?>
            		<input class="form-control" readonly="readonly" type="text" value="Vous êtes le seul membre inscrit pour l'instant">
            	<?php 
            	}
            	?>
      	</div>
	</div>
    <div class="row">
    	<br/>
        <div class="col-lg-1">Sujet: </div>
        <div class="col-lg-11"><input type="text" style="border: 1px solid darkgray;" class="form-control typeahead" name="titre" value="<?php if (isset($message_reponse)) echo "RE: ".$message_reponse->getTitre(); else if(isset($_GET['titre'])) echo $_GET['titre']; else if(isset($exercice)) echo "Demande d'aide pour l'exercice ".$exercice->getTitre();?>"></div>
    </div>
    <div class="row">
        <br/>
        <div class="col-lg-1">Message: </div>
        <div class="col-lg-11"><textarea class="form-control textarea" style="width: 100%; height: 200px;" name="message"><?php if (isset($message_reponse)) echo "\n\n\n\n----------------------------------------\nDate : ".$message_reponse->getDate()."\nSujet : ".$message_reponse->getTitre()."\nDe : ".$message_reponse->getExpediteur()->getPrenomNom()."\nMessage : \n".$message_reponse->getTexte(); else if(isset($_GET['message'])) echo $_GET['message']; else if(isset($exercice)) echo "Bonjour ".$aideur->getPrenomNom().",\n\nJ'aimerais avoir de l'aide pour l'exercice ".$exercice->getTitre().".\nMerci.\n\n".$_SESSION['currentUser']->getPrenomNom();?></textarea></div>
    </div>
    <?php 
    if((isset($listeClassmates) && sizeof($listeClassmates) != 0) || isset($message_reponse) || isset($exercice))
    {
    ?>
    <div align="center"><input class="btn btn-primary" style="width: auto;" type="submit" name="envoyer" value="Envoyer le message"></div>
    <?php 
    }
    ?>        
</form>
<br/><br/><br/><br/>