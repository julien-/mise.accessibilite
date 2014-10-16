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
        <tr class="titre">
            <th class="center-text">Cours</th>
            <th class="center-text">Enseignant</th>
            <th class="center-text">Progression</th>
        </tr>
    </thead>
    <?php
    foreach ($listeCours as $cours)
    {
    ?>
    <tbody>
        <tr>
            <!--Titre du cours-->
            <td class="autre_colonne">
                <a href="index.php?section=evolution&id_cours=<?php echo $cours->getCours()->getId();?>">
                	<?php echo $cours->getCours()->getLibelle(); ?>
                </a>
            </td>
            <!--Nom du professeur-->
            <td class="autre_colonne">
                <?php                	
                    echo $cours->getCours()->getProf()->getNom() . ' ' . $cours->getCours()->getProf()->getPrenom(); 
                ?>
            </td> 
            <!--Avancement-->
            <td class="autre_colonne">
                 <?php
                    $progression = $daoAvancement->getByCoursEtudiant($cours->getCours()->getId(), $_SESSION["currentUser"]->getId());
                    if ($progression <= 25)
                        $color = '#FF6633';
                    else if ($progression > 25 && $progression <= 50)
                        $color = '#FFCC33';
                    else
                        $color = '#99FF33';
                 ?>
                <div style="float: left; border: 1px solid black; width: 79%; height: 20px;">
                    <div style="height: 100%; background-color: <?php echo $color; ?>; width: <?php echo $progression; ?>%;">&nbsp;</div>
                </div>
                <div style="float: left; width: 20%;">
                	<?php echo $progression; ?> %
                </div>
            </td>
        </tr>
    </tbody>
        <?php } ?>
</table>
<?php
} 
?>
