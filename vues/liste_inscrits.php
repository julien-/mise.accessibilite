<table class="tableau">
    <thead>
        <tr>
            <th>
                Etudiant
            </th>
            <th>
                <?php   if ($exercice == -1)
                            echo 'Progression dans ce cours';
                        else
                            echo 'Progression de l\'exercice';
                ?>
            </th>
        </tr>
    </thead>
    <tbody>
<?php
$sql = 'SELECT * 
        FROM inscription i, etudiant e
        WHERE id_cours = ' . $cours . ' ' 
        . 'AND i.id_etu = e.id_etu';
        

$req_inscrits = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
while($donnees = mysql_fetch_array($req_inscrits))  // pour chaque th�me on va chercher les exos
{
    
    $infosProgression = progressionEtudiant($donnees['id_etu'], $cours, $exercice);
    if ($infosProgression['total'] != 0)
        $progression = (($infosProgression['progression']/($infosProgression['total'])) * 100);
    else
        $progression = 0;
    
    if ($progression <= 25)
        $color = '#FF6633';
    else if ($progression > 25 && $progression <= 75)
        $color = '#FFCC33';
    else
        $color = '#99FF33';
?>
        <tr>
            <td class="autre_colonne">
                <a href="index.php?section=progression_etudiant&c=<?php echo $cours; ?>&e=<?php echo $donnees['id_etu']; ?>"><?php echo $donnees['prenom_etu'] . ' ' . $donnees['nom_etu'];?></a>
            </td> 
            <td class="autre_colonne">
                                <span style="color: #339; font-size: 18px; font-weight: bold; font-family: 'please_write_me_a_songmedium';"><?php echo (int) number_format($progression, 2); ?>%</span>
                <div style="margin: auto; border: 1px solid black; width: 300px; height: 25px;">
                    <div style="height: 100%; background-color: <?php echo $color; ?>; width: <?php echo $progression; ?>%;">&nbsp;</div>
                </div>
            </td>
        <tr>          
<?php
}

?>
    </tbody>
</table>