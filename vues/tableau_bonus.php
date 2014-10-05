<link rel="stylesheet" href="../<?php echo $dossiercss; ?>tableau.css" />
<?php
$_SESSION['referrer'] = current_page_url(); 
$enteteColonneTheme = "";
$sqlTheme = "";
$sqlEtudiant = "";
$enteteColonneEtudiant = "";
$afficherEtudiant = false;
$afficherTheme = false;
if (isset($_GET['d']))
{
    deleteBonus($_GET['d']);
}
if (isset($theme))
{
    $sqlTheme = " AND t.id_theme = " . $theme;
    $enteteColonneEtudiant = "<th>&Eacute;tudiant</th>";
    $afficherEtudiant = true;
}

if ($etudiant != -1)
{
    $sqlEtudiant = "AND e.id_etu = " . $etudiant . "";
    $enteteColonneTheme = "<th>Th&egrave;me</th>";
    $afficherTheme = true;
}

if ($sqlEtudiant != "" && $sqlTheme != "")
{
    $enteteColonneTheme = "";
    $enteteColonneEtudiant = "";
    $afficherEtudiant = false;
    $afficherTheme = false;
}

if ($sqlEtudiant == "" && $sqlTheme == "")
{
    $enteteColonneTheme = "<th>Th&egrave;me</th>";
    $enteteColonneEtudiant = "<th>&Eacute;tudiant</th>";
    $afficherTheme = true;
    $afficherEtudiant = true;
}

$sql =    "SELECT b.id_bonus, titre_bonus, type_bonus, titre_theme, t.id_theme as theme, nom_etu, prenom_etu, e.id_etu as etudiant "
        . "FROM etudiant e, bonus b, avancement_bonus ab, theme t, exercice ex "
        . "WHERE b.id_bonus = ab.id_bonus " 
        . "AND e.id_etu = ab.id_etu "
        . "AND t.id_theme = b.id_theme "
        . "AND t.id_cours = " . $cours . " "
        . $sqlEtudiant . " "
        . "AND fait=1 " 
        . $sqlTheme . 
        "  GROUP BY ab.id_bonus";


$reqBonus = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($reqBonus) > 0) 
{
    ?>
<table class="tableau">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Type</th>
            <th>Moyenne</th>
            <?php echo $enteteColonneEtudiant; ?>
            <?php echo $enteteColonneTheme; ?>
            <?php
            if ($_SESSION['admin'])
            {
                ?>
            <th>Supprimer</th>
                <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data = mysql_fetch_array($reqBonus)) {
            ?>
            <tr>
                <td class="prem_colonne">
                    <?php echo $data['titre_bonus']; ?>
                </td>
                <td class="autre_colonne">
                    <?php echo $data['type_bonus']; ?>
                </td>
                <td class="autre_colonne">
                    <?php
                    
                    $sql1 = "SELECT count(*) AS nbNotes, AVG(note) AS Moyenne
                            FROM avancement_bonus
                            WHERE id_bonus = " . $data['id_bonus'] . "
                            AND fait = 0 
                            AND suivi = 1";

                    $reqNote = mysql_query($sql1) or die(mysql_error());
                    
                    
                    
                    $note = mysql_fetch_array($reqNote);
                    
                    if ($note['nbNotes'] == 0)
                        echo "Aucune note";
                    else
                        echo round($note['Moyenne'],1)." / 5";
                    ?>
                </td>
                <?php if ($afficherEtudiant) 
                {
                    ?>  <td class="prem_colonne" align="center">
                            <a href="index.php?section=progression_etudiant&c=<?php echo $cours; ?>&e=<?php echo $data['etudiant']; ?>">
                                <?php echo $data['prenom_etu'] . ' ' . $data['nom_etu']; ?>
                            </a>
                        </td>
                    <?php
                }
                ?>
                <?php if ($afficherTheme) 
                {
                    ?>  <td class="autre_colonne">
                            <a href="index.php?section=progression_globale_exercices&c=<?php echo $cours; ?>&e=-1&theme=<?php echo $data['theme']; ?>">
                                <?php echo $data['titre_theme']; ?>
                            </a>
                        </td>
                    <?php
                }
                ?>
                <?php
                    if ($_SESSION['admin'])
                    {
                        ?>
                            <td class="autre_colonne">
                                <a href="delete_bonus.php?b=<?php echo $data['id_bonus']; ?>">
                                <img src="../images/admin/flat_supp.png" alt="Supprimer" title="Supprimer" />
                                </a>
                            </td>
                        <?php
                    }
                    ?>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php
}
else
{
    ?>
    <p class="oldschool">Pas de bonus</p>
    <?php
}
?>