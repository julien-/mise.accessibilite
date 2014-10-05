<link rel="stylesheet" href="../<?php echo $dossiercss; ?>tableau.css" />

<?php
include_once "../sql/connexion_mysql.php";
include_once "../config.php";


//permet de garder la bonne selection dans la liste déroulante des cours
if (isset($_POST["id_cours_sel"])) {
    session_start();
    $_SESSION["id_cours_sel"] = $_POST["id_cours_sel"];
}
//affichage des notifications
if (isset($_SESSION["notif_msg"]) && !(empty($_SESSION["notif_msg"]))) {
    echo ($_SESSION["notif_msg"]);
    $_SESSION["notif_msg"] = "";
}



//COURS
$rq_cours = mysql_query("SELECT " . $tb_cours . ".id_cours, libelle_cours, couleur_calendar, id_cle, count(id_theme) AS nb_theme " .
        "FROM " . $tb_cours . " " .
        "LEFT JOIN " . $tb_theme . " ON " . $tb_theme . ".id_cours = " . $tb_cours . ".id_cours " .
        "WHERE " . $tb_cours . ".id_prof = " . $_SESSION["id"] . " " .
        "GROUP BY " . $tb_cours . ".id_cours");

if ($rq_cours === FALSE) {
    die(mysql_error());
}

//SEANCES
$rq_seances = mysql_query("SELECT * " .
        "FROM " . $tb_seance . " " .
        "ORDER BY date_seance;");
if ($rq_seances === FALSE) {
    die(mysql_error());
}
//mysql_close($db);
?>
<h1 class="titre_page_school">Mes s&eacute;ances</h1>









<div id="seance" name="seance">
    <input type="hidden" name="id_cours_sel" id="id_cours_sel"/>
    <h2 class="titre_scolaire">GESTION DE SEANCES DU COURS DE
        <!--######################### LISTE DEROULANTE DES COURS #########################-->

        <select name="liste_cours" id="liste_cours" class="listederoulh2"><?php
//remet le curseur au début (car rq_cours déjà parcouru avant)
            mysql_data_seek($rq_cours, 0);
            while ($mon_cours = mysql_fetch_array($rq_cours)) {
                //affectation de $_SESSION['id_cours_sel'] pour pas qu'il soit vide (et le récupérer pour le chooser color)
                if (!isset($_SESSION['id_cours_sel']))
                    $_SESSION['id_cours_sel'] = $mon_cours["id_cours"];
                ?>                                                                      
                <option value="<?php echo($mon_cours["id_cours"]); ?>"<?php
                //affiche selected pour l'option choisie avant de lancer la reqete      && ($_SESSION['id_cours_sel'] == $mon_cours["id_cours"])

                if (isset($_SESSION['id_cours_sel']) && ($_SESSION['id_cours_sel'] == $mon_cours["id_cours"]))
                    echo 'selected="selected"';
                ?> style="background-color: #<?php echo($mon_cours["couleur_calendar"]); ?>;"><?php echo (strtoupper($mon_cours["libelle_cours"])); ?></option><?php
                    }
                    ?>
        </select><?php
        mysql_data_seek($rq_cours, 0);
        while ($mon_cours = mysql_fetch_array($rq_cours)) {
            ?><form id="form_couleur_cours_<?php echo($mon_cours["id_cours"]); ?>" class="form_choix_couleur" method="post" action="rq_seance.php?section=seance&couleur_cours">
                <input class="color" value="<?php echo($mon_cours["couleur_calendar"]); ?>" id="choix_couleur_calendar" name="choix_couleur_calendar" title="Choisissez une couleur associée au cours" />
            </form>
            <?php
        }
        ?>
    </h2>
    

    <div id="msg_seance"></div>
    <table class="tableau" id="tab_seance">
        <thead>
            <tr class="titre">  <!--class pour rester toujours visible-->
                <th>Date des seances prévues</th>
                <th>Modifier la date des seances</th>
                <th>Supprimer des seances</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($ma_seance = mysql_fetch_array($rq_seances)) {
                ?>

                <tr class="trSEANCE_<?php echo($ma_seance["id_cours"]); ?>" >   <!--Pour savoir s'il faut afficher ou pas-->
                    <td class="autre_colonne"><?php echo date('d/m/Y', strtotime($ma_seance["date_seance"])); ?><!--Date de la séance--></td>
                    <!--########################
                          MISE A JOUR seance
                        ########################-->
                    <td class="autre_colonne">
                        <form method="post" action="rq_seance.php?section=seance&majseance=<?php echo($ma_seance['id_seance']); ?>">
                            <!-- Saisie de la date -->
                            <input type="date" name="dateseancemaj" id="dateseancemaj"/>
                            <!--submit-->
                            <input type="image" name="soumismajexo" id="soumismajexo" src="../<?php echo($dossierimg . "admin/flat_edit.png"); ?>" alt="Modifier le titre del'exercice" title="Modifier le titre de l'exercice"/>
                        </form>
                    </td>
                    <!--#########################
                           SUPPRESSION SEANCE 
                       #########################-->
                    <td class="autre_colonne">
                        <form method="post" action="rq_seance.php?section=seance&supseance=<?php echo $ma_seance['id_seance']; ?>">
                            <!--submit-->
                            <input type='image' class='img_sup_seance' name ='img_sup_seance' src='../<?php echo($dossierimg . "admin/flat_supp.png"); ?>' alt="Supprimer la séance" title="Supprimer la séance"/>
                        </form>
                    </td>
                </tr>
<?php } ?>
        </tbody>
    </table>
    <!--#########################
            NOUVELLE SEANCE
        #########################-->
    <form method="post" action="rq_seance.php?section=seance&addseance">
        <table border="1">
            <tr>
                <!-- Saisie de la date -->
                <td><input type="date" name="dateseanceadd" id="dateseanceadd"/></td>
                <!--submit-->
                <td><input type="image" name="soumisadd" id="soumisadd" src='../<?php echo($dossierimg . "admin/flat_ajou.png"); ?>'  alt='Ajouter une séance' title='Ajouter une séance'/></td>
            </tr>
        </table>
    </form>


    <div id="calendrier" name="calendrier">
        <?php
        include("calendrier/t_calendrier_affich.php");
        include("calendrier/p_calendrier_affich.php");
        ?>
    </div>
</div>

<script type="text/javascript" src="../js/jscolor/jscolor.js"></script>