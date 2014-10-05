<?php
include_once "../sql/connexion_mysql.php";
include_once "../config.php";
include_once "../fonctions.php";

session_start();

if (isset($_POST['submit_nouveau_bonus'])) {
        
    if(empty($_POST['titre_nouveau_bonus']) || empty($_POST['type']))
    {        
        $_SESSION["notif_msg"] = '<div class="erreur">Erreur création de bonus : Certains éléments manquent, veuillez recommencer</div>';
            
        header('location: index.php?section=enregistrer_progression&seance='.$_POST['seance'].'&id_cours='.$_POST['id_cours'].'&bonus='.$_POST['bonus']);
    }
    elseif(empty($_POST['Etudiant']))
    {
        $sql = 'INSERT INTO ' . $tb_bonus . ' (titre_bonus, type_bonus, id_theme) ' .
            'VALUES ( "' . $_POST['titre_nouveau_bonus'] . '", "' . $_POST['type'] . '", "' . $_POST['id_theme'] . '" );';
        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        //récupère l'autoincrement créé
        $id_bonus = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id_bonus_insere"));

        $sql = 'INSERT INTO ' . $tb_avancement_bonus . ' (id_etu, id_bonus, fait, suivi, id_seance) ' .
                    'VALUES ( ' . $_SESSION['id'] . ', ' . $id_bonus['id_bonus_insere'] . ', 1 , 1 , ' . $_POST['seance'] . ' );';
        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

        $_SESSION["notif_msg"] = '<div class="ok">Bonus créé avec succès...</div>';
        
        header('location: index.php?section=enregistrer_progression&seance='.$_POST['seance'].'&id_cours='.$_POST['id_cours']);
    }
    else
    {
        
        $sql = 'INSERT INTO ' . $tb_bonus . ' (titre_bonus, type_bonus, id_theme) ' .
                'VALUES ( "' . $_POST['titre_nouveau_bonus'] . '", "' . $_POST['type'] . '", "' . $_POST['id_theme'] . '" );';
        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        //récupère l'autoincrement créé
        $id_bonus = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id_bonus_insere"));

        $sql = 'INSERT INTO ' . $tb_avancement_bonus . ' (id_etu, id_bonus, fait, suivi, id_seance) ' .
                    'VALUES ( ' . $_SESSION['id'] . ', ' . $id_bonus['id_bonus_insere'] . ', 1 , 1 , ' . $_POST['seance'] . ' );';
        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

        foreach($_POST['Etudiant'] as $etu)
        {
            $sql = 'INSERT INTO ' . $tb_avancement_bonus . ' (id_etu, id_bonus, fait, suivi, id_seance) ' .
                    'VALUES ( ' . $etu . ', ' . $id_bonus['id_bonus_insere'] . ', 1 , 1 , ' . $_POST['seance'] . ' );';
            mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        }

        $_SESSION["notif_msg"] = '<div class="ok">Bonus créé avec succès...</div>';
        
        header('location: index.php?section=enregistrer_progression&seance='.$_POST['seance'].'&id_cours='.$_POST['id_cours']);
    }
}

?>