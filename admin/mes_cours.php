
<?php
include_once "../../sql/connexion_mysql.php";
include_once "../../config.php";
include_once "../../fonctions.php";
//permet de garder la bonne selection dans la liste déroulante des thèmes
if (isset($_POST["id_cours_sel"])) {
    session_start();
    $_SESSION["id_cours_sel"] = $_POST["id_cours_sel"];
}

if (isset($_POST["id_them_sel"])) {
    session_start();
    $_SESSION["id_them_sel"] = $_POST["id_them_sel"];
}

//affichage des notifications
if (isset($_SESSION["notif_msg"]) && !(empty($_SESSION["notif_msg"]))) {
    echo ($_SESSION["notif_msg"]);
    $_SESSION["notif_msg"] = "";
}
//
//
//if (isset($_SESSION["notif_erreur"]) && $_SESSION["notif_erreur"] == "1") {
//    $affich_erreur = "";
//    $_SESSION["notif_ok"] = "0";
//}
//else
//    $affich_erreur = "hidden";
//COURS
$rq_cours = mysql_query("SELECT " . $tb_cours . ".id_cours, libelle_cours, id_cle, count(DISTINCT(id_theme)) AS nb_theme , count(DISTINCT(" . $tb_inscription . ".id_etu)) AS nb_inscrits " .
        "FROM " . $tb_cours . " " .
        "LEFT JOIN " . $tb_theme . " ON " . $tb_theme . ".id_cours = " . $tb_cours . ".id_cours " .
        "LEFT JOIN " . $tb_inscription . " ON " . $tb_inscription . ".id_cours = " . $tb_cours . ".id_cours " .
        "WHERE " . $tb_cours . ".id_prof = " . $_SESSION["id"] . " " .
        "GROUP BY " . $tb_cours . ".id_cours");

if ($rq_cours === FALSE) {
    die(mysql_error());
}


//THEMES
$rq_themes = mysql_query("SELECT " . $tb_theme . ".id_theme, titre_theme, count(id_exo) AS nb_exo , " . $tb_theme . ".id_cours " .
        "FROM " . $tb_theme . " " .
        "LEFT JOIN " . $tb_exercice . " ON " . $tb_exercice . ".id_theme = " . $tb_theme . ".id_theme " .
        "LEFT JOIN " . $tb_cours . " ON " . $tb_cours . ".id_cours = " . $tb_theme . ".id_cours " .
        "WHERE " . $tb_cours . ".id_prof = " . $_SESSION["id"] . " " .
        "GROUP BY " . $tb_theme . ".id_theme;");
if ($rq_themes === FALSE) {
    die(mysql_error());
}
//EXERCICES
$rq_exos = mysql_query("SELECT e.id_exo, e.num_exo, e.titre_exo, e.id_theme,  t.id_cours, count(f.id_fichier) AS nb_fichiers ".
//        SELECT *, count(f.id_fichier) AS nb_fichiers " .
        "FROM " . $tb_exercice . " e " .
        "LEFT JOIN " . $tb_fichiers . " f ON e.id_exo = f.id_exo " .
        "JOIN " . $tb_cours . " c " .
        "LEFT JOIN " . $tb_theme . " t ON t.id_cours = c.id_cours " .
        "WHERE e.id_theme = t.id_theme " .
        "AND id_prof = " . $_SESSION["id"] . " " .
        "GROUP BY e.id_exo " .
        "ORDER BY t.id_theme, num_exo");
if ($rq_exos === FALSE) {
    die(mysql_error());
}
//mysql_close($db);
?>
<!--<h1 class="titre_page_school">Mes cours</h1>-->
<ul class="conteneur-onglets">
    <li class="inactif onglet" id="affiche-contenu-1" onclick="Affiche('1');">Gestion de mes cours</li>
    <li class="inactif onglet" id="affiche-contenu-2" onclick="Affiche('2');">Recherche d'étudiant</li>
</ul>


<!--DIV Sous onglet 1-->
<div class="contenu" id="contenu_1">

    <!--#############
            COURS
        #############-->
    <h2 class="titre_scolaire">Gestion de mes cours</h2>

    <table class="tableau" name ="tab_cours" id="tab_cours">
        <thead>
            <tr class="titre">
                <th>Titre du cours</th>
                <th>Inscrits</th>
                <th>Th&egrave;mes</th>
                <th>Détails</th>
                <th>Modifier la clé du cours</th>
                <th>Forum</th>
                <th>Supprimer</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            while ($mon_cours = mysql_fetch_array($rq_cours)) {
                ?>
                <tr>
                    <!--Titre du cours-->
                    <td class="prem_colonne">
                        <form method="post" action="rq_mes_cours.php?section=mes_cours&majtitrecours=<?php echo($mon_cours['id_cours']); ?>">
                            <input type="text" name="newtitrecours" id="newtitrecours" size="26" value="<?php echo $mon_cours['libelle_cours']; ?>" title="Saisir un nouveau titre de cours" class="inputValDefaut">
                            <!--submit-->
                            <input type='image' id='img_edit_titrecours' name ='img_edit_titrecours' src='../../<?php echo($dossierimg . "admin/flat_edit.png"); ?>' alt="Valider le nouveau titre saisi" title="Valider le nouveau titre saisi"/>
                        </form>
                    </td>
                    <!--Nombre d'inscris-->
                    <td class="petite_colonne">
                        <?php echo($mon_cours["nb_inscrits"]); ?>
                    </td>
                    <!--Nombre de thèmes-->
                    <td class="petite_colonne">
                        <?php echo($mon_cours["nb_theme"]); ?>
                    </td>
                    <!--Détails-->
                    <td class="petite_colonne">
                        <a href="index.php?section=progression_globale&c=<?php echo $mon_cours['id_cours']; ?>">
                            <img src="../../images/loupe.png"/>
                        </a>
                    </td>
                    <!--Modifier la clé du cours-->
                    <td class="prem_colonne">
                        <form method="post" action="rq_mes_cours.php?section=mes_cours&majclecours=<?php echo($mon_cours['id_cle']); ?>">
                            <input type="text" name="newclecours" id="newclecours" size="26" value="" title="Saisir une nouvelle clé" class="inputValDefaut">
                            <!--submit-->
                            <input type='image' id='img_edit_clecours' name ='img_edit_clecours' src='../<?php echo($dossierimg . "admin/flat_edit.png"); ?>' alt="Modifier la clé du cours" title="Modifier la clé du cours"/>
                        </form>
                    </td>
                    <!-- FORUM -->
                    <td class="petite_colonne">
                        <a href="index.php?section=index_forum&id_cours=<?php echo($mon_cours['id_cours']); ?>"><img width="24" src='../<?php echo($dossierimg . "admin/forum.png"); ?>' alt="Forum" title="Forum"/></a> 
                    </td>
                    <!-- SUPPRESSION COURS   -->
                    <td class="petite_colonne">
                        <form id="form_sup_cours" method="post" action="rq_mes_cours.php?section=mes_cours&supcours=<?php echo $mon_cours['id_cours']; ?>">
                            <!--submit-->
                            <input type='image' class='img_sup_cours' name ='img_sup_cours' src='../<?php echo($dossierimg . "admin/flat_supp.png"); ?>' alt="Supprimer le cours, ses thèmes, exercices et avancements" title="Supprimer le cours, ses thèmes, exercices et avancements"/>
                        </form>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!--#########################   NOUVEAU COURS   #########################-->
    <div id="msg_cours"></div>
    <form method="post" action="rq_mes_cours.php?section=mes_cours&addcours">
        <table class="tableau-libre">
            <tr>
                <th colspan="3">Ajouter un cours</th>
            </tr>
            <tr>
                <td><input type="text" name="titrecours" id="titrecours" size="26" value="" title="Taper un titre de cours" class="inputValDefaut"></td>
                <td><input type="text" name="clecours" id="clecours" size="26" value="" title="Taper une clé unique pour ce cours" class="inputValDefaut"></td>
                <!--submit-->
                <td><input type="image" name="soumis1" id="soumis1" src='../<?php echo($dossierimg . "admin/flat_ajou.png"); ?>'  alt='Ajouter un cours' title='Ajouter un cours'/> </td>
            </tr>

        </table>
    </form>

    <!--##############
            THEMES
        ##############-->
    <div id='themes'>
        <h2 class="titre_scolaire">
            Gestion des th&egrave;mes du cours de 
            <!--######################### LISTE DEROULANTE DES COURS #########################-->

            <select name="liste_cours" id="liste_cours" class="listederoulh2"><?php
                //remet le curseur au début (car rq_cours déjà parcouru avant)
                mysql_data_seek($rq_cours, 0);
                while ($mon_cours = mysql_fetch_array($rq_cours)) {
                    ?>                                                                      
                    <option value="<?php echo($mon_cours["id_cours"]); ?>"<?php
                    //affiche selected pour l'option choisie avant de lancer la reqete      && ($_SESSION['id_cours_sel'] == $mon_cours["id_cours"])

                    if (isset($_SESSION['id_cours_sel']) && ($_SESSION['id_cours_sel'] == $mon_cours["id_cours"]))
                        echo 'selected="selected"';
                    ?>><?php echo (strtoupperFr($mon_cours["libelle_cours"])); ?></option><?php
                        }
                        ?>
            </select>
        </h2>
        <div id="msg_themes"></div>
        <!--######################### TABLEAU DES THEMES #########################-->
        <table id="tab_themes" name="tab_themes" class="tableau">
            <thead>
                <tr class="titre">  <!--class pour rester toujours visible-->
                    <th>Titre du thème</th>
                    <th>Nombre d'exercices</th>
                    <th>Supprimer un thème</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mon_theme = mysql_fetch_array($rq_themes)) {
                    ?>
                    <tr class="trTHEMES_<?php echo($mon_theme["id_cours"]); ?>" >   <!--Pour savoir s'il faut afficher ou pas-->
                        <!--Titre du thème-->
                        <td class="prem_colonne">
                            <form method="post" action="rq_mes_cours.php?section=mes_cours&majtheme=<?php echo($mon_theme['id_theme']); ?>">
                                <input type="text" name="titremajtheme" id="titremajtheme" size="26" value="<?php echo $mon_theme['titre_theme']; ?>" title="Taper un titre de thème" class="inputValDefaut">
                                <!--submit-->
                                <input type='image' id='img_edit_theme' name ='img_edit_theme' src='../<?php echo($dossierimg . "admin/flat_edit.png"); ?>' alt="Valider le nouveau titre saisi" title="Valider le nouveau titre saisi"/>
                            </form>
                        </td>
                        <!-- Nombre d'exercices : Utile pour garder le numéro du prochain exercice à créer-->
                        <td class="petite_colonne" id="nbexo_idtheme<?php echo ($mon_theme["id_theme"] ); ?>">
                            <?php echo($mon_theme["nb_exo"]); ?>
                        </td>
                        <!--SUPPRESSION THEME-->
                        <td class="petite_colonne">
                            <form method="post" action="rq_mes_cours.php?section=mes_cours&suptheme=<?php echo $mon_theme['id_theme']; ?>">
                                <!--submit-->
                                <input type='image' class='img_sup_theme' name ='img_sup_theme' src='../<?php echo($dossierimg . "admin/flat_supp.png"); ?>' alt="Supprimer le thème, ses exercices et avancements" title="Supprimer le thème, ses exercices et avancements"/>
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--#########################
                NOUVEAU THEME 
            #########################-->
        <form method="post" action="rq_mes_cours.php?section=mes_cours&addtheme">
            <table border="1" class="tableau-libre">
                <tr>
                    <th colspan="3">Ajouter un thème</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="titretheme" id="titretheme"size="26" value="" title="Taper un titre de thème" class="inputValDefaut"/>
                        <input hidden="hidden" name="id_cours_sel" id="id_cours_sel"/>
                    </td>
                    <!--submit-->
                    <td><input type="image" name="soumis2" id="soumis2" src='../<?php echo($dossierimg . "admin/flat_ajou.png"); ?>'  alt='Ajouter un thème' title='Ajouter un thème'/> </td>
                </tr>

            </table>
        </form>
    </div>
    <div id="exo">
        <h2 class="titre_scolaire">Gestion des exercices du th&egrave;me <?php ?>
            <!--###########################
                LISTE DEROULANTE DES THEMES
                #########################-->

            <select name="liste_themes" id="liste_themes" class="listederoulh2"><?php
                //remet le curseur au début (car rq_themes déjà parcouru avant)
                mysql_data_seek($rq_themes, 0);
                while ($mon_theme = mysql_fetch_array($rq_themes)) {
                    ?>                                                                      
                    <option value="<?php echo($mon_theme["id_theme"]); ?>"<?php
                    //affiche selected pour l'option choisie avant de lancer la reqete      && ($_SESSION['id_them_sel'] == $mon_theme["id_theme"])

                    if (isset($_SESSION['id_them_sel']) && ($_SESSION['id_them_sel'] == $mon_theme["id_theme"]))
                        echo 'selected="selected"';
                    ?>
                            class="theme_du_cours_<?php echo($mon_theme["id_cours"]); ?>"
                            ><?php echo (strtoupper($mon_theme["titre_theme"])); ?></option><?php
                        }
                        ?>
            </select>
        </h2>
        <!--#########################
                LISTE DES EXERCICES 
            #########################-->
        <div id="msg_exo"></div>
        <table id="tab_exo" name="tab_exo"class="tableau">
            <thead>
                <tr class="titre">
                    <th>N°</th>
                    <th>Titre actuel</th>
                    <th>Détails</th>
                    <th>Fichiers</th>
                    <th>Supprimer un exercice</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //parcours de la requete de tous les exos
                while ($mon_exo = mysql_fetch_assoc($rq_exos)) {
                    ?>
                    <tr class="trEXO_<?php echo($mon_exo["id_theme"]); ?>">
                        <!--Numéro d'exercice-->
                        <td class="petite_colonne">
                            <?php echo ($mon_exo["num_exo"]); ?>
                        </td>
                        <!--Titre de l'exercice-->
                        <td class="autre_colonne">
                            <form method="post" action="rq_mes_cours.php?section=mes_cours&majexo=<?php echo($mon_exo['id_exo']); ?>">
                                <!--TITRE-->
                                <input type="text" name="titremajexo" id="titremajexo" size="26" value="<?php echo ($mon_exo["titre_exo"]); ?>" title="Taper un titre d'exercice" class="inputValDefaut">
                                <!--submit-->
                                <input type="image" id="soumismajexo" src="../../../<?php echo($dossierimg . $dossieradmin . "flat_edit.png"); ?>" alt="Valider le nouveau titre saisi" title="Valider le nouveau titre saisi"/>
                            </form>
                        </td>
                        <!--Details-->
                        <td class="petite_colonne">
                            <a title ="Progression de l'exercice" href="index.php?section=details_exercice&c=<?php echo ($mon_exo['id_cours']); ?>&ex=<?php echo ($mon_exo["id_exo"]); ?>">
                                <img src="../../../images/loupe.png"/>
                            </a>
                        </td>
                        <!--3 Popup: Affichage des fichiers-->
                        <td class="petite_colonne">
                            <form method="post" name="gestion_fichiers" action="index.php?section=mes_cours&exo_sel=<?php echo ($mon_exo["id_exo"]); ?>">
                                <!--submit-->
                                <input type="image" id="soumisficexo" src="../../../<?php echo($dossierimg . $dossieradmin . "/fichiers.png"); ?>" alt="Gérer les fichiers de l'exercice" title="Gérer les fichiers de l'exercice"/>
                                ( <?php echo ($mon_exo["nb_fichiers"]); ?> )
                            </form>
                        </td>
                        <td class="petite_colonne">
                            <!--SUPPRESSION d'exo-->
                            <form method="post" action="rq_mes_cours.php?section=mes_cours&supexo=<?php echo ($mon_exo['id_exo']); ?>">
                                <!--Mémorise l'id du theme de l'exercice concerné-->
                                <input type="hidden"  id="idt_exo" name="idt_exo" value="<?php echo ($mon_exo['id_theme']); ?>" />
                                <!--submit-->
                                <input type="image" class="soumissupexo" src="../../../<?php echo($dossierimg . $dossieradmin . "flat_supp.png"); ?>" alt="Supprimer l'exercice" title="Supprimer l'exercice"/>
                            </form>
                        </td>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>

        <!--#########################
                NOUVEL EXERCICE 
            #########################-->
        <form method="post" action="rq_mes_cours.php?section=mes_cours&addexo">
            <table border="1" class="tableau-libre">
                <tr>
                    <th colspan="3">Ajouter un exerice</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="titre_exo" id="titre_exo"size="26" value="" title="Taper un titre d'exercice" class="inputValDefaut">
                        <input type="hidden" name="id_them_sel" id="id_them_sel"/>
                        <input type="hidden" name="nbmax_exo" id="nbmax_exo"/>
                    </td>
                    <td>
                        <!--sumbit (titre modifié dans le JS)-->
                        <input type="image" name="soumisajouexo" id="soumisajouexo" src="../../<?php echo($dossierimg . "admin/flat_ajou.png"); ?>" alt="Ajouter l'exercice" title="Ajouter l'exercice"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!--##############
    ###### POPUP #####
    ##################-->
    <input type="hidden" id="active_popup" class="topopup">
    <!--popup gestion des fichiers d'un exercice-->
    <div id="toPopup"> 

        <div class="close"></div>
        <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
        <div id="popup_content"> <!--your content start-->

            <?php
            if (isset($_GET["exo_sel"])) {
                include("fichiers_exo.php");
            }
            else
                echo("Aucun exercice séléctionné");
            ?>
        </div> <!--your content end-->

    </div> <!--toPopup end-->

    <div class="loader"></div>
    <div id="backgroundPopup"></div>
</div>

<!--DIV Sous onglet 2-->
<div class="contenu" id="contenu_2">
    <?php include('recherche.php'); ?>
</div>

<!--Gestion des sous-onglets-->
<?php
if (isset($_GET['r']))
    $Onglet_afficher = 2;
else
    $Onglet_afficher = 1;
?>
<script type="text/javascript">
        Affiche(<?php echo $Onglet_afficher; ?>);
</script>