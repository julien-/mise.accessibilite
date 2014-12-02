<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>My Study Companion</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="../../css/bootstrap/bootstrap-tour.min.css" rel="stylesheet">
        <link href="../../css/bootstrap/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../../css/perso/index.css" rel="stylesheet">
        <link href="../../css/perso/menu.css" rel="stylesheet">
        <link href="../../css/perso/menu_haut.css" rel="stylesheet">
        <link href="../../css/typeahead.css" rel="stylesheet">
        <link href="../../css/perso/general.css" rel="stylesheet">
        <link href="../../css/tableau.css" rel="stylesheet">
        <link href="../../css/style.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css">
        <?php if (file_exists("../../css/" . $pageWithoutPath . ".css")){?>
        <link href="../../css/<?php echo $pageWithoutPath; ?>.css" rel="stylesheet">
        <?php }?>
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
    </head>

    <!-- HTML code from Bootply.com editor -->

    <body>
    	<div id="wrap">
            <!-- Header -->
			<nav class="navbar navbar-default" role="navigation" <?php if(isset($_SESSION['cours'])) echo 'style="background-color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>
			  <div id="menu_haut" class="container-fluid">
			  	<div class="row">
			  		<div class="col-xs-12 col-sm-6 col-md-offset-2 col-md-4 col-lg-6 col-lg-offset-1">
						<img src="../../images/logo.png" alt="Logo" width="20%" style="z-index:999999;"/>
			  		</div>

			      	<div class="menu_droite col-xs-12 col-sm-6 col-md-4 text-left-xs text-right-sm">
			      	  <a class="menu_haut_a" role="button" href="index.php?section=reception_messagerie" <?php if(isset($_SESSION['cours'])) echo 'style="color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>><?php echo $nbMessagesNnLu;?>&nbsp;<i class="glyphicon glyphicon-envelope"></i></a>
			          <a href="#" class="menu_haut_a dropdown-toggle" data-toggle="dropdown" <?php if(isset($_SESSION['cours'])) echo 'style="color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>
			          	<?php 
							if($_SESSION["currentUser"]->getCode_lien() != NULL)
							{
								$chemin = $daoEtudiant->getCheminByCodeLienAndEtu($_SESSION["currentUser"]->getCode_lien(),$_SESSION["currentUser"]->getId());
						?>
								<img class="profile-image img-circle" width="30" height="30" src="../../upload/<?php echo $chemin; ?>" alt="avatar"/>&nbsp; 
						<?php 
							}
							else 
							{
						?>
			          			<i class="glyphicon glyphicon-user"></i>&nbsp; 
			          	<?php 
							}
							echo $_SESSION['currentUser']->getPrenom() . ' ' . $_SESSION['currentUser']->getNom();
			          	?>
			          	<span class="caret"></span>
			          </a>
			          <ul class="dropdown-menu dropdown-menu-right" role="menu">
			            <li><a href="index.php?section=compte">Mon compte</a></li>
			            <li class="divider"></li>
	                    <li><a href="../../deconnexion.php"><i class="glyphicon glyphicon-lock"></i>&nbsp;Se déconnecter</a></li>
			          </ul>
			      	</div>
		      	</div>
			  </div>
			</nav>
			<nav class="navbar navbar-custom navbar-inverse" role="navigation">
			    <div class="container">
			      <div class="navbar-header">
			        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			          <span class="icon-bar"></span>
			          <span class="icon-bar"></span>
			          <span class="icon-bar"></span>
			        </button>
			      </div>
			      <div class="collapse navbar-collapse">
			        <ul class="nav navbar-nav nav-justified menu-item-hover">
		        	  <?php 
                        if(isset($_SESSION['cours']))
                        {
                      ?>
			          <li <?php if ( $_GET['section'] == "informations" ) echo "class='active'";?>><a href="index.php?section=informations">Informations</a></li>
			          <li class="dropdown <?php if ( $_GET['section'] == "seance_actuelle" || $_GET['section'] == "seance_precedente") echo "active";?>">
			            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Séances <b class="caret"></b></a>
			            <ul class="dropdown-menu" role="menu">
		                                    <?php
		                                    $next_seance = next($listeSeances);
		                                    $trouve_seance = FALSE;
		                                    foreach ($listeSeances as $seance) 
		                                    {
		                                    	if($next_seance)
		                                    	{
			                                    	if ($seance->getDate() <= $now && $now < $next_seance->getDate() && !$trouve_seance)
			                                    	{
		                                    			$section = "seance_actuelle";
		                                    			$trouve_seance = TRUE;
			                                    	}
			                                    	else if($seance->getDate() < $now)
			                                    		$section = "seance_precedente";
			                                    	else 
			                                    		$section = "seance_futur";
		                                    	}
		                                    	else
		                                    	{
		                                    		if($trouve_seance)
		                                    			$section = "seance_futur";
	                                    			else
		                                    			$section = "seance_actuelle";
		                                    	}
	                                        ?>
		                                        <li class="<?php if(isset($section) && $section == "seance_actuelle") echo "active";?>">
	                                        		<a href="<?php if(isset($section)) echo "index.php?section=".$section."&id_seance=".$seance->getId();?>" title="<?php echo transformerDate($seance->getDate()); ?>">
	                                        			<?php
	                                        				echo "Séance du : " . transformerDate($seance->getDate());														
														?>
                                        			</a>
                                        		</li>
	                                        <?php
	                                        	$next_seance = next($listeSeances);
		                                    }
		                                    ?>
                                </ul>
			          </li>
			          <li <?php if ( $_GET['section'] == "progression" ) echo "class='active'";?>><a href="index.php?section=progression">Ma Progression</a></li>
			          <li class="dropdown <?php if ( $_GET['section'] == "mes_bonus" || $_GET['section'] == "autres_bonus") echo "active";?>">
			            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mes Bonus <b class="caret"></b></a>
			            <ul class="dropdown-menu">
			              <li><a href="index.php?section=mes_bonus">Mes Bonus</a></li>
			              <li><a href="index.php?section=autres_bonus">Autres Bonus</a></li>
			            </ul>
			          </li>
			          <li <?php if ( $_GET['section'] == "objectif" ) echo "class='active'";?>><a href="index.php?section=objectif">Mes Badges</a></li>
			          <li <?php if ( strpos($_GET['section'], "forum") != false ) echo "class='active'";?>><a href="index.php?section=index_forum&id_cours=<?php echo $_SESSION['cours']->getId();?>">Forum</a></li>
			        <?php 
                    }
                    ?>
			      	</ul>
			      </div><!--/.nav-collapse -->
			    </div><!--/.container -->
			</nav><!--/.navbar -->
            <!-- /Header -->            
            <!-- container -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2">
                        <div class="list-group">
                        	<a href="index.php?section=cours" class="<?php if($page == "cours") echo "list-group-item active"; else echo "list-group-item";?>">
                        		<i class="glyphicon glyphicon-th-list"></i>
						        <span style="font-size: x-large; margin-left:5%;">Mes cours</span>
						   	</a>
                        	<?php
							if($nbcours != 0)
							{
	                            foreach ($listeCours as $cours) 
	                            {
	                            ?>
	                        	<a href="index.php?section=progression&id_cours=<?php echo $cours->getCours()->getId(); ?>" class="list-group-item" title="<?php echo $cours->getCours()->getLibelle();?>" <?php if(isset($_SESSION['cours']) && isset($_SESSION['cours']) && $_SESSION['cours']->getId() ==  $cours->getCours()->getId()) echo 'style="font-weight: bold; background-color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>
								   <?php echo $cours->getCours()->getLibelle();?>
								</a>
								<?php
	                            }
							}
                            ?>
                        </div>
                    </div>
                    <div id="bloc_page" class="col-xs-12 col-sm-12 col-md-8">
                    	<!-- Small modal popup -->						
						<div  id="modal_popup" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						    	<div class="modal-header">
        							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       								 <h4 class="modal-title"></h4>
       							</div>
       							<div class="modal-body">
						        	<p></p>
						      	</div>
						    </div>
						  </div>
						</div>
                    	<!-- Fil d'arianne -->
                    	<div>
					        <ul class="breadcrumb">
					        <?php 
					        foreach($filArianne as $titre => $lien)
					        {
					        	if ($lien != 'final')
					        	{
					        	?>
					        	 <li>
					            	<a href="<?php echo $lien; ?>"><?php echo $titre ?></a> <span class="divider"></span>
					          	</li>
					        	<?php 
					        	}
					        	else 
					        	{
					        		?>
					        		<li class="active"><?php echo $titre ?></li>
					        		<?php
					        	}
					        }
					        ?>
					        </ul>
				      	</div>				      	
                        <?php include_once('../controleur/' . $page . '.php'); ?>
                    </div>
                    <?php 
                    	if(isset($_SESSION['cours']) && !empty($_SESSION['cours']))
                    	{
                    ?>
	                    <div class="col-xs-12 col-sm-12 col-md-2">
                        	<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">
										<a style="display: block;" href="index.php?section=objectif"><i class="glyphicon glyphicon-leaf"></i>&nbsp;&nbsp;Mes Badges</a>
									</h3>
								</div>
								<div class="panel-body">
									<?php 
									foreach ($listeAssignationsObjectifs as $assignation)
									{
										if ($assignation->getPourcentage() >= 100)
										{
											$objectif = str_replace(' ', '_', $assignation->getObjectif()->getObjectif()); 
											$objectif = stripAccents($objectif);
									?>
										
											<div class="col-xs-4 col-sm-2 col-md-12 col-lg-6 text-center" style="overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;">
												<img width="50px" height="50px" src="<?php echo '../../images/Badges/' . $objectif . '.png'; ?>" alt="<?php echo $assignation->getObjectif()->getObjectif(); ?>" title="<?php echo $assignation->getObjectif()->getDescription(); ?>" />
												<br>
												<span class="bold"><?php echo $assignation->getObjectif()->getObjectif(); ?></span>
											</div>
									<?php 
										}
									}
									?>
								</div>
							</div>
	                    </div>
	                <?php 
	                }
			        ?>
                </div>
            </div>
            <!--/container-->
		</div>
        <!-- footer -->
        <div id="footer" <?php if(isset($_SESSION['cours'])) echo 'style="background-color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>
        	<div class="container">
				  <div class="col-xs-12 col-md-4 col-md-offset-2">
				  	<h4>A Propos</h4>
				  	MyStudyCompanion est un outil de gestion de cours pour les étudiants et les enseignants
			  	  </div>
				  <div class="col-xs-6 col-md-2">
				  	<h4>Statistiques</h4>
				  	<i class="glyphicon glyphicon-user"></i><?php echo "&nbsp;".$daoEtudiant->count();?> Inscrits
				  	<br>
				  	<i class="glyphicon glyphicon-book"></i><?php echo "&nbsp;".$daoCours->count();?> Cours
		  		  </div>
				  <div class="col-xs-6 col-md-2">
				  	<h4>Aide</h4>
				  	<a href ="#" <?php if(isset($_SESSION['cours'])) echo 'style="font-weight: bold; text-decoration: underline; color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>Contact</a>
				  	<br>
				  	<a href ="#"<?php if(isset($_SESSION['cours'])) echo 'style="font-weight: bold; text-decoration: underline; color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>FAQ</a>
				  </div>
				  <div class="col-xs-12 col-md-4 col-md-offset-2">
				  	MyStudyCompanion - Tous droits réservés
				  </div>
				  <div class="col-xs-12 col-md-4">
				  	<a href ="#" <?php if(isset($_SESSION['cours'])) echo 'style="font-weight: bold; text-decoration: underline; color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>Conditions générales d'utilisation</a>
				  </div>
			</div>
        </div> 
        <!-- /footer -->     
        <script type='text/javascript' src="../../js/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="../../js/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="../../js/bootstrap/dataTables.bootstrap.js"></script>
		<script type="text/javascript" src="../../js/bootstrap/dataTablePerso.js"></script>
		<script type="text/javascript" src="../../js/bootstrap/bootstrap-alert.js"></script>
		<script type="text/javascript" src="../../js/bootstrap/bootstrap-tour.min.js"></script>
		<script type="text/javascript" src="../../js/bootstrap/typeahead.js"></script>
		<script type="text/javascript" src="../../js/bootstrap/handlebars.js"></script>
		<script type="text/javascript" src="../../js/bootstrap/jquery.validate.min.js"></script>
		<script type="text/javascript" src='../../js/googleChartAPI.js'></script>
        <!--Integration des fichiers js de chaque page-->
        <?php if (file_exists("../js/" . $pageWithoutPath . ".js"))
        {
        ?>
        	<script type="text/javascript" src="../js/<?php echo ($pageWithoutPath . ".js"); ?>"></script>
        <?php 
        }
        elseif (file_exists("../../js/" . $pageWithoutPath . ".js")) 
        {
        ?>
        	<script type="text/javascript" src="../../js/<?php echo ($pageWithoutPath . ".js"); ?>"></script>
        <?php 
        }
        ?>
        <script type="text/javascript" src="../../js/commun.js"></script>
    </body>
</html>
