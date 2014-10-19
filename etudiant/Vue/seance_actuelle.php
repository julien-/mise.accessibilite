<?php 
foreach($listeThemes as $theme)
{
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-th-list"></i> <?php echo $theme->getTitre();?>
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<table class="table table-striped table-bordered">
				<thead>
				<tr class="titre">
				<th class="center-text">Exercice</th>
				<th class="center-text">Fait</th>
				<th class="center-text">Compris</th>
				<th class="center-text">Assimile</th>
				</tr>
				</thead>
				<?php
				$listeAvancement = $daoAvancement->getTabBySeanceThemeEtudiant($_GET["id_seance"], $theme->getId(), $_SESSION["currentUser"]->getId());
				foreach ($listeAvancement as $avancement)
				{
				?>
			    <tbody>
			        <tr>
			            <!--Titre de l'exercice-->
			            <td class="autre_colonne">
			                <?php echo $avancement['exercice']['titre']; ?>
			            </td> 
			            <!--Fait-->
			            <td class="autre_colonne">
			            	<i class="<?php if($avancement['fait'] >= 25) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			            <!--Compris-->
			            <td class="autre_colonne">
			                 <i class="<?php if($avancement['compris'] >= 25) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			            <!--Assimile-->
			            <td class="autre_colonne">
			                 <i class="<?php if($avancement['assimile'] >= 50) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			        </tr>
			    </tbody>
				<?php 
				} 
				?>
			</table>
		</div>
	</div>
</div>
<?php 
}
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-comment"></i> Remarques sur cette séance
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<?php 
				if($remarque)
					echo $remarque->getRemarque();
				else 
					echo "Aucune remarque";
			?>
		</div>
	</div>
</div>
