
<?php
$_SESSION ['referrer'] = current_page_url ();
if (isset ( $_GET ['exo_sel'] )) {
	echo "Exo sel détecté" + $_GET ['exo_sel'];
}
// permet de garder la bonne selection dans la liste déroulante des thèmes
if (isset ( $_POST ["id_cours_sel"] )) {
	session_start ();
	$_SESSION ["id_cours_sel"] = $_POST ["id_cours_sel"];
}

if (isset ( $_POST ["id_them_sel"] )) {
	session_start ();
	$_SESSION ["id_them_sel"] = $_POST ["id_them_sel"];
}

// affichage des notifications
if (isset ( $_SESSION ["notif_msg"] ) && ! (empty ( $_SESSION ["notif_msg"] ))) {
	echo ($_SESSION ["notif_msg"]);
	$_SESSION ["notif_msg"] = "";
}
//
//
// if (isset($_SESSION["notif_erreur"]) && $_SESSION["notif_erreur"] == "1") {
// $affich_erreur = "";
// $_SESSION["notif_ok"] = "0";
// }
// else
// $affich_erreur = "hidden";
// COURS
$rq_cours = mysql_query ( "SELECT " . $tb_cours . ".id_cours, libelle_cours, id_cle, count(DISTINCT(id_theme)) AS nb_theme , count(DISTINCT(" . $tb_inscription . ".id_etu)) AS nb_inscrits " . "FROM " . $tb_cours . " " . "LEFT JOIN " . $tb_theme . " ON " . $tb_theme . ".id_cours = " . $tb_cours . ".id_cours " . "LEFT JOIN " . $tb_inscription . " ON " . $tb_inscription . ".id_cours = " . $tb_cours . ".id_cours " . "WHERE " . $tb_cours . ".id_prof = " . $_SESSION ["currentUser"]->getId () . " " . "GROUP BY " . $tb_cours . ".id_cours" );

if ($rq_cours === FALSE) {
	die ( mysql_error () );
}

$daoCours = new DAOCours ( $db );
$listeCours = $daoCours->getAllByProfWithStats ( $_SESSION ['currentUser']->getid () );

// THEMES
$rq_themes = mysql_query ( "SELECT " . $tb_theme . ".id_theme, titre_theme, count(id_exo) AS nb_exo , " . $tb_theme . ".id_cours " . "FROM " . $tb_theme . " " . "LEFT JOIN " . $tb_exercice . " ON " . $tb_exercice . ".id_theme = " . $tb_theme . ".id_theme " . "LEFT JOIN " . $tb_cours . " ON " . $tb_cours . ".id_cours = " . $tb_theme . ".id_cours " . "WHERE " . $tb_cours . ".id_prof = " . $_SESSION ["currentUser"]->getId () . " " . "GROUP BY " . $tb_theme . ".id_theme;" );
if ($rq_themes === FALSE) {
	die ( mysql_error () );
}

echo "SELECT e.id_exo, e.num_exo, e.titre_exo, e.id_theme,  t.id_cours, count(f.id_fichier) AS nb_fichiers " . 
"FROM " . $tb_exercice . " e " . "LEFT JOIN " . $tb_fichiers . " f ON e.id_exo = f.id_exo " . "JOIN " . $tb_cours . " c " . "LEFT JOIN " . $tb_theme . " t ON t.id_cours = c.id_cours " . "WHERE e.id_theme = t.id_theme " . "AND id_prof = " . $_SESSION ["currentUser"]->getId () . " " . "GROUP BY e.id_exo " . "ORDER BY t.id_theme, num_exo";
// EXERCICES
$rq_exos = mysql_query ( "SELECT e.id_exo, e.num_exo, e.titre_exo, e.id_theme,  t.id_cours, count(f.id_fichier) AS nb_fichiers " . 
// SELECT *, count(f.id_fichier) AS nb_fichiers " .
"FROM " . $tb_exercice . " e " . "LEFT JOIN " . $tb_fichiers . " f ON e.id_exo = f.id_exo " . "JOIN " . $tb_cours . " c " . "LEFT JOIN " . $tb_theme . " t ON t.id_cours = c.id_cours " . "WHERE e.id_theme = t.id_theme " . "AND id_prof = " . $_SESSION ["currentUser"]->getId () . " " . "GROUP BY e.id_exo " . "ORDER BY t.id_theme, num_exo" );
if ($rq_exos === FALSE) {
	die ( mysql_error () );
}
// mysql_close($db);
?>

<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="<?php if (!isset($_GET['r'])) echo "active";?>"><a
			href="#gestion" data-toggle="tab">Gestion de mes cours</a></li>
		<li class="<?php if (isset($_GET['r'])) echo "active";?>"><a
			href="#recherche" data-toggle="tab">Recherche d'étudiant</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane <?php if (!isset($_GET['r'])) echo "active";?>"
			id="gestion">
			<!--DIV Sous onglet 1-->

			<!--#############
                    COURS
                #############-->
                </br>
                      <button type="button" id="demo" class="btn btn-default btn-lg" data-demo>
        <span class="glyphicon glyphicon-play"></span>
        Start the demo
      </button>
			<div class="panel panel-cours">
				<div class="panel-heading">Mes cours</div>
				<div class="panel-body ">
					<table class="table table-striped table-bordered" name="tab_cours" id="tab_cours">
						<thead>
							<tr class="titre">
								<th class="center-text">Titre du cours</th>
								<th class="center-text">Inscrits</th>
								<th class="center-text">Th&egrave;mes</th>
								<th class="center-text">Détails</th>
								<th class="center-text">Modifier la clé du cours</th>
								<th class="center-text">Forum</th>
								<th class="center-text">Supprimer</th>
							</tr>
						</thead>
						<tbody>
                    <?php
																				while ( $mon_cours = mysql_fetch_array ( $rq_cours ) ) {
																					?>
                        <tr>
								<!--Titre du cours-->
								<td class="autre_colonne vert-align">
									<form method="post"
										name="form_name_<?php echo($mon_cours['id_cours']); ?>"
										action="../rq_mes_cours.php?section=mes_cours&majtitrecours=<?php echo($mon_cours['id_cours']); ?>">
										<input type="text" style="height: 20px; font-size: 10pt;"
											name="newtitrecours" id="newtitrecours" size="26"
											value="<?php echo $mon_cours['libelle_cours']; ?>"
											title="Saisir un nouveau titre de cours"
											class="inputValDefaut">
										<!--submit-->
										<a id='img_edit_titrecours' name='img_edit_titrecours'
											href="#" onClick=form_name_<?php echo($mon_cours['id_cours']); ?>.submit()><i
											class="glyphicon glyphicon-pencil color-cours"
											title="Modifier le nom de ce cours"></i></a>
									</form>
								</td>
								<!--Nombre d'inscris-->
								<td class="petite_colonne vert-align">
                                <?php echo($mon_cours["nb_inscrits"]); ?>
                            </td>
								<!--Nombre de thèmes-->
								<td class="petite_colonne vert-align">
                                <?php echo($mon_cours["nb_theme"]); ?>
                            </td>
								<!--Détails-->
								<td class="petite_colonne vert-align"><a
									href="index.php?section=accueil&c=<?php echo $mon_cours['id_cours']; ?>">
										<i class="glyphicon glyphicon-list-alt color-cours"
										title="D&eacute;tails sur ce cours"></i>
								</a></td>
								<!--Modifier la clé du cours-->
								<td class="autre_colonne vert-align">
									<form method="post"
										name="form_cle_<?php echo($mon_cours['id_cle']); ?>"
										action="../rq_mes_cours.php?section=mes_cours&majclecours=<?php echo($mon_cours['id_cle']); ?>">
										<input type="text" style="height: 20px; font-size: 10pt;"
											name="newclecours" id="newclecours" size="26" value=""
											title="Saisir une nouvelle clé" class="inputValDefaut">
										<!--submit-->
										<a id='img_edit_clecours' name='img_edit_clecours' href="#"
											onClick=form_cle_<?php echo($mon_cours['id_cle']); ?>.submit()><i
											class="glyphicon glyphicon-pencil color-cours"
											title="Modifier la clé de ce cours"></i></a>
									</form>
								</td>
								<!-- FORUM -->
								<td class="petite_colonne vert-align"><a
									href="../controleur/index.php?section=index_forum&id_cours=<?php echo($mon_cours['id_cours']); ?>"><i
										class="glyphicon glyphicon-comment color-cours" alt="Forum" title="Forum"></i></a>
								</td>
								<!-- SUPPRESSION COURS   -->
								<td class="petite_colonne vert-align">
									<!--submit--> <a
									href="../controleur/delete.php?cours=<?php echo($mon_cours['id_cours']); ?>"><i
										class="glyphicon glyphicon-minus-sign color-cours" alt="Forum"
										title="Forum"></i></a>
								</td>

							</tr>
                    <?php } ?>
                </tbody>
					</table>
				</div>
			</div>
			<!--#########################   NOUVEAU COURS   #########################-->
			<div id="msg_cours"></div>


			<a class="btn btn-cours" id="addcours" data-toggle="modal"
				href="modal/remotePage.php" data-target="#remoteModal">Ajouter un
				cours</a>

			<!-- Modal ajout cours-->
			<div id="lescours" class="modal fade" id="remoteModal" tabindex="-1" role="dialog"
				aria-labelledby="remoteModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button data-dismiss="modal" class="close" type="button">
								<span aria-hidden="true">×</span><span class="sr-only">Close</span>
							</button>
							<h4 id="myModalLabel" class="modal-title">Ajouter un cours</h4>
						</div>
						<form method="post" name="form_add_cours"
							action="../controleur/rq_mes_cours.php?section=mes_cours&addcours">
							<br />
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-1"></div>
									<div class="col-sm-9">
										<div class="form-group">
											<label for="titrecours">Titre du cours</label> <input
												type="text" name="titrecours" id="titrecours" size="26"
												value="" title="Taper un titre de cours"
												class="inputValDefaut">
											</td>
										</div>
										<div class="form-group">
											<label for="clecours">Clé du cours</label> <input type="text"
												name="clecours" id="clecours" size="26" value=""
												title="Taper une clé unique pour ce cours"
												class="inputValDefaut">
											</td>
										</div>
										<!--submit-->
										<div class="form-group center-content">
											<input type="submit" class="btn btn-primary" name="soumis1"
												id="soumis1" alt='Ajouter un cours' title='Ajouter un cours'
												value="Ajouter" />
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Fin modal ajout cours -->
			<!--##############
                    THEMES
                ##############-->
                </br>
                </br>
			<div id='themes'>
			<div class="panel panel-theme">
				<div class="panel-heading">
					Gestion des th&egrave;mes du cours de
					<!--######################### LISTE DEROULANTE DES COURS #########################-->

					<select name="liste_cours" id="liste_cours" class="listederoulh2"><?php
					// remet le curseur au début (car rq_cours déjà parcouru avant)
					mysql_data_seek ( $rq_cours, 0 );
					while ( $mon_cours = mysql_fetch_array ( $rq_cours ) ) {
						?>                                                                      
                            <option
							value="<?php echo($mon_cours["id_cours"]); ?>"
							<?php
						// affiche selected pour l'option choisie avant de lancer la reqete && ($_SESSION['id_cours_sel'] == $mon_cours["id_cours"])
						
						if (isset ( $_SESSION ['id_cours_sel'] ) && ($_SESSION ['id_cours_sel'] == $mon_cours ["id_cours"]))
							echo 'selected="selected"';
						?>><?php echo (Outils::toUpper($mon_cours["libelle_cours"])); ?></option><?php
					}
					?>
                    </select>
				</div>
					<div class="panel-body ">
				<div id="msg_themes"></div>
				<!--######################### TABLEAU DES THEMES #########################-->
				<table id="tab_themes" name="tab_themes"
					class="table table-striped table-bordered">
					<thead>
						<tr class="titre">
							<!--class pour rester toujours visible-->
							<th class="center-text">Titre du thème</th>
							<th class="center-text">Nombre d'exercices</th>
							<th class="center-text">Supprimer</th>
						</tr>
					</thead>
					<tbody>
                        <?php
																								while ( $mon_theme = mysql_fetch_array ( $rq_themes ) ) {
																									?>
                            <tr
							class="trTHEMES_<?php echo($mon_theme["id_cours"]); ?>">
							<!--Pour savoir s'il faut afficher ou pas-->
							<!--Titre du thème-->
							<td class="autre_colonne vert-align">
								<form method="post"
									name="form_name_theme_<?php echo($mon_theme['id_theme']); ?>"
									action="../rq_mes_cours.php?section=mes_cours&majtheme=<?php echo($mon_theme['id_theme']); ?>">
									<input type="text" style="height: 20px; font-size: 10pt;"
										name="titremajtheme" id="titremajtheme" size="26"
										value="<?php echo $mon_theme['titre_theme']; ?>"
										title="Saisir un nouveau titre de cours"
										class="inputValDefaut">
									<!--submit-->
									<a id='img_edit_theme' name='img_edit_theme' href="#"
										onClick=form_name_theme_<?php echo($mon_theme['id_theme']); ?>.submit()><i
										class="glyphicon glyphicon-pencil color-theme"
										title="Modifier le nom de ce thème"></i></a>
								</form>
							</td>
							<!-- Nombre d'exercices : Utile pour garder le numéro du prochain exercice à créer-->
							<td class="autre_colonne vert-align"
								id="nbexo_idtheme<?php echo ($mon_theme["id_theme"] ); ?>">
                                    <?php echo($mon_theme["nb_exo"]); ?>
                                </td>
							<!--SUPPRESSION THEME-->
							<td class="autre_colonne vert-align">
								<form
									id="form_delete_theme_<?php echo($mon_theme['id_theme']); ?>"
									method="post"
									action="../rq_mes_cours.php?section=mes_cours&suptheme=<?php echo $mon_theme['id_theme']; ?>">
									<!--submit-->
									<a class='img_sup_theme' name='img_sup_theme' href="#"
										onClick=form_delete_theme_<?php echo($mon_theme['id_theme']); ?>.submit()><i
										class="glyphicon glyphicon-minus-sign color-theme"
										title="Supprimer ce thème"></i></a>
								</form>
							</td>

						</tr>
                        <?php } ?>
                    </tbody>
				</table>
				</div>
				</div>
				
				<!-- Modal ajout cours-->
				<a class="btn btn-theme" data-toggle="modal"
					data-target="#ajoutTheme">Ajouter un thème</a>

				<div class="modal fade" id="ajoutTheme" tabindex="-1" role="dialog"
					aria-labelledby="remoteModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button data-dismiss="modal" class="close" type="button">
									<span aria-hidden="true">×</span><span class="sr-only">Close</span>
								</button>
								<h4 id="myModalLabel" class="modal-title">Ajouter un thème</h4>
							</div>
							<br />
							<form method="post" name="form_add_cours"
								action="../rq_mes_cours.php?section=mes_cours&addtheme">
								<div class="container-fluid">
									<div class="row">
										<div class="col-sm-1"></div>
										<div class="col-sm-9">
											<div class="form-group">
												<label for="titrecours">Titre du thème</label> <input
													type="text" name="titretheme" id="titretheme" size="26"
													value="" title="Taper un titre de thème"
													class="inputValDefaut" /> <input hidden="hidden"
													name="id_cours_sel" id="id_cours_sel" />
											</div>
											<!--submit-->
											<div class="form-group center-content">
												<input type="submit" class="btn btn-primary" name="soumis2"
													id="soumis2" alt='Ajouter un thème'
													title='Ajouter un thème' value="Ajouter" />
											</div>
										</div>
										<div class="col-sm-1"></div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Fin modal ajout cours -->
			</div>
			</br>
			<div id="exo">
						<div class="panel panel-exo">
				<div class="panel-heading">
				Gestion des exercices du th&egrave;me <?php ?>
                    <!--###########################
                        LISTE DEROULANTE DES THEMES
                        #########################-->

					<select name="liste_themes" id="liste_themes" class="listederoulh2"><?php
					// remet le curseur au début (car rq_themes déjà parcouru avant)
					mysql_data_seek ( $rq_themes, 0 );
					while ( $mon_theme = mysql_fetch_array ( $rq_themes ) ) {
						?>                                                                      
                            <option
							value="<?php echo($mon_theme["id_theme"]); ?>"
							<?php
						// affiche selected pour l'option choisie avant de lancer la reqete && ($_SESSION['id_them_sel'] == $mon_theme["id_theme"])
						
						if (isset ( $_SESSION ['id_them_sel'] ) && ($_SESSION ['id_them_sel'] == $mon_theme ["id_theme"]))
							echo 'selected="selected"';
						?>
							class="theme_du_cours_<?php echo($mon_theme["id_cours"]); ?>"><?php echo (Outils::toUpper($mon_theme["titre_theme"])); ?></option><?php
					}
					?>
                    </select>
				<!--#########################
                        LISTE DES EXERCICES 
                    #########################-->
				<div id="msg_exo"></div>
				</div>
				<div class="panel-body ">
				<table id="tab_exo" name="tab_exo"
					class="table table-striped table-bordered">
					<thead>
						<tr class="titre">
							<th class="center-text">N°</th>
							<th class="center-text">Titre actuel</th>
							<th class="center-text">Détails</th>
							<th class="center-text">Fichiers</th>
							<th class="center-text">Supprimer</th>
						</tr>
					</thead>
					<tbody>
                        <?php
																								// parcours de la requete de tous les exos
																								while ( $mon_exo = mysql_fetch_assoc ( $rq_exos ) ) {
																									?>
                            <tr
							class="trEXO_<?php echo($mon_exo["id_theme"]); ?>">
							<!--Numéro d'exercice-->
							<td class="petite_colonne vert-align">
                                    <?php echo ($mon_exo["num_exo"]); ?>
                                </td>
							<!--Titre de l'exercice-->
							<td class="petite_colonne vert-align">
								<form method="post"
									name="form_name_exo<?php echo $mon_exo['id_exo'];?>"
									action="../rq_mes_cours.php?section=mes_cours&majexo=<?php echo($mon_exo['id_exo']); ?>">
									<!--TITRE-->
									<input type="text" style="height: 20px; font-size: 10pt;"
										name="titremajexo" id="titremajexo" size="26"
										value="<?php echo ($mon_exo["titre_exo"]); ?>"
										title="Taper un titre d'exercice" class="inputValDefaut">
									<!--submit-->
									<a id='soumismajexo' name='soumismajexo' href="#"
										onClick=form_name_exo<?php echo($mon_exo['id_exo']); ?>.submit()><i
										class="glyphicon glyphicon-pencil color-exo"
										alt="Valider le nouveau titre saisi"
										title="Valider le nouveau titre saisi"></i></a>
								</form>
							</td>
							<!--Details-->
							<td class="petite_colonne vert-align"><a
								title="Progression de l'exercice"
								href="index.php?section=details_exercice&c=<?php echo ($mon_exo['id_cours']); ?>&ex=<?php echo ($mon_exo["id_exo"]); ?>">
									<i class="glyphicon glyphicon-list-alt color-exo"
									title="D&eacute;tails sur cet exercice"></i>
							</a></td>
							<!--3 Popup: Affichage des fichiers-->
							<td class="petite_colonne vert-align"><a href="#"
								data-book-id="<?php echo($mon_exo['id_exo']); ?>"
								data-toggle="modal" data-target="#ajoutFichier"><i
									class="glyphicon glyphicon-paperclip color-exo"
									title="Ajouter un fichier à cet exercice"></i></a></td>
							<td class="petite_colonne vert-align">
								<!--SUPPRESSION d'exo-->
								<form method="post"
									name="form_supp_exo<?php echo($mon_exo['id_exo']); ?>"
									action="../rq_mes_cours.php?section=mes_cours&supexo=<?php echo ($mon_exo['id_exo']); ?>">
									<!--Mémorise l'id du theme de l'exercice concerné-->
									<input type="hidden" id="idt_exo" name="idt_exo"
										value="<?php echo ($mon_exo['id_theme']); ?>" />
									<!--submit-->
									<a id='soumismajexo' name='soumissupexo' href="#"
										onClick=form_supp_exo<?php echo($mon_exo['id_exo']); ?>.submit()><i
										class="glyphicon glyphicon-minus-sign color-exo"
										alt="Supprimer l'exercice" title="Supprimer l'exercice"></i></a>

								</form>
							</td>

						</tr>
                        <?php
																								
}
																								?>
                    </tbody>
				</table>
				</div>
				</div>
			</div>

			<a class="btn btn-exo" data-toggle="modal"
				data-target="#ajoutExo">Ajouter un exercice</a>
			<div class="modal fade" id="ajoutExo" tabindex="-1" role="dialog"
				aria-labelledby="remoteModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button data-dismiss="modal" class="close" type="button">
								<span aria-hidden="true">×</span><span class="sr-only">Close</span>
							</button>
							<h4 id="myModalLabel" class="modal-title">Ajouter un exercice</h4>
						</div>
						<br />
						<form method="post" name="form_add_exo"
							action="../rq_mes_cours.php?section=mes_cours&addexo">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-1"></div>
									<div class="col-sm-9">
										<div class="form-group">
											<label for="titre_exo">Titre de l'exercice</label> <input
												type="text" name="titre_exo" id="titre_exo" size="26"
												value="" title="Taper un titre d'exercice"
												class="inputValDefaut"> <input type="hidden"
												name="id_them_sel" id="id_them_sel" /> <input type="hidden"
												name="nbmax_exo" id="nbmax_exo" />
										</div>
										<!--submit-->
										<div class="form-group center-content">
											<input type="submit" class="btn btn-primary"
												name="soumisajouexo" id="soumisajouexo"
												alt='Ajouter un exercice' title='Ajouter un exerccie'
												value="Ajouter" />
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="ajoutFichier" tabindex="-1" role="dialog"
				aria-labelledby="remoteModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-large">
					<div class="modal-content">
						<div class="modal-header">
							<button data-dismiss="modal" class="close" type="button">
								<span aria-hidden="true">×</span><span class="sr-only">Close</span>
							</button>
							<h4 id="myModalLabel" class="modal-title">Ajouter un fichier</h4>
						</div>
						<br />
						<form method="post" enctype="multipart/form-data"
							name="form_add_fichier" action="ajouter_fichier.php">
							<div class="container-fluid">
            	<?php include('fichiers_exo.php'); ?>
                	<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-8">
										<div class="form-group">
											<input type="hidden" name="MAX_FILE_SIZE"
												value="30000000000000000000000000000000" /> <input
												name="userfile" type="file" />
										</div>
										<div class="form-group">
											<label for="nom_fichier">Nom du fichier</label> <input
												type="text" class="input-text" name="nom_fichier"
												placeholder="Tapez un nom de fichier" /> <input
												type="hidden" name="fichierID" id="fichierID" />
										</div>
										<div class="form-group">
											<label for="commentaires">Commentaires</label>
											<textarea name="commentaires" rows="2" cols="25"></textarea>
										</div>
										<div class="form-group">
											<label for="en_ligne">Disponible imm&eacute;diatement</label>
											<input type="checkbox" checked="checked" name="en_ligne" /> <input
												type="hidden" name="fichierID" id="fichierID" />
										</div>
										<!--submit-->
										<div class="form-group">
											<div class="col-lg-5 col-md-offset-4">
												<input type="submit" class="btn btn-primary" name="submit"
													id="submit" alt='Ajouter un fichier'
													title='Ajouter un fichier' value="Ajouter" />
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--DIV Sous onglet 2-->
		<div class="tab-pane <?php if (isset($_GET['r'])) echo "active";?>"
			id="recherche">
            <?php include('recherche.php'); ?>
        </div>
	</div>
</div>