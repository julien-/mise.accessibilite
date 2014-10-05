<?php
include_once('../fonctions.php');
$messagesParPage = 10;
if (!isset($_GET['page']))
    $p = 1;
else
    $p = $_GET['page'];
if (isset($_POST['valider']) || isset($_GET['keyword']))
{
    if (isset($_GET['keyword']))
        $keyword = $_GET['keyword'];
    else
        $keyword = $_POST['keyword'];
    
    
    $reqTotal = SQLQuery('SELECT * FROM etudiant WHERE nom_etu LIKE "%' . $keyword . '%" OR prenom_etu LIKE "%' . $keyword . '%" OR pseudo_etu LIKE "%' . $keyword . '%"');
    
    $reqRecherche = SQLQuery('SELECT * FROM etudiant WHERE nom_etu LIKE "%' . $keyword . '%" OR prenom_etu LIKE "%' . $keyword . '%" OR pseudo_etu LIKE "%' . $keyword . '%" LIMIT ' . (($p - 1)*$messagesParPage) . ',' . $messagesParPage);
    
    $nbPages = ceil(mysql_num_rows($reqTotal) / $messagesParPage);
    
}
if (isset($_GET['section']) && $_GET['section'] == 'recherche')
{
    $titre = "<h1 class=\"titre_page_school\">Mes &eacute;tudiants</h1>";
    $pRetour = "index.php?section=recherche";
}
else
{
    $titre = "<h2 class=\"titre_scolaire\">Recherche d'&eacute;tudiant</h2>";
    $pRetour = "index.php?r=1";
}
echo $titre;


?>

<form method="post" action="<?php echo $pRetour; ?>">
    <table class="formulaire" align="center">
        <tr>
            <td><span class='note'>Recherche par nom, pr&eacute;nom ou pseudo :</span></td>
            <td><input type="text" name="keyword" value="<?php if (isset($_POST['valider'])) echo $_POST['keyword']; ?>"/></td>
            <td>
                <input type="submit" class="button_1" value="Rechercher" name="valider">
            </td>
        </tr>
    </table>
</form>
<br/>
<?php
if (isset($_POST['valider']) || isset($_GET['keyword']))
{
    if (mysql_num_rows($reqRecherche) > 0)
    {
    ?>
    <table class="tableau">
        <thead>
            <tr>
                <th>
                    Nom
                </th>
                <th>
                    Pr&eacute;nom
                </th>
                <th>
                    Pseudo
                </th>
                <th>
                    D&eacute;tails
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row = mysql_fetch_array($reqRecherche))
            {
                ?>
            <tr>
                <td class="autre_colonne">
                    <?php echo $row['nom_etu']; ?>
                </td>
                <td class="autre_colonne">
                    <?php echo $row['prenom_etu']; ?>
                </td>
                <td class="autre_colonne">
                    <?php echo $row['pseudo_etu']; ?>
                </td>
                <td class="autre_colonne">
                    <a href="index.php?section=etudiant&e=<?php echo $row['id_etu']; ?>"><img title="D&eacute;tails" alt="D&eacute;tails" src="../images/loupe.png" /></a>
                </td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
        <p>
            <?php
            if ($nbPages > 1 && $p != 1)
            {
                ?>
                    <a href="index.php?section=recherche&keyword=<?php echo $keyword; ?>"><img width="40" src="../images/page_first.png" alt="Premi&egrave;re page" title="Premi&egrave;re page"/></a>
                    <a href="index.php?section=recherche&keyword=<?php echo $keyword; ?>&page=<?php echo $p - 1; ?>"><img width="40" src="../images/page_back.png" alt="Page pr&eacute;c&eacute;dente" title="Page pr&eacute;c&eacute;dente"/></a>
                <?php
            }
            if ($nbPages > 1 && $p != $nbPages)
            {
                ?>
                    <a href="index.php?section=recherche&keyword=<?php echo $keyword; ?>&page=<?php echo $p + 1; ?>"><img width="40" src="../images/page_next.png" alt="Page suivante" title="Page suivante"/></a>
                    <a href="index.php?section=recherche&keyword=<?php echo $keyword; ?>&page=<?php echo $nbPages; ?>"><img width="40" src="../images/page_last.png" alt="Derni&egrave;re page" title="Derni&egrave;re page"/></a>
                <?php
            }
            ?>
        </p>
    <?php
    }
    else
    {
    ?>
<p class="oldschool">Aucun r&eacute;sultat</p>
    <?php
    }
}


