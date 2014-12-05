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
        <link href="../../css/bootstrap/datepicker/datepicker3.css" rel="stylesheet">
        <link href="../../css/perso/index.css" rel="stylesheet">
         <link href="../../css/perso/menu.css" rel="stylesheet">
        <link href="../../css/typeahead.css" rel="stylesheet">
        <link href="../../css/perso/general.css" rel="stylesheet">
        <link href="../../css/tableau.css" rel="stylesheet">
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
        <!-- CSS code from Bootply.com editor -->
    </head>

    <!-- HTML code from Bootply.com editor -->

    <body class="main">
        <div id="wrap">
            <!-- Header -->            
            <nav class="navbar navbar-default" role="navigation">
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
                    if (isset($_SESSION['cours']))
                    {
                    ?>
                            <li id="gestion" class="<?php if (isset($_GET['section']) && $_GET['section'] == 'gestion_cours') echo "active border_bottom_5px_selected"; else echo "border_bottom_5px_nocolor"?>"><a href="index.php?section=gestion_cours">Gestion du cours</a></li>
                            <li id="seance" class="<?php if (isset($_GET['section']) && $_GET['section'] == 'seance') echo "active border_bottom_5px_selected"; else echo "border_bottom_5px_nocolor"?>"><a href="index.php?section=seance">Séances</a></li>
                        	<li id="etudiants" class="<?php if (isset($_GET['section']) && $_GET['section'] == 'mes_etudiants') echo "active border_bottom_5px_selected"; else echo "border_bottom_5px_nocolor"?>"><a href="index.php?section=mes_etudiants">Etudiants</a></li>
                        	<li id="statistiques" class="<?php if (isset($_GET['section']) && $_GET['section'] == 'details_cours') echo "active border_bottom_5px_selected"; else echo "border_bottom_5px_nocolor"?>"><a href="index.php?section=details_cours">Statistiques</a></li>
                    		<li id="forum" class="<?php if (isset($_GET['section']) && $_GET['section'] == 'index_forum') echo "active border_bottom_5px_selected"; else echo "border_bottom_5px_nocolor"?>"><a href="index.php?section=index_forum">Forum</a></li>
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
                    <div class="col-lg-2">
                    	<div class="row">
                    		<div class="col-lg-12 center-text">
            		 			<button id="help" data-demo class="pointer btn btn-danger"><span class="glyphicon glyphicon-question-sign"></span> Besoin d'aide ?</button>
            		 		</div>
            			</div>
            			<hr>
            			
            			<div class="col-lg-12" style="background-color: #f5f5f5; height: 100%; ">
            				<div class="row">
		                        <div class="list-group" style="padding: 2%">
		                        	<a href="index.php?section=cours" class="<?php if($page == "cours") echo "list-group-item active"; else echo "list-group-item";?>">
		                        		<i class="glyphicon glyphicon-th-list"></i>
								        <span style="font-size: x-large;">Mes cours</span>
								   	</a>
		                        	<?php
		                        	if (sizeof($listeCours) > 0)
		                        	{
			                            foreach ($listeCours as $cours) 
			                            {
			                            ?>
			                        	<a id="cours-accordion-<?php echo $cours->getId(); ?>" href="index.php?section=gestion_cours&c=<?php echo $cours->getId(); ?>" class="cut-text <?php if($page != 'cours' && isset($_SESSION['cours']) && $_SESSION['cours']->getId() ==  $cours->getId()) echo "list-group-item active"; else echo "list-group-item";?>" title="<?php echo $cours->getLibelle();?>">
										   <?php echo $cours->getLibelle();?>
										</a>
										<?php
			                            }
		                        	}
		                            ?>
		                        </div>
	                        </div>
                        <?php  if ($page == 'gestion_cours') include_once('../controleur/gauche_gestion_fichier.php');?>
                    	</div>
                    </div>
                    <div class="col-lg-9 main-container" id="main">
                          <div>
					        <ul class="breadcrumb cut-text">
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
					        		<li title="<?php if (!isset($_GET['section']) || $_GET['section'] == 'cours') echo "Mes cours" ?>" class="active"><?php echo $titre ?></li>
					        		<?php
					        	}
					        }
					        ?>
					        </ul>
					      </div>
                        <?php include_once('../controleur/' . $page . '.php'); ?>
                    </div>	
                    <div id="sidebar" class="span3 scrollDiv" style="display: none; width: 200px;">
	                    <div class="col-sidebar col-lg-12 height-100" style="background-color: #f5f5f5;">
	                        <div class="list-group" style="padding: 2%">
	                        
	                        	<?php
	                        	if (isset($_SESSION['cours']) && sizeof($listeConnectes) > 0)
	                        	{
	                        		?>
	                        		<span style="font-size:8pt; font-weight: bold;">
	                        		<?php echo sizeof($listeConnectes);?> utilisateur(s) connecté(s)
	                        		</span>
	                        		<hr>
	                        		<ul class="paddingmargin0">
	                        		<?php
		                            foreach ($listeConnectes as $connecte) 
		                            {
		                            	if($connecte->getEtudiant()->getCode_lien() != NULL)
		                            	{
		                            		$chemin = $daoEtudiant->getCheminByCodeLienAndEtu($connecte->getEtudiant()->getCode_lien(),$connecte->getEtudiant()->getId());
		                            		?>
		                            		<li class="paddingmargin0 cut-text">
	                            				<a title="<?php echo $connecte->getEtudiant()->getPrenomNom(); ?>" href="index.php?section=envoyer_messagerie&dest=<?php echo $connecte->getEtudiant()->getId();?>">
		                            				<img class="profile-image img-circle" width="20" height="20" src="../../upload/<?php echo $chemin; ?>" alt="avatar" title="<?php echo $connecte->getEtudiant()->getPrenomNom();?>"/>
		                            				<?php echo $connecte->getEtudiant()->getPrenomNom();?>
	                            				</a>
                            				</li>
                            				<?php 
                            			}
                            			else 
                            			{
                            				?>			
                            				<li>
	                            				<a>
		                            				<i class="glyphicon glyphicon-user" title="<?php echo $connecte->getEtudiant()->getPrenomNom();?>"></i></a>
		                            				<?php echo $connecte->getEtudiant()->getPrenomNom();?>
	                            				</a>
                            				</li>
                            				<?php 
                            				}
		                            }
		                            ?>
		                            </ul>
		                            <?php 
	                        	}
	                        	else if (sizeof($listeConnectes) <= 0)
	                        	{
									?>
									<span style="font-size:8pt; font-weight: bold;">
										Aucun utilisateur connecté
									</span>
									<?php
	                        	}
	                            ?>
	                        </div>
	                        <?php  if ($page == 'gestion_cours') include_once('../controleur/gauche_gestion_fichier.php');?>
	                    </div>
                    </div>
                    <a id="toggleSidebar" href="#" class="toggles <?php if (!isset($_SESSION['cours'])) echo 'hidden';?>"><i class="fa fa-angle-double-left"></i></a>				
                </div><!--/row-->
            </div><!--/container-->
        </div><!-- /wrap -->
        <!-- footer -->
        <div id="footer">
        	<div class="container" >
        		<div class="row">
        			<div class="col-lg-3" style="border-bottom: 5px solid #ff7a00;">
        			
        			</div>
        			<div class="col-lg-3" style="border-bottom: 5px solid #00aaea;">
        			
        			</div>
        			<div class="col-lg-3" style="border-bottom: 5px solid #c5168a;">
        			
        			</div>
        			<div class="col-lg-3" style="border-bottom: 5px solid #06b709;">
        			
        			</div>
        		</div>
	            <div class="row">
				  <div class="col-sm-4 col-sm-offset-2">
				  	<h4>A Propos</h4>
			  	  </div>
				  <div class="col-sm-2">
				  	<h4>Statistiques</h4>
		  		  </div>
				  <div class="col-sm-2">
				  	<h4>Aide</h4>
				  </div>
				</div> 
				<div class="row">
				  <div class="col-sm-4 col-sm-offset-2">
				  	MyStudyCompanion est un outil de gestion de cours pour les étudiants et les enseignants
				  </div>
				  <div class="col-sm-2"><i class="glyphicon glyphicon-user"></i><?php echo "&nbsp;".$daoEtudiant->count();?> Inscrits<br><i class="glyphicon glyphicon-book"></i><?php echo "&nbsp;".$daoCours->count();?> Cours</div>
				  <div class="col-sm-2"><a href ="#">Contact</a><br><a href ="#">FAQ</a></div>
				</div>
				<div class="row" style="margin-top: 10px;">
				  <div class="col-sm-4 col-sm-offset-2">
				  	MyStudyCompanion - Tous droits réservés
				  </div>
				  <div class="col-sm-4">
				  	<a href ="#">Conditions générales d'utilisation</a>
				  </div>
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
		<script type="text/javascript" src="../../js/bootstrap/datepicker/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="../../js/bootstrap/jquery.validate.min.js"></script>
		<script type="text/javascript" src='../../js/googleChartAPI.js'></script>
		<script type="text/javascript" src="../../js/commun.js"></script>
		<script type="text/javascript" src="../../js/aides/menu.js"></script>
		
        <!--Integration des fichiers js de chaque page-->
        <?php if (file_exists("../../js/" . $pageWithoutPath . ".js")){?>
        <script type="text/javascript" src="../../js/<?php echo ($pageWithoutPath . ".js"); ?>"></script>
        <?php }
        
          if (isset($_SESSION['cours'])){?>
          <script type="text/javascript" src="../../js/aides/menu.js"></script>
          <?php }
          else {?>
          <script type="text/javascript" src="../../js/aides/index.js"></script>
          <?php }?>
         
      
      
        <!--Integration des fichiers aides js de chaque page-->
        <?php /* if (file_exists("../../js/aides/" . $pageWithoutPath . ".js")){?>
        <script type="text/javascript" src="../../js/aides/<?php echo ($pageWithoutPath . ".js"); ?>"></script>
        <?php }*/?>
        
    </body>
</html>