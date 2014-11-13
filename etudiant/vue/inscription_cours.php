<table id="tableau" class="interactive-table table table-striped table-bordered table-hover">
	<thead>
		<tr class="titre">
			<th class="center-text">Titre du cours</th>
			<th class="center-text">Nombre d'inscrits</th>
			<th class="center-text">Enseignant</th>
		</tr>
	</thead>
	<tbody>
		<?php
	    foreach ($listeAllCours as $cours)
	    {
	    ?>
        <tr <?php if($daoInscription->estInscrit($_SESSION['currentUser']->getId(), $cours->getId())) echo 'class="success"';?>>
        	<td class="autre_colonne">
        		<?php 
        		if(!($daoInscription->estInscrit($_SESSION['currentUser']->getId(), $cours->getId())))
        		{
        		?>        		
        		<a data-toggle="modal" data-target="#ViewInscriptionCours<?php echo $cours->getId();?>" title="S'inscrire à ce cours"><?php echo $cours->getLibelle();?></a>
        		<!-- Popup Inscription cours -->
				<div class="modal fade" id="ViewInscriptionCours<?php echo $cours->getId();?>" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
				     <div class="modal-dialog">  
				        <div class="modal-content">
				            <div class="modal-header">
				                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				                <h4 class="modal-title">S'inscrire au cours : <?php echo $cours->getLibelle();?></h4>
				            </div>
				            <form method="post" name="form_inscription_cours<?php echo $cours->getId();?>" action="../requete/rq_inscription_cours.php?inscriptioncours">
								<div class="modal-body">
									<div class="form-group">
				            			<label for="cle">Clé d'inscription</label>
					                	<input type="text" name="cle" id="cle<?php echo $cours->getId();?>" size="35" class="inputValDefaut"/>
					                </div>
			                		<p></p>
				                </div>
				                <div class="modal-footer">
									<input type="hidden" name="id_cours" value="<?php echo $cours->getId();?>"/>
									<input type="hidden" id="good_key<?php echo $cours->getId();?>" name="good_key" value="<?php echo $cours->getCle()->getCle();?>"/>
				                	<input type="submit" class="soumettre_inscription btn btn-primary" id="<?php echo $cours->getId();?>" alt='Inscription' title='Inscription' value="S'inscrire"/>
				                	<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
				    			</div>
				            </form>
				        </div>
				     </div>
				</div> 
				<?php 
	    		}
	    		else 
	    			echo $cours->getLibelle();
				?>
        	</td>
        	<td class="autre_colonne">
        		<?php echo $daoInscription->countByCours($cours->getId());?>
        	</td>
        	<td class="autre_colonne">
        		<?php echo $cours->getProf()->getNom()." ".$cours->getProf()->getPrenom();?>
        	</td>
        </tr>
        <?php 
	    }
        ?>
	</tbody>
</table>