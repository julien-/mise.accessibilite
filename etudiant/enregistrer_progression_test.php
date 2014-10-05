<link rel="stylesheet" href="../css/onglets.css" />
<?php

include_once('../sql/connexion_mysql.php');
include_once('../config.php');
include_once('../fonctions.php');
$now = date("Y-m-d");
$messageOeuf = $messageEvo = '';

$consignes .= " 
                <br/>
                Une <b>liste déroulante</b> est à votre disposition pour <b>naviguer dans les séances</b> concérnées. Par defaut, vous vous situez sur la séance ouverte.
                <br/>
                <br/>
                C'est ici que vous saisirez votre progression, en <b>cochant les cases</b> correspondantes. N'oubliez pas de cliquer sur le bouton <b>Enregistrer</b>.
                <br/> 
                La note des bonus est sur 5: 
                <br/>
                1 = pas très bien
                <br/>
                5 = super j'adore c'est génial

    ";
    
    
//#################
    //CREATION DE BONUS
    //#################
    if (isset($_GET["bonus"])) {
        $sql = "SELECT * FROM " . $tb_theme . " WHERE id_theme = " . $_GET["bonus"];
        $rq_theme = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . mysql_error());
        $mon_theme = mysql_fetch_assoc($rq_theme);
        ?>
        <table>
            <thead>
                <tr>
                    <th colspan="3">
            <p style="font-weight: bold;">Création d'un bonus <?php echo($mon_theme['titre_theme']); ?> pas encore existant<br/>
                <span style='color: grey; font-weight: lighter;font-style: italic;'>Attention, seuls les administrateurs pourront supprimer le type de bonus créé. Vérifiez bien qu'il n'existe pas pour ce thème</span></p>
        </th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="autre_colonne">
                    <form method="POST" action="enregistrer_progression_test.php?seance=<?php echo($_GET['seance']);?>">
                        <input type="text" title="Titre du bonus" name="titre_nouveau_bonus" id="titre_nouveau_bonus" class="inputValDefaut"/>
                        <br/>
                        <input type="checkbox" name="type" value="Exposé"/> Exposé
                        <input type="checkbox" name="type" value="Exercice"/> Exercice
                        <br/>
                        <input type="hidden" name="id_theme" value="<?php echo($_GET['bonus']); ?>" />
                        <input type="submit" name="submit_nouveau_bonus" value="Créer le bonus"/>
                    </form>
            </tr>
        </tbody>
        </table>
        <br/><br/>
        <?php
    }
    if (isset($_POST['submit_nouveau_bonus'])) {
        //BONUS
        session_start();
        $sql = 'INSERT INTO ' . $tb_bonus . ' (titre_bonus, type_bonus, id_theme) ' .
                'VALUES ( "' . $_POST['titre_nouveau_bonus'] . '", "' . $_POST['type'] . '", "' . $_POST['id_theme'] . '" );';
        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        //récupère l'autoincrement créé
        $id_bonus = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id_bonus_insere"));
        $sql = 'INSERT INTO ' . $tb_avancement_bonus . ' (id_etu, id_bonus, fait, suivi, id_seance) ' .
                    'VALUES ( ' . $_SESSION['id'] . ', ' . $id_bonus['id_bonus_insere'] . ', 1 , 1 , ' . $_GET['seance'] . ' );';
        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        
        
            
        $_SESSION["notif_msg"] = '<div class="ok">Requête éffectuée avec succès...</div>';
        // on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
        header('Location: index.php?section=enregistrer_progression_test&seance=' . $_GET["seance"]);
    }

//permet de garder la bonne selection dans la liste déroulante des thèmes
if (isset($_GET["seance"])) {
    $_SESSION["id_seance_sel"] = $_GET["seance"];
}
$exercicesDispo = true;
$seanceCourante = exists('seance', 'seance', 'id_seance');
if ($seanceCourante != false && rightCourse($seanceCourante, $id_cours) && ($exercicesDispo = hasExercices($id_cours))) {   //SEANCE SPECIFIQUE
    //  ####################
    //  SUBMIT du formulaire
    //  ####################
    if (isset($_POST['soumettre'])) {
        //  #########
        //  REMARQUES
        //  #########
        if ($_POST['remarque'] != '')
        {
            //Existe-il déjà des remarques ?
            $sql = "SELECT COUNT(*) FROM remarque_seances WHERE id_seance = " . $_GET["seance"] . " AND id_etu = " . $_SESSION['id'] . "";
            $req = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
            //INSERT ou UPDATE de remarques
            if (mysql_result($req, 0) != 0) {
                $sql = "UPDATE remarque_seances SET remarque = \"" . $_POST['remarque'] . "\" WHERE id_seance = " . $_GET['seance'] . " AND id_etu = " . $_SESSION['id'];
                mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
            } else {
                $sql = "INSERT INTO remarque_seances (id_seance, id_etu, remarque)
                        VALUES
                    (" . $_GET['seance'] . "," . $_SESSION['id'] . ",'" . $_POST['remarque'] . "')";
                mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
            }
        }


        //  #########
        //  EXERCICES
        //  #########
        //Parcours de tous les exercices
        $sql = "SELECT id_exo FROM exercice";
        $reqExos = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        while ($donnees = mysql_fetch_array($reqExos)) {
            // pour chaque exercice 
            // on enregistre les nouvelles informations de progression
            if (isset($_POST['fait' . $donnees['id_exo']])) {
                $fait = 25;
            } else {
                $fait = 0;
            }

            if (isset($_POST['compris' . $donnees['id_exo']])) {
                $compris = 25;
            } else {
                $compris = 0;
            }

            if (isset($_POST['assimile' . $donnees['id_exo']])) {
                $assimile = 50;
            } else {
                $assimile = 0;
            }
            echo $fait.$compris.$assimile;
            if ($fait != 0 || $compris != 0 || $assimile != 0)
            {
                
                //Exercices de l'étudiant dans la table AVANCEMENT
                $sql = "SELECT fait, compris, assimile FROM avancement WHERE id_etu = " . $_SESSION['id'] . " AND id_exo = " . $donnees['id_exo'] . "";
                $req = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                $resultatReq = mysql_fetch_array($req);

                if ($resultatReq['fait'] == 0 && $fait == 25)
                {
                    $messageOeuf = "Un oeuf vient d'éclore sur la page d'accueil !!";
                    $sql = "SELECT id_pokemon FROM pokemon WHERE id_pokemon NOT IN (SELECT id_pokemon FROM assignations_pokemon WHERE id_etu = " . $_SESSION['id'] . ") AND pokemon_base = 1";
                    $reqPoke = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                    $ok = false;
                    $pokemonChoisi = -1;

                        $random = rand(0, mysql_num_rows($reqPoke));
                        $i = 0;
                        while(($i <= $random) && ($pokemon = mysql_fetch_assoc($reqPoke)))
                        {
                            $i++;
                            $pokemonChoisi = $pokemon['id_pokemon'];
                        }


                    $sql = "INSERT INTO assignations_pokemon VALUES (''," . $_SESSION['id'] . ", ". $pokemonChoisi.", " . $donnees['id_exo'] .", 1)";
                    mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());



                }

                if (($resultatReq['compris'] == 0 && $compris == 25))
                {
                    $messageEvo = "On dirait qu'un Pokémon a évolué sur la page d'accueil !!";

                    $sql = "SELECT id_evolution FROM assignations_pokemon a, evolutions e WHERE a.id_pokemon = e.id_pokemon AND id_exo = ".$donnees['id_exo']. " AND id_etu = " . $_SESSION['id'];
                    $reqPokeExo = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                    $pokeExo = mysql_fetch_array($reqPokeExo);

                    $sql = "UPDATE assignations_pokemon SET poke_courant = 0 WHERE id_etu =" . $_SESSION['id'] . " AND id_exo =" . $donnees['id_exo'];
                    mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

                    $sql = "INSERT INTO assignations_pokemon VALUES (''," . $_SESSION['id'] . ", ". $pokeExo['id_evolution'].", " . $donnees['id_exo'] .",1)";
                    mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

                    if ($resultatReq['assimile'] == 0 && $assimile == 50)
                    {
                        $sql = "SELECT id_evolution FROM assignations_pokemon a, evolutions e WHERE a.id_pokemon = e.id_pokemon AND poke_courant = 1 AND id_exo = ".$donnees['id_exo'] . " AND id_etu = " . $_SESSION['id'];
                        $reqPokeExo = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                        $pokeExo = mysql_fetch_array($reqPokeExo);

                        $sql = "UPDATE assignations_pokemon SET poke_courant = 0 WHERE id_etu =" . $_SESSION['id'] . " AND id_exo =" . $donnees['id_exo'];
                        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

                        $sql = "INSERT INTO assignations_pokemon VALUES (''," . $_SESSION['id'] . ", ". $pokeExo['id_evolution'].", " . $donnees['id_exo'] .", 1)";
                        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                    }
                }
                else
                    if ($resultatReq['assimile'] == 0 && $assimile == 50)
                    {
                        $messageEvo = "On dirait qu'un Pokémon a évolué sur la page d'accueil !!";
                        $sql = "SELECT id_evolution FROM assignations_pokemon a, evolutions e WHERE a.id_pokemon = e.id_pokemon AND poke_courant = 1 AND id_exo = ".$donnees['id_exo'] . " AND id_etu = " . $_SESSION['id'];
                        $reqPokeExo = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                        $pokeExo = mysql_fetch_array($reqPokeExo);

                        $sql = "UPDATE assignations_pokemon SET poke_courant = 0 WHERE id_etu =" . $_SESSION['id'] . " AND id_exo =" . $donnees['id_exo'];
                        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

                        $sql = "INSERT INTO assignations_pokemon VALUES (''," . $_SESSION['id'] . ", ". $pokeExo['id_evolution'].", " . $donnees['id_exo'] .", 1)";
                        mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                    }
                    $sql = "INSERT INTO avancement (id_etu, id_exo, fait, compris, assimile, id_seance)
                            VALUES
                        (" . $_SESSION['id'] . "," . $donnees['id_exo'] . ",$fait,$compris,$assimile," . $_GET['seance'] . ")";
                    mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
            }
        }//fin boucle de chaque exercice

        /* ###########
         * ## BONUS ##
         * ###########
         */
        //Parcours de tous les bonus
        $sql = "SELECT * FROM " . $tb_bonus;
        $reqBonus = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        while ($donnees = mysql_fetch_array($reqBonus)) {
            // pour chaque bonus 
            // on enregistre les nouvelles informations de progression
            if (isset($_POST['bonus_suivi' . $donnees['id_bonus']]))
            {
                $bonus_suivi = 1;
            }
            else
                $bonus_suivi = 0;

            if ($_POST['note'.$donnees['id_bonus']] != -1)
            {
                $note = $_POST['note'.$donnees['id_bonus']];
            }
            else
                $note = 'NULL';
            
            $sql = "SELECT * FROM avancement_bonus WHERE id_etu =" . $_SESSION['id'] . " AND id_bonus=" . $donnees['id_bonus'];
            $reqAvancementBonus = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
            if (mysql_num_rows($reqAvancementBonus) > 0)
                mysql_query("UPDATE avancement_bonus SET suivi=".$bonus_suivi.", note=".$note." WHERE id_etu =" . $_SESSION['id'] . " AND id_bonus=" . $donnees['id_bonus']) or die (mysql_error());
            else
                mysql_query("INSERT INTO avancement_bonus VALUES (". $_SESSION['id'].",".$donnees['id_bonus'].",0,".$bonus_suivi.",NULL,'".$note."'," . $_GET['seance'].")") or die (mysql_error());
        }//fin boucle de chaque bonus

        /* #################
         * ## REDIRECTION ##
         * #################
         */
        $_SESSION["notif_msg"] = '<div class="ok">Requête éffectuée avec succès...</div>';
        // on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
    }   //FIN SUBMIT
    //1- Liste déroulante de toutes les SEANCES
    $rq_seances = mysql_query("SELECT * FROM " . $tb_seance . " WHERE id_cours = " . $id_cours . " ORDER BY date_seance ASC;") or die('Erreur SQL !<br>' . mysql_error());
    //2-Requete pour le titre
    $sql = 'SELECT * FROM ' . $tb_seance . ' WHERE id_seance = ' . $_GET['seance'];
    $req = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
    $ma_seance_actuelle = mysql_fetch_assoc($req);

    //Necessaire pour savoir si la seance doit être bloquée ou pas
    $apresactuelle_avantsuivante = -2;
    $seance_avant = $seance_apres = "";
    ?>
    <h1 id="titre_enregistrer">Mise à jour de ma séance N° <?php echo($_GET['seance'] . " du "); ?> 

        <!--########################
        LISTE DEROULANTE DES SEANCES
        #########################-->
        <select name = "liste_seances" id = "liste_seances">
            <!--<option value="">Toutes</option>-->
            <?php while ($ma_seance = mysql_fetch_assoc($rq_seances)) {
                ?>
                <option value="<?php echo($ma_seance["id_seance"]); ?>"
                <?php
                if (isset($_SESSION['id_seance_sel']) && ($_SESSION['id_seance_sel'] == $ma_seance["id_seance"]))
                    echo 'selected="selected"';
                ?>>
                    <?php echo (transformerDate($ma_seance["date_seance"]) ); ?></option>
                <?php
                //Stocker la séance avant et après NOW
                //pour pour gérer les autorisations de modification
                if ($ma_seance["date_seance"] <= $ma_seance_actuelle["date_seance"]) {
                    //avant la ACTUELLE ou pendant
                    $seance_avant = $ma_seance["date_seance"];
                    $apresactuelle_avantsuivante = -1; //marque 1er passage
                }
                if (($ma_seance["date_seance"] > $ma_seance_actuelle["date_seance"]) &&
                        ($apresactuelle_avantsuivante == -1)) {
                    //après la ACTUELLE (sa suivante seulement grace au -1)
                    $seance_apres = $ma_seance["date_seance"];
                    $apresactuelle_avantsuivante = check_in_range($seance_avant, $seance_apres, $now);
                }
            }
            ?>
        </select>
    </h1>
    <p class="bravo"> <?php echo $messageOeuf; ?> </p>
    <p class="bravo"> <?php echo $messageEvo; ?> </p>
    <!--#########
        AIDE
    ##########-->
    <?php
    if (isset($_GET["aide_exercice"])) {
        $sql = 'SELECT nom_etu,prenom_etu,mail_etu, etudiant.id_etu FROM etudiant,avancement WHERE avancement.fait=25 AND avancement.compris=25 AND avancement.assimile=50 AND etudiant.id_etu = avancement.id_etu AND admin != 1 AND avancement.id_exo=' . $_GET['aide_exercice'];

        $req = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        ?>
        <center>
            <table id="tableau2">
                <thead>
                    <tr>
                        <th colspan="3">
                            <?php echo "<p style=\"font-weight: bold;\">Etudiants qui ont validé l'exercice</p>"; ?>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">
                            Nom
                        </th>
                        <th scope="col">
                            Prénom
                        </th>
                        <th scope="col">
                            Demander de l'aide
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysql_fetch_array($req)) {
                        if ($data['nom_etu'] != "Galmiche")
                        echo "<tr>
                       <td class=\"prem_colonne\">
                            <center>
                                " . $data['nom_etu'] . "
                            </center>
                       </td>
                       <td class=\"prem_colonne\">
                            <center>
                                " . $data['prenom_etu'] . "
                            </center>
                       </td>
                       <td class=\"prem_colonne\">
                            <center>
                                " . '<a href="index.php?section=envoyer&aide=' . $_GET["aide_exercice"] . '&p='.$data['id_etu'].'"><img src="../images/help.png" title="Demander de l\'aide" alt="Aide"/></a>' . "
                            </center>
                       </td>
                  </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </center>
        <br/>
        <br/>
        <?php
    }   //FIN AIDE
    
    //FERMER séance si :
    //- Pas encore ouverte ( $apresactuelle_avantsuivante != 0)
    //- Pas séance actuelle (!=1)
    //- Pas séance precedente(!=1)
    if ( ($ma_seance_actuelle["date_seance"] > $now) || ($apresactuelle_avantsuivante != -1) ) {
        ?>
        <p class="oldschool">Séance fermée</p>
        <?php
    } else {
        //4-Liste de tous les THEMES
        $sql = 'SELECT *
            FROM ' . $tb_theme . ' 
            WHERE id_cours = ' . $id_cours;
        $req = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
//PARCOURS DE TOUS LES THEMES
        while ($mon_theme = mysql_fetch_assoc($req)) {
            // 6-Liste de tous les EXERCICES du thème
            $sql = 'SELECT * ' .
                    'FROM ' . $tb_exercice . ' ' .
                    'WHERE id_theme = ' . $mon_theme['id_theme'] . ' ' .
                    'ORDER BY num_exo';
            $rq_exo = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

            if (mysql_num_rows($rq_exo) > 0) {//si le thème parcouru contient des exercices, on les affiche
                
                ?>
                <div id="tableau_saisie_progression" name="tableau_saisie_progression">
                    <!--##############
                    TABLEAU FORMULAIRE
                    ##########-->
                    <form method="post" id="form_progres" name="form_progres" action="index.php?section=enregistrer_progression_test&seance=<?php echo($ma_seance_actuelle['id_seance']); ?>&id_cours=<?php echo $id_cours; ?>">
                        <!--Exercices-->

                        <table class="tab_enreg_prog" class="<?php echo(strtolower($mon_theme['titre_theme'])); ?>">
                            <thead>
                                <tr>
                                    <th colspan="6" style="background-color: white;"><h1 class="<?php echo(strtolower($mon_theme['titre_theme'])); ?>"><?php echo(strtoupper("Exercices de " . $mon_theme['titre_theme'])); ?></h1></th>
                            </tr>
                            <tr >
                                <th class="top_tableau" scope="col">Titre</th>
                <!--                            <th scope="col">Avancement</th>-->
                                <th class="top_tableau" scope="col">Aide</th>
                                <th class="top_tableau" scope="col">Fait</th>
                                <th class="top_tableau" scope="col">Compris</th>
                                <th class="top_tableau" scope="col"><span data-tip="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;verarbeiten">Assimilé</th>
                                <th class="top_tableau" scope="col">Documents</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                // PARCOURS DE TOUS LES EXERCICES DU THEME
                                while ($mon_exo = mysql_fetch_assoc($rq_exo)) { // pour chaque exercice 
                                    // 7- AVANCEMENT de l'exerice durant d'AUTRES séances
                                    $sql = 'SELECT id_theme, num_exo, fait, compris, assimile ' .
                                            'FROM ' . $tb_avancement . ' a , ' . $tb_exercice . ' e ' .
                                            'WHERE a.id_exo = e.id_exo ' .
                                            'AND a.id_exo = ' . $mon_exo['id_exo'] . ' ' .
                                            'AND id_etu = ' . $_SESSION['id'] . ' ' .
                                            'AND NOT id_seance = ' . $_GET['seance'];
                                    $rq_avancement_autre_seance = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                                    $avancement_exo_autre_seance = mysql_fetch_assoc($rq_avancement_autre_seance);
                                    //Exercice déjà fait
                                    if (mysql_num_rows($rq_avancement_autre_seance) > 0) {
                                        echo "428";
                                        $icone_fait = ($avancement_exo_autre_seance['fait'] > 0 ? '<input type="checkbox" style="display: none" name="fait' . $mon_exo['id_exo'] . '" id="fait_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="fait" value="' . $mon_exo['id_exo'] . '" /> <img title="Médaille de Bronze obtenue précédement" src="../images/bronze.png"/>' : '<input type="checkbox" name="fait' . $mon_exo['id_exo'] . '" id="fait_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="fait" value="' . $mon_exo['id_exo'] . '" />');
                                        $icone_compris = ($avancement_exo_autre_seance['compris'] > 0 ? '<input type="checkbox" style="display: none" name="compris' . $mon_exo['id_exo'] . '" id="compris_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="compris" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille d\'Argent obtenue précédement" src="../images/argent.png"/>' : '<input type="checkbox" name="compris' . $mon_exo['id_exo'] . '" id="compris_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="compris" value="' . $mon_exo['id_exo'] . '" />');
                                        $icone_assimile = ($avancement_exo_autre_seance['assimile'] > 0 ? '<input type="checkbox" style="display: none" name="assimile' . $mon_exo['id_exo'] . '" id="assimile_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="assimile" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille d\'Or obtenue précédement" src="../images/or.png"/>' : '<input type="checkbox" name="assimile' . $mon_exo['id_exo'] . '" id="assimile_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="assimile" value="' . $mon_exo['id_exo'] . '"  />');
                                        $exo_complet = ($avancement_exo_autre_seance['fait'] > 0 && $avancement_exo_autre_seance['compris'] > 0 && $avancement_exo_autre_seance['assimile'] > 0) ? 1 : 0;
                                    } else {
                                        //pas encore fait
                                        // 8- AVANCEMENT de l'exerice durant la séance actuelle
                                        $sql = 'SELECT id_theme, num_exo, SUM(fait) as fait, SUM(compris) as compris, SUM(assimile) as assimile ' .
                                                'FROM ' . $tb_avancement . ' a , ' . $tb_exercice . ' e ' .
                                                'WHERE a.id_exo = e.id_exo ' .
                                                'AND a.id_exo = ' . $mon_exo['id_exo'] . ' ' .
                                                'AND id_etu = ' . $_SESSION['id'] . ' ' .
                                                'AND id_seance = ' . $_GET['seance'];
        
                                        $rq_avancement_seance = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                                        $avancement_exo = mysql_fetch_assoc($rq_avancement_seance);
                                        $exo_complet = ($avancement_exo['fait'] > 0 && $avancement_exo['compris'] > 0 && $avancement_exo['assimile'] > 0) ? 1 : 0;

                                        //####################################################
                                        //Bloquer la possibilité de cocher des séances passées
                                        //####################################################
                                        //Si la séance est passée
                                        if ($ma_seance_actuelle['date_seance'] < $now) {
                                            //ACTIVE si rien entre (dernière séance)
                                            if ($apresactuelle_avantsuivante) {
                                                echo "453";
                                                $icone_fait = ($avancement_exo['fait'] == 0 ? '<input type="checkbox" name="fait' . $mon_exo['id_exo'] . '" id="fait_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="fait" value="' . $mon_exo['id_exo'] . '" />' : '<input type="checkbox" style="display: none" name="fait' . $mon_exo['id_exo'] . '" id="fait_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="fait" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille de Bronze" src="../images/bronze.png"/>');
                                                $icone_compris = ($avancement_exo['compris'] == 0 ? '<input type="checkbox" name="compris' . $mon_exo['id_exo'] . '" id="compris_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="compris" value="' . $mon_exo['id_exo'] . '" />' : '<input type="checkbox" style="display: none" name="compris' . $mon_exo['id_exo'] . '" id="compris_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="compris" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille d\'Argent" src="../images/argent.png"/>');
                                                $icone_assimile = ($avancement_exo['assimile'] == 0 ? '<input type="checkbox" name="assimile' . $mon_exo['id_exo'] . '" id="assimile_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="assimile" value="' . $mon_exo['id_exo'] . '"  />' : '<input type="checkbox" style="display: none" name="assimile' . $mon_exo['id_exo'] . '" id="assimile_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="assimile" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille d\'Or" src="../images/or.png"/>');
                                            } else {
                                                echo "458";
                                                //BLOQUEE quand il y a des séances entre NOW et sa date
                                                $icone_fait = ($avancement_exo['fait'] == 0 ? '' : '<input type="checkbox" style="display: none" name="fait' . $mon_exo['id_exo'] . '" id="fait_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="fait" value="' . $mon_exo['id_exo'] . '" /> <img title="Médaille de Bronze" src="../images/bronze.png"/>');
                                                $icone_compris = ($avancement_exo['compris'] == 0 ? '' : '<input type="checkbox" style="display: none" name="compris' . $mon_exo['id_exo'] . '" id="compris_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="compris" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille d\'Argent" src="../images/argent.png"/>');
                                                $icone_assimile = ($avancement_exo['assimile'] == 0 ? '' : '<input type="checkbox" style="display: none" name="assimile' . $mon_exo['id_exo'] . '" id="assimile_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="assimile" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille d\'Or" src="../images/or.png"/>');
                                            }
                                        }
                                        //Si la séance est aujourd'hui: TOUT OUVRIR
                                        if ($ma_seance_actuelle['date_seance'] == $now) {
                                            echo "429";
                                            $icone_fait = ($avancement_exo['fait'] == 0 ? '<input type="checkbox" name="fait' . $mon_exo['id_exo'] . '" id="fait_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="fait" value="' . $mon_exo['id_exo'] . '" />' : '<input type="checkbox" style="display: none" name="fait' . $mon_exo['id_exo'] . '" class="fait" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille de Bronze" src="../images/bronze.png"/>');
                                            $icone_compris = ($avancement_exo['compris'] == 0 ? '<input type="checkbox" name="compris' . $mon_exo['id_exo'] . '" id="compris_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="compris" value="' . $mon_exo['id_exo'] . '" />' : '<input type="checkbox" style="display: none" name="compris' . $mon_exo['id_exo'] . '" class="compris" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille d\'Argent" src="../images/argent.png"/>');
                                            $icone_assimile = ($avancement_exo['assimile'] == 0 ? '<input type="checkbox" name="assimile' . $mon_exo['id_exo'] . '" id="assimile_' . $mon_exo['id_theme'] . '_' . $mon_exo['num_exo'] . '" class="assimile" value="' . $mon_exo['id_exo'] . '"  />' : '<input type="checkbox" style="display: none" name="assimile' . $mon_exo['id_exo'] . '" class="assimile" value="' . $mon_exo['id_exo'] . '"  /> <img title="Médaille d\'Or" src="../images/or.png"/>');
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td class="prem_colonne"><?php echo($mon_exo['num_exo'] . ": " . $mon_exo['titre_exo']); ?></td>
                                        <!--<td class="autre_colonne"><?php // echo( $exo_complet ? "Validé" : "Non Validé");                 ?></td>-->
                                        <td class="autre_colonne"><?php echo '<a href="' . $_SERVER["PHP_SELF"] . '?section=enregistrer_progression_test&seance=' . $_GET["seance"] . '&aide_exercice=' . $mon_exo["id_exo"] . '"><img src="../images/point.png"/ title="Je demande de l\'aide !"></a>'; ?></td>
                                        <td class="autre_colonne"><?php echo($icone_fait); ?></td>
                                        <td class="autre_colonne"><?php echo($icone_compris); ?></td>
                                        <td class="autre_colonne"><?php echo($icone_assimile); ?></td>
                                        <td class="autre_colonne"><p class="inactif onglet_without_borders" id="affiche-contenu-<?php echo$mon_exo['id_exo']; ?>" onclick="AfficheDocuments('<?php echo $mon_exo['id_exo']; ?>');"><img title="Documents pour cet exercice" src="../images/document.png"/></p></td>
                                    </tr>
                                    <tr class="contenu" id="contenu_<?php echo $mon_exo['id_exo']; ?>">
                                        <td>
                                            <ul>
                                            <?php   
                                                
                                                $reqFichiers = sqlQuery("SELECT * FROM fichiers WHERE id_exo = " . $mon_exo['id_exo']);
                                                while($resFichiers = mysql_fetch_array($reqFichiers))
                                                {
                                                    ?>
                                                <li>
                                                    <a href="download.php?f=<?php echo $resFichiers['code_lien']; ?>"><!--<img title="T&eacute;l&eacute;charger ce document" src="../images/download.png"/>-->T&eacute;l&eacute;charger</a>
                                                    <span><?php echo $resFichiers['commentaires']; ?></span>
                                                </li>
                                            <?php
                                                }
                                            ?>
                                            </ul>
                                        </td>
                      
                                    </tr>
                                <?php }//fin boucle EXERCICES   ?>
                            </tbody>
                        </table>
                        <!--#############
                        ##### Bonus #####
                        ##############-->
                        <a class="btn" href="index.php?section=enregistrer_progression_test&seance=<?php echo($ma_seance_actuelle['id_seance']); ?>&bonus=<?php echo($mon_theme['id_theme']); ?>">
                            Créer un BONUS en <?php echo(strtoupper($mon_theme['titre_theme'])); ?>
                        </a>
                        <?php
                        //3-Requete de tous les bonus
                        $sql = "SELECT * FROM " . $tb_bonus . " WHERE id_theme = " . $mon_theme['id_theme'];
                        $rq_bonus = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . mysql_error());
                        ?>

                       
                        <?php
                        if (mysql_num_rows($rq_bonus) >= 1) {
                            ?>
                        <table id="tableau_bonus" style="border:2px solid #E98E8E;" class="<?php echo(strtolower($mon_theme['titre_theme'])); ?>">
                        <thead>
                            <tr>
                                <th colspan="5"><?php echo(strtoupper("+ Bonus de " . $mon_theme['titre_theme'] . " +")); ?></th>
                            </tr>
                        </thead>

                            <tr>
                                <th class="prem_colonne">Titre</th><th>Suivi</th><th>Auteur</th><th>Type</th><th>Note</th>
                            </tr>
                            
                                <tbody>
                                    <?php
                                    //remet le curseur au début (car plusieurs fois parcourues)
                                    while ($mon_bonus = mysql_fetch_assoc($rq_bonus)) 
                                    {
                                        //Requete: Les bonus obtenus par l'étudiant dans cette séance
                                        $sql = "SELECT * " .
                                                "FROM " . $tb_avancement_bonus . " ab, etudiant e " . ",  " . $tb_bonus . " b " .
                                                "WHERE ab.id_bonus = b.id_bonus " .
                                                "AND id_theme = " . $mon_theme["id_theme"]." ".
                                                "AND ab.id_etu = " . $_SESSION["id"] . " " .
                                                "AND id_seance = " . $_GET["seance"] . " " .
                                                "AND ab.id_bonus = " . $mon_bonus['id_bonus'];
                                        $rq_avancement_bonus = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
                                        $mon_avancement_bonus = mysql_fetch_assoc($rq_avancement_bonus);
                                            ?>
                                    <tr style="border:1px solid #E98E8E;">
                                            <td><?php echo($mon_bonus['titre_bonus']) ?></td>
                                            <td  style="text-align:center;">
                                                <?php
                                                //Icone Bonus affiché
                                                //Si la séance est passée
                                                if ($ma_seance_actuelle['date_seance'] < $now) 
                                                {
                                                    //ACTIVE si rien entre (dernière séance)
                                                    if ($apresactuelle_avantsuivante) 
                                                    {
                                                        echo($mon_avancement_bonus['suivi'] == 0 ? '<input type="checkbox" name="bonus_suivi' . $mon_bonus['id_bonus'] . '" id="bonus_suivi' . $mon_bonus['id_bonus'] . '" class="bonus_suivi" value="' . $mon_avancement_bonus['id_bonus'] . '" />' : '<input type="checkbox" style="display: none" name="bonus_suivi' . $mon_avancement_bonus['id_bonus'] . '" id="bonus_suivi' . $mon_avancement_bonus['id_bonus'] . '" class="bonus_suivi" value="' . $mon_avancement_bonus['id_bonus'] . '"  /> <img title="Bonus ' . $mon_avancement_bonus['titre_bonus'] . ' suivi" src="../images/checkm.png"/>');
                                                    } 
                                                    else 
                                                    {
                                                        //BLOQUEE quand il y a des séances entre NOW et sa dat
                                                        echo($mon_avancement_bonus['suivi'] == 0 ? '' : '<input type="checkbox" style="display: none" name="bonus_suivi' . $mon_bonus['id_bonus'] . '" id="bonus_suivi' . $mon_bonus['id_bonus'] . '" class="bonus_suivi" value="' . $mon_avancement_bonus['id_bonus'] . '" /> <img title="Bonus ' . $mon_avancement_bonus['titre_bonus'] . ' suivi" src="../images/checkm.png"/>');
                                                    }
                                                }
                                                //Si la séance est aujourd'hui: TOUT OUVRIR
                                                if ($ma_seance_actuelle['date_seance'] == $now) 
                                                {
                                                    echo($mon_avancement_bonus['suivi'] == 0 ? '<input type="checkbox" name="bonus_suivi' . $mon_bonus['id_bonus'] . '" id="bonus_suivi' . $mon_bonus['id_bonus'] . '" class="bonus_suivi" value="' . $mon_avancement_bonus['id_bonus'] . '" />' : '<input type="checkbox" style="display: none" name="bonus_suivi' . $mon_avancement_bonus['id_bonus'] . '" class="bonus_suivi" value="' . $mon_avancement_bonus['id_bonus'] . '"  /> <img title="Bonus ' . $mon_avancement_bonus['titre_bonus'] . ' suivi" src="../images/checkm.png"/>');
                                                }
                                                ?>
                                            </td>
                                            <td  style="text-align:center;">
                                                <?php
                                                $sql = "SELECT prenom_etu, nom_etu FROM avancement_bonus a, etudiant e WHERE fait=1 AND e.id_etu=a.id_etu AND id_bonus =" . $mon_bonus['id_bonus'];
                                                $reqAuteur = mysql_query($sql) or die (mysql_error());
                                                $auteur = mysql_fetch_array($reqAuteur);
                                                
                                                
                                                echo $auteur['prenom_etu'] . ' ' . $auteur['nom_etu'];
                                                ?>
                                            </td>
                                            <td style="text-align:center;"><?php echo($mon_bonus['type_bonus']) ?></td>
                                            <td  style="text-align:center;">
                                                <?php
                                                if ($mon_avancement_bonus['fait'] == 0)
                                                {
                                                ?>
                                                <select name="<?php echo "note".$mon_bonus['id_bonus']; ?>">
                                                    <option value="-1"></option>
                                                    <?php
                                                    
                                                    $i = 1;
                                                    for($i=1; $i <=5; $i++)
                                                    {
                                                        if ($mon_avancement_bonus['note'] == $i)
                                                            $selected = 'selected="selected"';
                                                        else
                                                            $selected = '';
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                <input type="hidden" value="null" name="<?php echo "note".$mon_bonus['id_bonus']; ?>"/>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                    </tr>
                                        <?php
                                        /*

                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>
                                <?php
                        }*/
                                    }
                        ?>
                                                                </tbody>
                        </table>
                        <?php
                        }
                        
                        ?>

                        <br/>
                </div>
                <?php
            }//si il y a des exercices à afficher
        }//parcours de tous les thèmes
        ?>
        <!--#################
        COURBE DE PROGRESSION
        ##################-->
        <!--    <div id="courbe_progression_seance" name="courbe_progression_seance">
        <?php // include 'generer_courbe_seance.php';     ?>
                <img src="generer_courbe_seance.php" />
            </div>-->
        <h1 class="remarques">Remarques sur cette séance</h1>
        <textarea id="remarque" name="remarque" rows=4><?php
            $sql = 'SELECT remarque FROM remarque_seances WHERE id_seance = ' . $_GET['seance'] . ' AND id_etu = ' . $_SESSION['id'];
            $req = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
            if (mysql_num_rows($req) > 0) {
                $data = mysql_fetch_array($req);
                echo $data['remarque'];
            }
            ?></textarea>
        <input type="hidden" name="soumettre"/>
        <?php if ($apresactuelle_avantsuivante) { ?>
            <div style="position:relative;width:100%;text-align: center; margin-top:5%;"><a href="javascript:document.form_progres.submit()" class="button">Enregistrer votre progression</a>
            </div><?php } ?>
        </form>
        <?php
    }
} else {
    //TOUTES LES SEANCES
    if ($exercicesDispo == true)
    {
    ?>
        <p class="oldschool">Aucune séance correspondante pour ce cours</p>
    <?php
    }
    else
    {
    ?>
        <p class="oldschool">Aucun exercice pour ce cours</p>
    <?php
    }
        
}
?>