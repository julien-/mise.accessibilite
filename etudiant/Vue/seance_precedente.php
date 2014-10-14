<table class="table table-striped table-bordered">
	<thead>
	<tr class="titre">
	<th class="center-text">Thème</th>
	<th class="center-text">Exercice</th>
	<th class="center-text">Fait</th>
	<th class="center-text">Compris</th>
	<th class="center-text">Assimile</th>
	</tr>
	</thead>
	<?php
	foreach ($listeAvancement as $avancement)
	{
	?>
    <tbody>
        <tr>
            <!--Titre du theme-->
            <td class="autre_colonne">
                <?php echo $avancement['exercice']['theme']['titre']; ?>
            </td>
            <!--Titre de l'exercice-->
            <td class="autre_colonne">
                <?php echo $avancement['exercice']['titre']; ?>
            </td> 
            <!--Fait-->
            <td class="autre_colonne">
                 <?php echo $avancement['fait']; ?>
            </td>
            <!--Compris-->
            <td class="autre_colonne">
                 <?php echo $avancement['compris']; ?>
            </td>
            <!--Assimile-->
            <td class="autre_colonne">
                 <?php echo $avancement['assimile']; ?>
            </td>
        </tr>
    </tbody>
	<?php 
	} 
	?>
</table>

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
