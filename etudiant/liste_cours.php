<h1 class="titre_page_school">S'Inscrire à un cours</h1>

<?php

if(isset($_POST['valider']) && $_POST['valider'] != NULL) 
{
    $requete = htmlspecialchars($_POST['mot_cle']); 
    $rq_cours = mysql_query("SELECT nom_etu, prenom_etu, id_cours, libelle_cours, id_prof FROM cours, etudiant WHERE id_prof = id_etu AND libelle_cours LIKE '%$requete%'") or die (mysql_error());
    $nb_resultats = mysql_num_rows($rq_cours);
    if($nb_resultats == 0)
    {
            $rq_cours = mysql_query("SELECT nom_etu, prenom_etu, id_cours, libelle_cours, id_prof FROM cours, etudiant WHERE id_prof = id_etu AND etudiant.nom_etu LIKE '%$requete%'") or die (mysql_error());
            $nb_resultats = mysql_num_rows($rq_cours);
    }
}
else
{
    $rq_cours = mysql_query("SELECT nom_etu, prenom_etu, id_cours, libelle_cours, id_prof FROM cours, etudiant WHERE id_prof = id_etu") or die (mysql_error());
    $nb_resultats = mysql_num_rows($rq_cours);
}

?>
<br/>
<form method="post" action="<?php echo "index.php?section=liste_cours";?>">
    <span class='note'>Recherche par mot clé (Titre cours ou nom enseignant) :</span>
 <input type="text" name="mot_cle" />
 <input type="submit" class="button_1" value="Rechercher" name="valider">
</form>
<br/>

<?php
    if ($nb_resultats == 0)
        echo "Aucun résultat";
    else
    {
?>
<table class="tableau">
    <thead>
        <tr>
            <th>Titre du cours</th>
            <th>Enseignant</th>
            <th>Nombre d'inscrits</th>
            <th>Déjà Inscrit?</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($mon_cours = mysql_fetch_array($rq_cours)) {
            $rq_dejainscrit = mysql_query("SELECT * FROM inscription WHERE id_cours = ".$mon_cours['id_cours']." AND id_etu = ".$_SESSION['id']."");
            $inscrit = mysql_num_rows($rq_dejainscrit);
            ?>
            <tr>
                <!--Titre du cours-->
                <td class="autre_colonne">
                    <?php 
                        if($inscrit  == 0)
                            echo "<a href=\"index.php?section=inscription_cours&id_cours=".$mon_cours['id_cours']."\">".$mon_cours['libelle_cours']."</a>";
                        else
                            echo $mon_cours['libelle_cours'];
                    ?>
                </td>
                <!--Nom du professeur-->
                <td class="autre_colonne">
                    <?php
                        echo $mon_cours['nom_etu']." ".$mon_cours['prenom_etu']; 
                    ?>
                </td>
                <!--Nombre d'inscrits-->
                <td class="autre_colonne">
                    <?php
                        $rq_nbeleves = mysql_query("SELECT count(*) AS NbEleves FROM inscription WHERE id_cours = ".$mon_cours['id_cours']."");
                        if ($rq_nbeleves === FALSE) {
                            die(mysql_error());
                        }
                        $nbeleves = mysql_fetch_assoc($rq_nbeleves);
                        echo $nbeleves['NbEleves']; 
                    ?>                    
                </td>
                <!--Déjà inscrit?-->
                <td class="autre_colonne">
                    <?php
                        if($inscrit  == 0)
                            echo '<img src="../images/no.png"/>';
                        else
                            echo '<img src="../images/yes.png"/>';                      
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php
    }
?>