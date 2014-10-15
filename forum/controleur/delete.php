<?php
include_once('../../lib/autoload.inc.php');
session_start();

$dao = new DAOAvancement(null);
$db = DBFactory::getMysqlConnexionStandard();

include('../../fonctions.php');
if ($_SESSION['currentUser']->getAdmin())
{
    if (isset($_GET['type']) && isset($_GET['id']))
    {
        $type = $_GET['type'];
        $id = $_GET['id'];
        
        if ($type == 'categorie')
        {
            deleteCategorie ($id);
        }
        else if ($type == 'sujet')
        {
            deleteSujet ($id);
        }
        else if ($type == 'post')
        {
            deletePost ($id);        
        }
    }
    if (isset($_GET['id_sujet_a_lire']))
    {
        $sujet = '&id_sujet_a_lire='.$_GET['id_sujet_a_lire'];
    }
    else
        $sujet = "";
    
    if (isset($_GET['categorie']))
    {
        $categorie = '&categorie='.$_GET['categorie'];
    }
    else
        $categorie = "";
    ?>
    <script>
    	document.location.replace('<?php echo $_SESSION['referrer']?>');
    </script>
    <?php
}

