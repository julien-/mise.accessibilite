<?php
include_once('../fonctions.php');
$etudiant = exists('e', 'etudiant', 'id_etu');

if ($etudiant != false)
{
    $infosEtudiant = getStudent($etudiant);
    $reqInscriptions = SQLQuery('SELECT * FROM cours, inscription WHERE id_etu = ' . $etudiant . ' AND cours.id_cours = inscription.id_cours AND id_prof = ' . $_SESSION['id']);
    echo getFilArianne(array('index.php?section=recherche' => 'Mes étudiants', 'final' => $infosEtudiant['prenom'] . ' ' . $infosEtudiant['nom']));
    ?>
        <h1 class="titre_page_school"><?php echo $infosEtudiant['prenom'] . ' ' . $infosEtudiant['nom']; ?></h1>
        <h2 class="titre_scolaire">Informations sur l'&eacute;tudiant</h2>
        <label class='libelle_champ' for="mail">Adresse mail</label><a href="mailto:<?php echo $infosEtudiant['mail']; ?>" id="mail"><?php echo $infosEtudiant['mail']; ?></a>
        <br/>
        <label class='libelle_champ' for="nbcours">Nombre de cours suivis</label><span id="nbcours"><?php echo mysql_num_rows($reqInscriptions); ?></span>
        <h2 class="titre_scolaire">Cours suivis</h2>
        <table class='tableau'>
            <thead>
                <tr>
                    <th>
                        Cours
                    </th>
                    <th>
                        Progression
                    </th>
                    <th>
                        D&eacute;tails pour ce cours
                    </th>
                </tr>
            </thead>
            <tbody>
    <?php
        
        while($row = mysql_fetch_array($reqInscriptions))
        {
                $cours = $row['id_cours'];
                $infosProgression = progressionEtudiant($etudiant, $cours, -1);
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
                    <td class='autre_colonne'>
                        <a href='index.php?section=progression_globale&c=<?php echo $cours; ?>'><?php echo $row['libelle_cours']; ?></a>
                    </td>
                    <td class="autre_colonne">
                        <span style="color: #339; font-size: 18px; font-weight: bold; font-family: 'please_write_me_a_songmedium';"><?php echo (int) number_format($progression, 2); ?>%</span>
                        <div style="margin: auto; border: 1px solid black; width: 300px; height: 25px;">
                            <div style="height: 100%; background-color: <?php echo $color; ?>; width: <?php echo $progression; ?>%;">&nbsp;</div>
                        </div>
                    </td>
                    <td class="autre_colonne">
                        <a href='index.php?section=progression_etudiant&e=<?php echo $etudiant; ?>&c=<?php echo $cours; ?>'><img title="D&eacute;tails" alt="D&eacute;tails" src="../images/loupe.png" /></a>
                    </td>
                </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
        <?php
}

