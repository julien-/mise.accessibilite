<div id="alerts"></div>
<a class="btn btn-success" data-toggle="modal" data-target="#ajoutExo">Ajouter une s&eacute;ance</a> 
<br/><br/>
<?php 
if (isset($_GET['added']))
{
	$alertAdded = new AlerteSuccess('Séance ajoutée');
	$alertAdded->show();
}
if (isset($_GET['deleted']))
{
	$alertDeleted = new AlerteSuccess('Séance supprimée');
	$alertDeleted->show();
}
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
                    	<span id="label-sort-date-<?php echo $seance->getId(); ?>"style="display:none"><?php echo $seance->getDate();?></span>
                    	<span id="label-date-<?php echo $seance->getId(); ?>"><?php echo Outils::dateToFr($seance->getDate()); ?></span>
                   	</td>
                    <td class="autre_colonne">
                            <!-- Saisie de la date -->
                            <input type="text" type="text" class="input-text form-control input-date" name="dateseancemaj"  id="input-date-<?php echo $seance->getId(); ?>"/>
                            <!--submit-->
                            <a data-id-seance="<?php echo $seance->getId(); ?>" class="pointer edit-date"><i class="glyphicon glyphicon-pencil" title="Modifier la date de cette séance"></i></a>
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
 
<div class="modal fade" id="ajoutExo" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
     <div class="modal-dialog">  
     	<form method="post" class="form-horizontal" action="../requetes/rq_add_seance.php">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	                <h4 id="myModalLabel" class="modal-title">Ajouter une séance</h4>
	            </div>
	            <br/>
	            	<div class="container-fluid">
	                	<div class="row">
	                		<div class="col-sm-1">
	                		</div>
	                		<div class="col-sm-9">
			            		<div class="form-group">
			            			<label for="date" class="control-label col-lg-5">Date de la séance</label>
		                            <div class="col-lg-6">
		                            	<input class="form-control input-date" type="text" name="date"/>	
		                            </div>	                
		                        </div>
			    			</div>
			    			<div class="col-sm-1">
			    			</div>
		    			</div>
	    			</div>
			   <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
					<input type="submit" class="btn btn-primary" name="submit"
						title="Ajouter la séance"
						value="Ajouter" />
				</div>
	        </div>

		</form>
     </div>
</div>  
<br/><br/><br/><br/>
