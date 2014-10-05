<?php

if(isset($_GET['id_cours']))
    $id_cours = $_GET['id_cours'];

if (isset($_POST["valider"])) 
{
    $cle = htmlspecialchars($_POST['cle']); 
    
    $rq_cle = mysql_query("SELECT id_cle FROM cours WHERE id_cours = ".$id_cours."");
    if ($rq_cle === FALSE) {
        die(mysql_error());
    }
    
    $id_cle= mysql_fetch_assoc($rq_cle);
    
    $rq2_cle = mysql_query("SELECT valeur_cle FROM cle WHERE id_cle = ".$id_cle['id_cle']."");
    if ($rq2_cle === FALSE) {
        die(mysql_error());
    }
    
    $valeur_cle= mysql_fetch_assoc($rq2_cle);
    
    if ($valeur_cle['valeur_cle'] == md5($cle))
    {
        mysql_query("INSERT INTO inscription VALUES (".$id_cours.",".$_SESSION['id'].")") or die (mysql_error());
        
        $rq_idexos = mysql_query("SELECT e.id_exo AS IdExo
                                 FROM exercice e, theme t 
                                 WHERE e.id_theme = t.id_theme
                                 AND t.id_cours = ".$id_cours) or die (mysql_error());
        
        
        while($row = mysql_fetch_assoc($rq_idexos))
        {
            echo $row['IdExo'];
            mysql_query("INSERT INTO avancement VALUES (".$_SESSION['id'].",".$row['IdExo'].",0,0,0,0)") or die (mysql_error());
        }
        
        $_SESSION["notif_msg"] = '<div class="ok">Inscription au cours réussie</div>';
        header('location: '.$_SERVER['PHP_SELF']);
    }
    else
    {
        $_SESSION["notif_msg"] = '<div class="erreur">Clé invalide</div>';
        header('location: '.$_SERVER['PHP_SELF']."?section=".$_GET['section']."&id_cours=".$id_cours);
    }
        
}

$rq_cours = mysql_query("SELECT libelle_cours, id_prof FROM cours WHERE id_cours = ".$id_cours."");
if ($rq_cours === FALSE) {
    die(mysql_error());
}

$cours= mysql_fetch_assoc($rq_cours);

?>
<h1 class="titre_page_school">S'Inscrire &aacute; un cours</h1>
<h2 class="titre_h2_school"><?php echo $cours['libelle_cours'];?></h2>
<?php

$rq_prof = mysql_query("SELECT nom_etu, prenom_etu FROM etudiant WHERE id_etu = ".$cours['id_prof']."");
if ($rq_prof=== FALSE) {
    die(mysql_error());
}

$prof= mysql_fetch_assoc($rq_prof);

?>
<p class="note">La cl&eacute; d'inscription est fournie par l'enseignant</p>
<form method="post" action="<?php echo "index.php?section=inscription_cours&id_cours=".$id_cours; ?>">
    <table align="center" class="formulaire">
        <tr>
            <td align="right" class="libelle_champ">
                Enseignant : 
            </td>
            <td>
                <?php echo $prof['nom_etu']." ".$prof['prenom_etu'];?>
            </td>
        </tr>
        <tr>
            <td class="libelle_champ" align="right">
                Clé d'inscription :
            </td>
            <td>
                <input type="text" name="cle" />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <br/>
                <input class="button_1" type="submit" value="S'inscrire" name="valider">
            </td>
        </tr>
    </table>
</form>


