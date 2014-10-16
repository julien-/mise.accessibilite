<table border="1" align="center" width="420" border="0" cellpadding="5" cellspacing="0"  class="tab_cal">
    <!--Navigation-->
    <tr>
        <td height="51" colspan="7">
            <table width="381" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <!--Mois-->
                    <td width="290" class="date"><div><?php echo $mois_en_clair . " " . $an; ?></div></td>
                    <!--Mois Precedent-->
                    <td width="50">
                        <a href="index.php?section=seance&mois=<?php echo($mois_prec); ?>&an=<?php echo($an_prec); ?>">	
                            <div align="left"><img border="0" src="../../images/admin/calendrier/prec.png"/></div>
                        </a>
                    </td>
                    <!--Mois suivant-->
                    <td width="41">
                        <a href="index.php?section=seance&mois=<?php echo $mois_suivant; ?>&an=<?php echo $an_suivant; ?>">	
                            <div><img border="0" src="../../images/admin/calendrier/suiv.png" /></div>
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <!--Jours-->
    <tr align="center" class="jours">
        <td class="td_jour">D</td>
        <td class="td_jour">L</td>
        <td class="td_jour">M</td>
        <td class="td_jour">M</td>
        <td class="td_jour">J</td>
        <td class="td_jour">V</td>
        <td class="td_jour">S</td>
    </tr>
</table>
<table align="center"  width="420" border="1" cellpadding="5" cellspacing="0"  class="tab_numero">
    <tr align="center">
        <?php
        //Affichage des 7 premiers jours du calendrier
        for ($i = 0; $i < 7; $i++) {
            if ($i < $premier_jour) {   //jour qui n'appartient pas au mois en cours
                ?>
                <td class="td_jour"></td>
                <?php
            } else {
                $ce_jour = ($i + 1) - $premier_jour;
                // si c'est un jour durant lequel un evenement est programmé on applique la couleur adequat
                if ($tab_jours[$ce_jour]["nb_seances"] > 0) {
                    ?>
                    <td class="td_jour">
                        <div class="container">
                            <!--Numéro du jour-->
                            <div class="content"><?php echo($ce_jour); ?></div>
                            <!--Couleur(s) d'arrière-plan-->
                            <?php
                            $largeur = 100 / $tab_jours[$ce_jour]["nb_seances"];
                            foreach ($tab_jours[$ce_jour]["couleurs"] as $cpt => $ma_couleur) {
                                ?>
                                <div class="bg" style="left: <?php echo($cpt * $largeur); ?>% ; background-color: #<?php echo($ma_couleur); ?>; width: <?php echo($largeur); ?>%;"></div>
                                <?php
                            }
                            ?>
                        </div>
                    </td>
                    <?php
                    // sinon on ne met pas de style
                } else {
                    ?>
                    <td class="td_jour"> <?php echo ($ce_jour); ?></td>
                    <?php
                }
            }
        }

        //affichage du reste du calendrier
        $jour_suiv = ($i + 1) - $premier_jour;
        for ($rangee = 0; $rangee <= 4; $rangee++) {
            ?>
        </tr>
        <tr align="center">
            <?php
            for ($i = 0; $i < 7; $i++) {
                if ($jour_suiv > $dernier_jour) {
                    ?>
                    <td class="td_jour"></td>
                    <?php
                } else {
                    // si c'est un jour où se déroule un evenement on applique le style
                    if ($tab_jours[$jour_suiv]["nb_seances"] > 0) {
                        ?>
                        <td class="td_jour">
							
                        </td>
                        <?php
                        // sinon on ne met pas de style
                    } else {
                        ?>
                        <td class="td_jour"> <?php echo ($jour_suiv); ?></td>
                        <?php
                    }
                }
                $jour_suiv++;
            }
        }
        ?>
    </tr>
</table>