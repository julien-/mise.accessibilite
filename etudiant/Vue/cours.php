<a class="btn btn-primary" href="index.php?section=inscription_cours">S'inscrire à un cours</a>
<br/>
<br/>
<?php

$consignes = "
                    <br/>
                    Sur cette page s'affiche la liste des cours dans lesquels vous êtes inscrit, le nom de l'enseignant ainsi qu'une barre de progression qui correspond à votre avancement dans cette matière.
                    <br/>
                    <br/>
                    <b>Cliquez</b> sur le nom d'un cours pour <b>visualiser</b> ou <b>mettre à jour</b> votre avancement dans celui-ci<b>    
                    <br/>
             ";

$nbcours = count($listeCours);
if($nbcours == 0)
{
    ?>
    <p class="oldschool">Vous n'êtes inscrit à aucun cours</p>
    <?php
}
else
{
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="col-xs-3 col-sm-3 center-text">Cours</th>
            <th class="col-xs-3 col-sm-3 center-text">Enseignant</th>
            <th class="col-xs-6 col-sm-6 center-text">Progression</th>
        </tr>
    </thead>
    <tbody>
    	<?php
	    foreach ($listeCours as $cours)
	    {
	    ?>
        <tr>
            <!--Titre du cours-->
            <td class="col-xs-3 col-sm-3">
                <a href="index.php?section=evolution&id_cours=<?php echo $cours->getCours()->getId();?>">
                	<?php echo $cours->getCours()->getLibelle(); ?>
                </a>
            </td>
            <!--Nom du professeur-->
            <td class="col-xs-3 col-sm-3">
                <?php                	
                    echo $cours->getCours()->getProf()->getNom() . ' ' . $cours->getCours()->getProf()->getPrenom(); 
                ?>
            </td> 
            <!--Avancement-->
            <td class="col-xs-6 col-sm-6">
                 <?php
                    $progression = $daoAvancement->getByCoursEtudiant($cours->getCours()->getId(), $_SESSION['currentUser']->getId());
                    if ($progression <= 25)
                        $color = '#FF6633';
                    else if ($progression > 25 && $progression <= 50)
                        $color = '#FFCC33';
                    else
                        $color = '#99FF33';
                 ?>  
                 
                 <div class="progress progress-striped progress-borders">
					<div class="progress-bar progress-bar-primary vert-align" style="color: black; background-color: <?php echo Outils::colorChart($progression); ?>; width: <?php echo $progression; ?>%;">
                    	<?php echo $progression; ?> %
                    </div>
				</div>
                               
                <?php /*
                <div style="float: left; border: 1px solid black; width: 79%; height: 20px;">
                    <div style="height: 100%; background-color: <?php echo $color; ?>; width: <?php echo $progression; ?>%;">&nbsp;</div>
                </div>
                <div style="float: left; width: 20%;">
                	<?php echo $progression; ?> %
                </div>
                */?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
        
</table>
<?php
} 
?>
