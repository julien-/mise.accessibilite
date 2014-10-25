<a class="btn btn-primary" href="index.php?section=reception_messagerie">Boite de reception</a>
<a class="btn btn-primary" href="index.php?section=envoyes_messagerie">Boite d'envoi</a>
<h1>Envoyer un message</h1>

<form class="form-horizontal" method="post" name="form_envoyer_messag" action="../../messagerie/Requete/rq_envoyer_message.php?section=envoyes_messagerie&envoyermessage<?php if(isset($message_reponse)) echo "&id_message_reponse=".$message_reponse->getId();?>">
	<div class="row tt-input-group">  
      	<div class="col-lg-1">Pour :</div>
       	<div class="col-lg-11">
            	<?php 
            	if(isset($message_reponse))
            	{
            	?>
            		<input type="text" style="border: 1px solid darkgray;" class="typeahead" name="nom_destinataire" value="<?php echo $message_reponse->getExpediteur()->getNom();?>"/>
            		<input type="hidden" class="typeahead" name="destinataire" value="<?php echo $message_reponse->getExpediteur()->getId();?>"/>
            	<?php 
            	}
            	else 
            	{
            	?>
            		<select name="destinataire">
            			<?php 
            			if(isset($listeClassmates) && sizeof($listeClassmates) != 0)
            			{
	            			foreach ($listeClassmates as $Classmates)
	            			{
	            			?>
            				<option <?php if(isset($_GET['destinataire']) && $_GET['destinataire'] == $Classmates->getEtudiant()->getId())  echo "selected";?> value="<?php echo $Classmates->getEtudiant()->getId();?>"><?php echo $Classmates->getEtudiant()->getNom()."&nbsp;".$Classmates->getEtudiant()->getPrenom()?></option>
            			<?php 
	            			}
            			}
            			else
            			{
            			?>
            				<option>Vous êtes le seul membre inscrit</option>
            			<?php 
            			}
            			?>
            		</select>
            	<?php 
            	}
            	?>
      	</div>
	</div>
    <div class="row">
   		<br/>
        <div class="col-lg-1">Sujet: </div>
        <div class="col-lg-11"><input type="text" style="width: 100%;" name="titre" value="<?php if (isset($message_reponse)) echo "RE: ".$message_reponse->getTitre(); else if(isset($_GET['titre'])) echo $_GET['titre'];?>"></div>
    </div>
    <div class="row">
        <br/>
        <div class="col-lg-1">Message: </div>
        <div class="col-lg-11"><textarea style="width: 100%; height: 200px;" name="message"><?php if (isset($message_reponse)) echo "Date : ".$message_reponse->getDate()."\nSujet : ".$message_reponse->getTitre()."\nDe : ".$message_reponse->getExpediteur()->getNom()."\nMessage : ".$message_reponse->getTexte(); else if(isset($_GET['message'])) echo $_GET['message'];?></textarea></div>
    </div>
    <?php 
    if((isset($listeClassmates) && sizeof($listeClassmates) != 0) || isset($message_reponse))
    {
    ?>
    <div align="center"><input class="btn btn-primary" style="width: auto;" type="submit" name="go" value="Envoyer le message"></div>
    <?php 
    }
    ?>        
</form>
