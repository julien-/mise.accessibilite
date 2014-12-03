<?php 
include_once('../../lib/autoload.inc.php');
session_start();
$db = DBFactory::getMysqlConnexionStandard();
$daoExercice = new DAOExercice($db);

$id = $daoExercice->save(new Exercice(array(
		'titre' => $_POST['titre_exo'],
		'theme' => $_POST['id_theme']
)));
$_SESSION['exerciceAdded'] = 'true';

$exos = new Exercice();
$exos->setTheme($_POST['id_theme']);
$exos->setTitre($_POST['titre_exo']);
$exos->setId($id);

echo '
<tr id="new" class="header-exo" id="E'.$exos->getId().'" data-modif-exo-id="'.$exos->getId().'">
<td>
<div>
<div class="row">
<div class="col-lg-10">
<input type="text" id="exo-'.$exos->getId().'"
class="base-hidden form-control hidden input-exo"
		value="'.$exos->getTitre().'"
		data-input-exo-id="'.$exos->getId().'" />
		<p class="center-text">
		<a id="edit-valid-exo-'.$exos->getId().'"
		class="pointer hidden base-hidden validate-icon-exo"
				data-modif-exo-id="'.$exos->getId().'"> <br />
				<i style="font-size: 50px;" class="glyphicon glyphicon-ok-circle"
						title="Valider"></i>
						</a> <a id="edit-abort-exo-'.$exos->getId().'"
						class="pointer hidden base-hidden abort-icon-exo"> <i
						style="font-size: 50px;"
								class="glyphicon glyphicon-remove-circle" title="Annuler"></i>
								</a>
								</p>

								<a class="pointer base titre"
										id="titre-exo-'.$exos->getId().'"
										data-modif-exo-id="'.$exos->getId().'"
										data-toggle="collapse"
												data-target="#bloc-'.$exos->getId().'">
										'.$exos->getTitre().'
									</a>
									</div>
									<div class="col-lg-2">
										<div class="dropdown">
											<button style="height: 30px;"
												id="edit-icon-exo-'.$exos->getId().'"
												data-modif-exo-id="'.$exos->getId().'"
												class="settings-icon hidden-base hidden btn btn-default dropdown-toggle glyphicon glyphicon-cog"
												type="button" id="dropdownMenu1" data-toggle="dropdown">
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu" aria-labelledby="options">
												<li role="presentation"><a class="pointer add-fichier-exo"
													data-toggle="modal" data-target="#modalAddFichier"
													data-id-exo="'.$exos->getId().'"> <i
														style="font-size: 15px;" class="glyphicon glyphicon-plus-sign"
														title="Ajouter un exercice à ce thème""></i> Ajouter un
														fichier
												</a></li>
												<li role="presentation"><a class="pointer edit-exo"
													data-modif-exo-id="'.$exos->getId().'"> <i
														style="font-size: 15px;" class="glyphicon glyphicon-pencil"
														title="Modifier le titre de ce thème"></i> Modifier le titre de l\'exercice
												</a></li>
												<li role="presentation"><a class="pointer delete-exo"
													data-toggle="modal" data-target="#modalDeleteExo"
													data-modif-exo-id="'.$exos->getId().'"> <i
														style="font-size: 15px;" class="glyphicon glyphicon-trash"
														title="Supprimer ce thème"></i> Supprimer l\'exercice
												</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>

							<div id="bloc-'.$exos->getId().'" class="collapse">								
							</div>
					</td>
					</tr>';
if (!isset($_GET['ajax']))
	header('Location: ' . $_SESSION['referrer']);
?>