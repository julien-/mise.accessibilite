<h1 class="titre_page_school">Mon évolution</h1>
<?php
if ($id_cours != false)
{
    $etudiant = $_SESSION['id'];
    include_once('../fonctions.php');
    $consignes = "
                        <br/>
                        <br/>
                        <font style=\"font-weight: bold; font-size: 20px; font-family: 'please_write_me_a_songmedium';\"> Avancement global de la promo:</font>
                        <br/>
                        <br/>
                        Permet de mesurer le taux de complétude du cours par l'ensemble des étudiants qui y sont inscrit.
                        <br/>
                        <br/>
                        <font style=\"font-weight: bold; font-size: 20px; font-family: 'please_write_me_a_songmedium';\"> Vos Pokémons :</font>
                        <br/>
                        <br/>
                        Vous pouvez <b>visualiser</b> votre <b>avancement</b> avec des <b>Pokémons</b> qui vont <b>éclore</b> et <b>évoluer</b> en fonction de <b>votre avancement</b>.
                        <br/>
                        <br/>
                        <font style=\"font-weight: bold; font-size: 20px; font-family: 'please_write_me_a_songmedium';\"> Avancement par chapitre :</font>
                        <br/>
                        <br/>
                        Vous pouvez <b>visualiser</b> votre <b>avancement</b> en fonction de chaque <b>chapitre</b>, chaque barre verticale représentant un exercice.                        <br/><br/>
                        
                        <table>
                            <tr>
                                <td colspan=\"2\">
                                    <b><u>Légende</u>:</b>
                                </td>                
                            </tr>
                            <tr>
                                <td style=\"background-color: #99FF33; width: 20%; border: 1px solid black;\">

                                </td>
                                <td>
                                    <font style=\"margin-left: 10px;\">Exercices assimilés</font>
                                </td>
                            </tr>
                            <tr>
                                <td style=\"background-color: #FFCC33; width: 20%; border: 1px solid black;\">

                                </td>
                                <td>
                                    <font style=\"margin-left: 10px;\">Exercices compris</font>
                                </td>
                            </tr>
                            <tr>
                                <td style=\"background-color: #FF6633; width: 20%; border: 1px solid black;\">

                                </td>
                                <td>
                                    <font style=\"margin-left: 10px;\">Exercices faits</font>
                                </td>
                            </tr>
                            <tr>
                                <td style=\"background-color: white; width: 20%; border: 1px solid black;\">

                                </td>
                                <td>
                                    <font style=\"margin-left: 10px;\">Exercices restants</font>
                                </td>
                            </tr>

                     </table>
                 ";
    $hauteur = 400;

    $sql = "SELECT COUNT(*) AS Nbexostot
            FROM avancement a, exercice e, theme t
            WHERE a.fait = 25 AND a.id_etu = " . $_SESSION['id'] . " 
            AND a.id_exo = e.id_exo
            AND e.id_theme = t.id_theme
            AND t.id_cours = ".$id_cours."";
    $req = mysql_query($sql) or die(mysql_error());
    $nbExosTot = mysql_fetch_assoc($req); 

    $sql = "SELECT COUNT(*) AS nbSeances
            FROM seance 
            WHERE TO_DAYS(NOW()) - TO_DAYS(date_seance) >= 0
            AND id_cours = ".$id_cours."";
    $req = mysql_query($sql) or die(mysql_error());
    $nbSeances = mysql_fetch_assoc($req); 

    if ($nbSeances['nbSeances'] != 0)
        $rapportAvancement = $nbExosTot['Nbexostot'] / $nbSeances['nbSeances'];
    else
        $rapportAvancement = 0;

    $messages['avancement']['lent'][0] = "Bah alors ! Pourquoi t'avances pas ?";
    $messages['avancement']['lent'][1] = "ALLO ??? Y A QUELQU'UN ??? Les exercices ne vont pas se faire tout seuls chef !";
    $messages['avancement']['lent'][2] = "Je te préviens, si tu fais pas tes exercices en temps et en heure je vais te...non en fait je sais pas mais fais-les quand même sérieux c'est pas cool.";
    $messages['avancement']['lent'][3] = "\"Et le trophée du Flemmard d'or 2014 est attribué à... " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . " pour son rôle dans \"Je ne fais pas mes exercices de bases de données\" bravo.\"";

    $messages['avancement']['pile'][0] = "Tu es un(e) vrai(e) petit(e) étudiant(e) modèle !";
    $messages['avancement']['pile'][1] = "Pile au bon rythme ! Continue comme ça !";
    $messages['avancement']['pile'][2] = "Pas plus, pas moins, exercices faits bien comme il faut, t'es un bon, tu iras loin dans la vie";

    $messages['avancement']['vite'][0] = "Comment t'avances trop vite !!! T'es le Usain Bolt de la base de données !";
    $messages['avancement']['vite'][1] = "T'aimes bien les bases de données, non ?";
    $messages['avancement']['vite'][2] = "Continue comme ça et je t'invite au resto pour te félicier. JE LE JURE.";

    if ($rapportAvancement < 2)
        $message = $messages['avancement']['lent'][rand(0, 3)];
    elseif ($rapportAvancement == 2) 
        $message = $messages['avancement']['pile'][rand(0, 2)];
    else
        $message = $messages['avancement']['vite'][rand(0, 2)];

    $tabMessages[0] = $message;

    $sql = "SELECT DISTINCT(date_visite) AS nbConnexions FROM historique WHERE page = 'accueil' AND id_etu = " . $_SESSION['id'];
    $req = mysql_query($sql) or die(mysql_error());


    if ($nbSeances['nbSeances'] != 0)
        $rapportConnexions = mysql_num_rows($req) / $nbSeances['nbSeances'];
    else
        $rapportConnexions = 0;
    $messages['presence']['normal'][0] = "Wesh la miff !!! (Si tu es allemand, demande à tes potes français de t'expliquer cette expression). Alors ? Prêt à rentrer ta progression fulgurante ? (Demande encore à tes potes ce que ça veut dire 'fulgurante')";
    $messages['presence']['normal'][1] = "Tu peux me dire ça fait quel effet de venir étudier dans un bâtiment vert ?";
    $messages['presence']['normal'][2] = "GIVE ME FIVE BRO' !";

    $messages['presence']['souvent'][0] = "Encore toi ??? Dis-donc, tu viens souvent ici ?";
    $messages['presence']['souvent'][1] = "Ah !!! Je t'attendais !";
    $messages['presence']['souvent'][2] = "Salut ! Tu prends quoi ? Comme d'habitude ? Vas-y installe toi, je commande. CHEF ! UNE MARGHERITTA POUR LA 7 STP";

    $messages['presence']['peu'][0] = "Bah alors ? On vient plus aux soirées bases de données ? Hier on a fait une soirée SQL. J'peux te dire que niveau jointure on y est pas allé de main morte...";
    $messages['presence']['peu'][1] = "Je suis trop triste quand je te vois pas :( J'ai l'impression que ça va plus entre nous...";
    $messages['presence']['peu'][2] = "AH ENFIN C'EST PAS TROP TÔT ! Je croyais que tu avais émigré dans un bunker au Groenland et épousé un manchot nain. Bref, content de te revoir !";

    $messages['presence']['plusquenormal'][0] = "Salut ! Alors ça va ? Ton hamster va bien ? T'as regardé le match hier ? Si tu continues de venir souvent on va devenir super potes toi et moi tu sais";
    $messages['presence']['plusquenormal'][1] = "On commence à devenir proche. Tu me passes ton numéro ?";
    $messages['presence']['plusquenormal'][2] = "On se voit souvent en ce moment. Je crois que je commence à avoir des sentiments pour toi...";


    if ($rapportConnexions == 1)
        $message = $messages['presence']['normal'][rand(0, 2)];
    elseif ($rapportConnexions > 2)
        $message = $messages['presence']['souvent'][rand(0, 2)];
    elseif ($rapportConnexions < 1)
        $message = $messages['presence']['peu'][rand(0, 2)];
    else
        $message = $messages['presence']['plusquenormal'][rand(0, 2)];

    $tabMessages[1] = $message; 
    ?>
    <p class="message"><img src="../images/prof.gif" /> <?php echo $tabMessages[rand(0, 1)];?></p>

    <h2 style="font-family: 'please_write_me_a_songmedium'; font-size: 1.1 em; color: black; background-color: white; text-align: left;">Avancement global de la promo</h2>
    <?php
    include_once('../chart/creer_bar_chart_global.php');
    ?>
    <h2 style="font-family: 'please_write_me_a_songmedium'; font-size: 1.1 em; color: black; background-color: white; text-align: left;">Vos Pokémons</h2>
    <?php
    include_once('../vues/tableau_pokemons.php');
    ?>
    <h2 style="font-family: 'please_write_me_a_songmedium'; font-size: 1.1 em; color: black; background-color: white; text-align: left;">Avancement par chapitre</h2>
    
    
    
    
    
    <div style="width: 100%; height: <?php echo $hauteur."px";?>;">
     <?php
            $sql = "SELECT COUNT(*) AS Nbexostot FROM exercice e, theme t, cours c WHERE e.id_theme = t.id_theme AND t.id_cours = c.id_cours AND c.id_cours = " . $id_cours;
            $req = mysql_query($sql) or die(mysql_error());
            $row2 = mysql_fetch_assoc($req);     

            $sql = "SELECT COUNT(*) AS Nbexos, theme.titre_theme AS Titre, theme.id_theme AS IDTheme  FROM theme,exercice WHERE theme.id_theme = exercice.id_theme AND theme.id_theme = exercice.id_theme AND theme.id_cours = " . $id_cours . " GROUP BY theme.titre_theme ORDER BY theme.id_theme";
            $req = mysql_query($sql) or die(mysql_error());

            $var = 1;
            $tab_theme = array();
            $tab_taille = array();
            $taille_tab_taille = 0;
            while($row = mysql_fetch_array($req))
            {            
                $taille_div = (int)($row['Nbexos']*100/$row2['Nbexostot']);
                $tab_taille[$var] = $taille_div;
                $taille_tab_taille = $taille_tab_taille + $taille_div;
                $tab_theme[$var] = $row['Titre'];
                $taille_barre = (int)($taille_div/$row['Nbexos']);
                $sql1 = "SELECT fait, compris, assimile  FROM avancement,exercice, theme
                         WHERE exercice.id_theme = ".$row['IDTheme']."
                         AND exercice.id_exo = avancement.id_exo 
                         AND avancement.id_etu = ".$_SESSION['id']." 
                         AND exercice.id_theme = theme.id_theme
                         AND theme.id_cours = " . $id_cours;
                         //                         ORDER BY avancement.id_exo";
                $req1 = mysql_query($sql1) or die(mysql_error());

                $tab_fait = array();
                $tab_compris = array();
                $tab_assimile = array();
                $i = 1;

                $row1 = mysql_num_rows($req1);

                while($row1 = mysql_fetch_array($req1))
                {
                    $tab_fait[$i] = $row1['fait'];
                    $tab_compris[$i] = $row1['compris'];
                    $tab_assimile[$i] = $row1['assimile'];
                    $i++;
                }

                $nb_fait = 0;
                foreach($tab_fait as $fait)
                {
                    if($fait == 0)
                        break;
                    $nb_fait++;
                }    

                $nb_assimile = 0;
                foreach($tab_assimile as $assimile)
                {
                    if($assimile == 0)
                        break;
                    $nb_assimile++;
                }  

    ?>
        <div style="height: 100%; float: left; width: <?php echo $taille_div."%;";?>">  
            <div style="height: 100%; margin: auto; width: <?php echo $row['Nbexos']*32;?>;">
                 <?php
                        $var ++;
                        $hauteur_escalier1=(int)(($hauteur)/$row['Nbexos']);
                        $hauteur_escalier=(int)(($hauteur)/$row['Nbexos'] - 30);

                        for($i = 1; $i <= $row['Nbexos']; $i++)
                        {  
                            
                ?>
                            <div style="<?php if($i != 1) echo "margin-left: 4px;";?> position: relative; width: 28px; height: 100%; float: left;">
                <?php
                                if($i == $nb_fait && $i != $row['Nbexos'])
                                {
                                ?>
                                    <div style="position: absolute; width: 100%; height: 30px; bottom: <?php echo $hauteur_escalier;?>px;">
                                        <img src="../images/homme_avance.png" style="width: 100%; height: 100%;">
                                    </div>
                                <?php
                                }
                                elseif($i == $nb_fait && $i == $row['Nbexos'] && $i != $nb_assimile)
                                {
                                ?>
                                    <div style="position: absolute; width: 100%; height: 30px; bottom: <?php echo $hauteur_escalier;?>px;">
                                        <img src="../images/homme_drapeau.png" style="width: 100%; height: 100%;">
                                    </div>
                                <?php    
                                }
                                elseif($i == $nb_fait && $i == $row['Nbexos'] && $i == $nb_assimile)
                                {
                                ?>
                                    <div style="position: absolute; width: 100%; height: 30px; bottom: <?php echo $hauteur_escalier;?>px;">
                                        <img src="../images/homme_joyeux.png" style="width: 100%; height: 100%;">
                                    </div>
                                <?php    
                                }
                                                     
                                
                                if($tab_assimile[$i] == 50)
                                {
                                    $background = "#99FF33";
                                }                            
                                elseif($tab_compris[$i] == 25)
                                {
                                    $background = "#FFCC33";
                                }
                                elseif($tab_fait[$i] == 25)
                                {
                                    $background = "#FF6633";
                                }
                                else
                                {
                                    $background = "white";
                                }
                ?>

                                <div <?php echo "id=barre_".$i;?> style="position: absolute; bottom: 0; background-color: <?php echo $background;?>; width: 28px; height: <?php echo $hauteur_escalier."px;";?>; border: 1px solid black;">
                                </div>   
                            </div>
                 <?php
                            $hauteur_escalier=$hauteur_escalier+$hauteur_escalier1;
                        }
                ?>
            </div>
        </div>
        <?php
            }
     ?>
    </div>
    <table style="width: <?php echo $taille_tab_taille."%;";?>;">
           <tr>
    <?php
                    $i = 1;
                    foreach($tab_taille as $taille)
                    {
                        echo"<td style=\"width: ".$taille."%; text-align: center;\">
                                <h1 class=\"titre_scolaire\">$tab_theme[$i]</h1>
                            </td>";
                        $i++;
                    }
    ?>


           </tr>
    </table>
<?php
}
else
    header('Location: index.php?section=introuvable');
?>

