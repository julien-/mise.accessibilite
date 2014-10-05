<h1 class="titre_page_school">Mes Cours</h1>
<?php

$consignes = "
                    <center><font style=\"font-weight: bold; font-size: 25px; font-family: 'please_write_me_a_songmedium';\">Infos</font></center>
                    <br/>
                    Sur cette page s'affiche la liste des cours dans lesquels vous êtes inscrit ainsi que le nom de l'enseignant.
                    <br/>
                    <br/>
                    <b>Cliquez</b> sur le nom d'un cours pour <b>visualiser</b> ou <b>mettre à jour</b> votre avancement dans celui-ci<b>    
                    <br/>
             ";

$rq_idcours = mysql_query("SELECT id_cours FROM inscription WHERE id_etu = ".$_SESSION['id']."");
if ($rq_idcours === FALSE) {
    die(mysql_error());
}

$nbcours = mysql_num_rows($rq_idcours);
if($nbcours == 0)
    echo "Vous n'êtes inscrit à aucun cours";
else
{
?>

<table class="tableau_etu">
        <?php 
        while ($id_cours = mysql_fetch_array($rq_idcours)) {
            $rq_libellecours = mysql_query("SELECT libelle_cours, id_prof FROM cours WHERE id_cours = ".$id_cours['id_cours']."");
            if ($rq_libellecours === FALSE) {
                die(mysql_error());
            }
            $cours= mysql_fetch_assoc($rq_libellecours);
            ?>
            <tr cellpadding=15>
                <td width="50px">
                    <img src="../images/logo_matiere2.png"/>
                </td>
                <!--Titre du cours-->
                <td>
                    <?php echo "<a href=\"index.php?section=evolution&id_cours=".$id_cours['id_cours']."\">".$cours['libelle_cours']."</a>"; ?>
                </td>
                <?php 
                        $rq_nomprof = mysql_query("SELECT nom_etu, prenom_etu FROM etudiant WHERE id_etu = ".$cours['id_prof']."");
                        if ($rq_nomprof === FALSE) {
                            die(mysql_error());
                        }
                        $prof = mysql_fetch_assoc($rq_nomprof);
                ?>
                <!--Nom du professeur-->
                <td valign=bottom>
                    <font class="nom_prof">
                    <?php
                        echo $prof['nom_etu']." ".$prof['prenom_etu']; 
                    ?>
                    </font>
                </td> 
                <!--Avancement-->
                <td>
                     <?php
                        $rq_avancement_global = mysql_query("SELECT ((SUM(fait) + SUM(compris) + SUM(assimile))/ (COUNT(a.id_exo)) ) AS avanc
                                    FROM " . $tb_avancement . " a, " . $tb_theme . " t, " . $tb_exercice . " e
                                    WHERE a.id_etu= " . $_SESSION['id'] . "
                                    AND   a.id_exo = e.id_exo
                                    AND e.id_theme = t. id_theme
                                    AND t.id_cours = " .$id_cours['id_cours']) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
    
                        $mon_avancement_global = mysql_fetch_assoc($rq_avancement_global);
                        
                        $avancement_int = (int) $mon_avancement_global['avanc'];
                        
                     ?>
                    <progress background-color="red" style="margin-left: 100px;" value="<?php echo $avancement_int;?>" max="100"></progress>
                    <font class="nom_prof">
                    <?php echo $avancement_int."%"; ?>
                    </font>
                </td>
            </tr>
        <?php } ?>
</table>
<?php
} 
?>
