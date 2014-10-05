<h1 class="titre_page_school">Mes Cours</h1>
<?php

$consignes = "
                    <br/>
                    Sur cette page s'affiche la liste des cours dans lesquels vous êtes inscrit, le nom de l'enseignant ainsi qu'une barre de progression qui correspond à votre avancement dans cette matière.
                    <br/>
                    <br/>
                    <b>Cliquez</b> sur le nom d'un cours pour <b>visualiser</b> ou <b>mettre à jour</b> votre avancement dans celui-ci<b>    
                    <br/>
             ";

$rq_idcours = sqlQuery('SELECT nom_etu, prenom_etu, cours.id_cours, libelle_cours, id_prof FROM cours, etudiant, inscription WHERE id_prof = etudiant.id_etu AND inscription.id_etu = ' . $_SESSION['id'] . ' AND inscription.id_cours = cours.id_cours');

$nbcours = mysql_num_rows($rq_idcours);
if($nbcours == 0)
{
    ?>
    <p class="oldschool">Vous n'êtes inscrit à aucun cours</p>
    <?php
}
else
{
?>

<table class="tableau">
    <thead>
        <tr>
            <th>Cours</th>
            <th>Enseignant</th>
            <th>Progression</th>
        </tr>
    </thead>
    <?php
    while($cours = mysql_fetch_array($rq_idcours))
    {
    ?>
    <tbody>
        <tr>
            <!--Titre du cours-->
            <td class="autre_colonne">
                <font class="nom_cours">
                <?php echo "<a href=\"index.php?section=evolution&id_cours=".$cours['id_cours']."\">".$cours['libelle_cours']."</a>"; ?>
                </font>
            </td>
            <!--Nom du professeur-->
            <td class="autre_colonne">
                <font class="nom_prof">
                <?php
                    echo $cours['prenom_etu'] . ' ' . $cours['nom_etu']; 
                ?>
                </font>
            </td> 
            <!--Avancement-->
            <td class="autre_colonne">
                 <?php
                    $infosProgression = progressionEtudiant($_SESSION['id'], $cours['id_cours'], -1);
                    $progression = (($infosProgression['progression']/($infosProgression['total'])) * 100);
                    if ($progression <= 25)
                        $color = '#FF6633';
                    else if ($progression > 25 && $progression <= 50)
                        $color = '#FFCC33';
                    else
                        $color = '#99FF33';
                 ?>
                <span style="color: #339; font-size: 18px; font-weight: bold; font-family: 'please_write_me_a_songmedium';"><?php echo (int) number_format($progression, 2); ?>%</span>
                <div style="margin: auto; border: 1px solid black; width: 300px; height: 25px;">
                    <div style="height: 100%; background-color: <?php echo $color; ?>; width: <?php echo $progression; ?>%;">&nbsp;</div>
                </div>
            </td>
        </tr>
    </tbody>
        <?php } ?>
</table>
<?php
} 
?>
