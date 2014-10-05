<?php

    include_once('../fonctions.php');

    $sql = ("SELECT a.id_etu, prenom_etu, nom_etu, SUM((fait+compris+assimile)) as score
    FROM avancement a, exercice e, etudiant et, theme t
    WHERE et.id_etu = a.id_etu
    AND a.id_exo = e.id_exo
    AND e.id_theme = t.id_theme
    AND t.id_cours = ".$id_cours."
    AND admin != 1
    GROUP BY et.id_etu
    ORDER BY SUM((fait+compris+assimile)) DESC
    ");

    $req_progression = mysql_query($sql) or die (mysql_error());
    $position = 0;
    ?>
    <link rel="stylesheet" href="../<?php echo $dossiercss; ?>tableau.css" />
    <h1 class="titre_page_school">Classement</h1><br/><br/>
    <center>
    <table class="tableau-libre">
        <thead>
            <th>Position</th>
            <th>Etudiant</th>
            <th>Points</th>
            <th>Profil</th>
        </thead>
        <tbody>
    <?php while($donnees = mysql_fetch_array($req_progression))
    {
        $position++;
        if ($donnees['id_etu'] == $_SESSION['id'])
            $colorer = ' style="color: #E98E8E"';
        else
            $colorer = '';
        ?>
            <tr>
                <td class="col_position" <?php echo $colorer; ?>><?php echo $position; ?></td>
                <td class="col_nom" <?php echo $colorer; ?>><?php echo 'Etudiant ' .  $donnees['id_etu'];?></td>
                <td class="col_points" <?php echo $colorer; ?>><?php echo $donnees['score']; ?></td>
                <td class="col_profil" <?php echo $colorer; ?>><a href="index.php?section=profil_etudiant&e=<?php echo $donnees['id_etu']; ?>"><img src="/images/profil.png" /></a></td>
            </tr>
    <?php } ?>
        </tbody>
    </table>
    </center>

