<?php 
if (sizeof($listeSeance) > 0)
{
?>
    <table class="interactive-table table table-striped table-bordered" id="tab_seance">
        <thead>
            <tr class="titre">  <!--class pour rester toujours visible-->
                <th class="center-text">Date des seances prévues</th>
                <th name="first" class="center-text">Modifier la date des seances</th>
                <th class="center-text">Supprimer des seances</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($listeSeance as $seance) 
            {
            ?>
                <tr class="trSEANCE_<?php echo($seance->getCours()->getId()); ?>" >   <!--Pour savoir s'il faut afficher ou pas-->
                    <td class="autre_colonne vert-align">
                    	<span style="display:none"><?php echo $seance->getDate();?></span>
                    	<?php echo Outils::dateToFr($seance->getDate()); ?><!--Date de la séance-->
                   	</td>
                    <td class="autre_colonne">
                        <form method="post" name="form_seance_<?php echo $seance->getId();?>" action="../controleur/rq_seance.php?section=seance&majseance=<?php echo($seance->getId()); ?>">
                            <!-- Saisie de la date -->
                            <input type="date" class="input-text" name="dateseancemaj" id="dateseancemaj"/>
                            <!--submit-->
                            <a href="#" onClick=form_seance_<?php echo($seance->getId()); ?>.submit()><i class="glyphicon glyphicon-pencil" title="Modifier la date de cette séance"></i></a>
                        </form>
                    </td>
                    <td class="autre_colonne vert-align">
                   		<a href="../controleur/delete.php?seance=<?php echo($seance->getId()); ?>"><i class="glyphicon glyphicon-minus-sign" alt="Supprimer cette séance" title="Supprimer cette séance"></i></a> 
                    </td>
                </tr>
			<?php 
            } 
            ?>
        </tbody>
    </table> 
<?php 
}
else
{
?>
	<p class="no_results">Aucune séance n'est prévue pour ce cours</p>
<?php
}
?>
<a  class="btn btn-primary" data-toggle="modal" data-target="#ajoutExo">Ajouter une s&eacute;ance</a>  
<div class="modal fade" id="ajoutExo" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
     <div class="modal-dialog">  
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 id="myModalLabel" class="modal-title">Ajouter une séance</h4>
            </div>
            <br/>
            <form method="post" class="form-horizontal" action="rq_seance.php?section=seance&addseance">
            	<div class="container-fluid">
                	<div class="row">
                		<div class="col-sm-1">
                		</div>
                		<div class="col-sm-9">
	            		<div class="form-group">
	            			<label for="date" class="control-label col-lg-5">Date de la séance</label>
                            <div class="col-lg-6">
                            	<input class="form-control" type="date" name="date"/>	
                            </div>	                
                        </div>
                		<!--submit-->
		                <div class="form-group center-content">
		                	<input type="submit" class="btn btn-primary" name="submit" id="submit" alt='Ajouter une séance' title='Ajouter une séance' value="Ajouter"/>
		    			</div>
		    			<br/>
		    			</div>
		    			<div class="col-sm-1">
		    			</div>
	    			</div>
    			</div>
	    	</form>
        </div>
     </div>
</div>  
