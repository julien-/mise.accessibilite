<?php
include_once "../../sql/connexion_mysql.php";
include_once "../../config.php";

$daoFichiers = new DAOFichier($db);
$listeFichiers = $daoFichiers->getAll();

if (sizeof($listeFichiers) != 0) {
    ?>
    <div id="fichiers">
        <table class="table table-striped table-bordered" id="tab_fichiers">
            <thead>
                <tr class="titre">
                    <th class="center-text">Nom</th>
                    <th class="center-text">Commentaires</th>
                    <th class="center-text">En ligne</th>
                    <th class="center-text">Supprimer</th>
                </tr>
            </thead>
            <tbody id="content-fichiers">
                <?php
                foreach($listeFichiers as $fichier) {
                    ?>
                    <tr class="trFICHIER<?php echo $fichier->getExercice()->getId(); ?> autre_colonne">
                        <!--Nom du fichier avec lien cliquable-->
                        <td class="vert-align">    <!-- target="_blank" pour le nouvel onglet-->
                            <a href="../../controleur/download.php?f=<?php echo $fichier->getCodeLien(); ?>" target="_blank" title="Télécharger ce fichier">
                                <img class="<?php
                                preg_match('/[^\.]+$/i', $fichier->getNom(), $ext); // get extension
                                echo (strtoupper($ext[0]));
                                ?>" /><br/><?php echo($fichier->getNom()); ?></a>
                        </td>
                        <!--Commentaires-->
                        <td class="vert-align">
                            <form method="post" action="rq_fichiers_exo.php?comment=<?php echo($fichier->getId()); ?>&section=mes_cours&<?php echo(isset($_GET["exo_sel"]) ? "&exo_sel=" . $_GET["exo_sel"] : ""); ?>">
                                <textarea name="commentaires" id="commentaires_<?php echo ($fichier->getId()); ?>" rows="3" cols="30"><?php echo(trim(str_replace('<br />', '', $fichier->getCommentaire()))); ?></textarea>
                                <!--submit-->
                                <input type='image' class='img_edit_comm' src='../../<?php echo($dossierimg . "admin/flat_edit.png"); ?>' alt="Valider la modification du commentaire" title="Valider la modification du commentaire"/>
                            </form>
                        </td>
                        <!--En ligne / Hors ligne-->
                        <td class="vert-align">
                            <form method="post" id="form_online_<?php echo ($fichier->getId()); ?>" action="rq_fichiers_exo.php?online&section=mes_cours&<?php echo(isset($_GET["exo_sel"]) ? "&exo_sel=" . $_GET["exo_sel"] : ""); ?>">
                                <input type="hidden"  name="online" value="<?php echo ($fichier->getId()); ?>" />
                                <input type="hidden"  name="coche" id="coche_<?php echo ($fichier->getId()); ?>"  value="<?php echo ($fichier->getEnLigne()); ?>"/>
                                <input type="checkbox" class="fichierenligne" id="<?php echo($fichier->getId()); ?>" <?php echo($fichier->getEnLigne() == "1" ? "checked" : ""); ?>/>
                            </form>
                        </td>
                        <!--SUPPRESSION de fichier-->
                        <td class="vert-align">
							<a href="supprimer_fichier.php?f=<?php echo $fichier->getId();?>" title="Supprimer"><i class="glyphicon glyphicon-minus-sign" alt="Supprimer"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
	<p id="no-files" class="font-school size-message-information center-text"></p>
	<br/>
    <?php 
}
else
	echo "Aucun fichier";
    
?>