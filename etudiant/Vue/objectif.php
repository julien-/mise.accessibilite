<?php 
/*<a class="btn btn-primary" data-toggle="modal" data-target="#ViewAddObjectif">Ajouter un objectif</a>

<!-- Popup Ajout Objectif -->
<div class="modal fade" id="ViewAddObjectif" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
<h4 class="modal-title">Ajouter un objectif</h4>
</div>
<div class="modal-body" >
<select name="objectif">
<?php
foreach ($listeObjectifs as $objectif)
{
	?>
						<option value="<?php echo $objectif->getId();?>"><?php echo $objectif->getObjectif();?></option>
					<?php 
					}
					?>
					</select>
					&nbsp;avant le&nbsp;
					<input type="date" name="date" class="input-text">
            	</div>
	            <div class="modal-footer">
	            	<input type="submit" class="btn btn-primary" alt='Ajouter Objectif' title='Ajouter Objectif' value="Ajouter"/>
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
	      		</div>
        </div>
     </div>
</div>*/
?>


<h1>Objectifs</h1>
<?php 
foreach ($listeObjectifs as $objectif)
{
	echo $objectif->getObjectif()."<br>";
}
?>