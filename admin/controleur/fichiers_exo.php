<?php
include_once "../../sql/connexion_mysql.php";
include_once "../../config.php";


if (1) {
    

    $rq_fichiers = mysql_query("SELECT id_fichier, id_exo, chemin_fichier, nom, commentaires, code_lien, enligne " .
            "FROM " . $tb_fichiers);
    
    ?>
    <div id="fichiers">
        <h3 class="titre_scolaire">Fichiers associés à cet exercice</h3>
        <table class="tableau" id="tab_fichiers">
            <thead>
                <tr class="titre">
                    <th>Nom</th>
                    <th>Commentaires</th>
                    <th>En ligne</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mon_fichier = mysql_fetch_assoc($rq_fichiers)) {
                    ?>
                    <tr class="trFICHIER<?php echo $mon_fichier['id_exo']; ?> autre_colonne">
                        <!--Nom du fichier avec lien cliquable-->
                        <td>    <!-- target="_blank" pour le nouvel onglet-->
                            <a href="download.php?f=<?php echo $mon_fichier['code_lien']; ?>" target="_blank" title="Télécharger ce fichier">
                                <img class="<?php
                                preg_match('/[^\.]+$/i', $mon_fichier['nom'], $ext); // get extension
                                echo (strtoupper($ext[0]));
                                ?>" /><br/><?php echo($mon_fichier["nom"]); ?></a>
                        </td>
                        <!--Commentaires-->
                        <td>
                            <form method="post" action="rq_fichiers_exo.php?comment=<?php echo($mon_fichier['id_fichier']); ?>&section=mes_cours&<?php echo(isset($_GET["exo_sel"]) ? "&exo_sel=" . $_GET["exo_sel"] : ""); ?>">
                                <textarea name="commentaires" id="commentaires_<?php echo ($mon_fichier['id_fichier']); ?>" rows="3" cols="30"><?php echo(trim(str_replace('<br />', '', $mon_fichier["commentaires"]))); ?></textarea>
                                <!--submit-->
                                <input type='image' class='img_edit_comm' src='../../<?php echo($dossierimg . "admin/flat_edit.png"); ?>' alt="Valider la modification du commentaire" title="Valider la modification du commentaire"/>
                            </form>
                        </td>
                        <!--En ligne / Hors ligne-->
                        <td>
                            <form method="post" id="form_online_<?php echo ($mon_fichier['id_fichier']); ?>" action="rq_fichiers_exo.php?online&section=mes_cours&<?php echo(isset($_GET["exo_sel"]) ? "&exo_sel=" . $_GET["exo_sel"] : ""); ?>">
                                <input type="hidden"  name="online" value="<?php echo ($mon_fichier['id_fichier']); ?>" />
                                <input type="hidden"  name="coche" id="coche_<?php echo ($mon_fichier['id_fichier']); ?>"  value="<?php echo ($mon_fichier['enligne']); ?>"/>
                                <input type="checkbox" class="fichierenligne" id="<?php echo($mon_fichier["id_fichier"]); ?>" <?php echo($mon_fichier['enligne'] == "1" ? "checked" : ""); ?>/>
                            </form>
                        </td>
                        <!--SUPPRESSION de fichier-->
                        <td>
                            <form method="post" action="rq_fichiers_exo.php?supfichier=<?php echo ($mon_fichier['id_fichier']); ?>&section=mes_cours&<?php echo(isset($_GET["exo_sel"]) ? "&exo_sel=" . $_GET["exo_sel"] : ""); ?>">
                                <!--Mémorise l'id du fichier concerné-->
                                <input type="hidden"  id="id_fic" name="id_fic" value="<?php echo ($mon_fichier['id_fichier']); ?>" />
                                <!--submit-->
                                <input type="image" class="soumissupfic" src="../../<?php echo($dossierimg . $dossieradmin . "flat_supp.png"); ?>" alt="Supprimer <?php echo($mon_fichier["nom"]); ?>" title="Supprimer <?php echo($mon_fichier["nom"]); ?>"/>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <h3 class="titre_scolaire">Ajouter un fichier</h3>
    <form enctype="multipart/form-data" method="post" action="rq_fichiers_exo.php?upload=<?php echo($id_exo); ?>&section=mes_cours&<?php echo(isset($_GET["exo_sel"]) ? "&exo_sel=" . $_GET["exo_sel"] : ""); ?>" >
    <table class="formulaire" align="center">
        <tr>
            <td align="center">
                <input type="hidden" name="MAX_FILE_SIZE" value="30000000000000000000000000000000" />
                <input name="userfile" type="file" />
            </td>
        </tr>
        <tr>
            <td align="center">
                <label class="libelle_champ" for="commentaires">Commentaires :</label><textarea name="commentaires" rows="2" cols="30"></textarea><br/><br/>
            </td>
        </tr>
        <tr>
            <td align="center">
                <input type="submit" value="Déposer le fichier" class="button_1"/>
            </td>
        </tr>
    </table>
    </form>

    <?php }
    else
    	echo "eee";
?>