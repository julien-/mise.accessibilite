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
			  <div class="container-fluid">
			    <!--<div class="navbar-header">
			      <a href="index.php"><img src="../../images/logo_titre_centre.png" alt="logo"/></a> 
			    </div>-->
			    <ul class="nav navbar-nav navbar-left">
			    	<li><a role="button" href="index.php" <?php if(isset($_SESSION['cours'])) echo 'style="color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>MY STUDY COMPANION</a></li>
			    </ul>
			      <ul class="nav navbar-nav navbar-right">
			        <li><a role="button" href="index.php?section=reception_messagerie" <?php if(isset($_SESSION['cours'])) echo 'style="color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>><?php echo $nbMessagesNnLu;?>&nbsp;<i class="glyphicon glyphicon-envelope"></i></a></li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" <?php if(isset($_SESSION['cours'])) echo 'style="color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['currentUser']->getPrenom() . ' ' . $_SESSION['currentUser']->getNom(); ?> <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="index.php?section=compte">Mon compte</a></li>
			            <li class="divider"></li>
	                    <li><a href="../../deconnexion.php"><i class="glyphicon glyphicon-lock"></i>&nbsp;Se déconnecter</a></li>
			          </ul>
			        </li>
			      </ul>

			  </div>
			</nav>
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="container-fluid">
                   	<div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                        	<?php 
                        		if(isset($_SESSION['cours']))
                        		{
                        	?>
                        			<li><a href="index.php?section=informations">Informations</a></li>
                        			<li><a href="index.php?section=objectif">Mes Badges</a></li>
  									<li><a href="index.php?section=evolution">Mon Evolution</a></li>
  									<li class="dropdown">
  										<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
  											Seances <b class="caret"></b>
  										</a>
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
  									<li><a href="index.php?section=progression">Ma Progression</a></li>
  									<li class="dropdown">
  										<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
  											Bonus <b class="caret"></b>
  										</a>
  										<ul class="dropdown-menu" role="menu">
		                                	<li>
	                                        	<a href="index.php?section=mes_bonus" title="Mes bonus">Mes Bonus</a>
                                        	</li>
	                                       	<li>
	                                        	<a href="index.php?section=autres_bonus" title="Autres bonus">Autres bonus</a>
                                        	</li>
		                                </ul>
  									</li>
  									<li><a href="index.php?section=index_forum&id_cours=<?php echo $_SESSION['cours']->getId();?>">Forum</a></li>
                            <?php 
                        		}
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /Header -->
            <!-- container -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-2">
                        <div class="list-group">
                        	<a href="index.php?section=cours" class="<?php if($page == "cours") echo "list-group-item active"; else echo "list-group-item";?>">
                        		<i class="glyphicon glyphicon-th-list"></i>
						        <span style="font-size: x-large; margin-left:5%;">Mes cours</span>
						   	</a>
                        	<?php
                            foreach ($listeCours as $cours) 
                            {
                            ?>
                        	<a href="index.php?section=evolution&id_cours=<?php echo $cours->getCours()->getId(); ?>" class="list-group-item" title="<?php echo $cours->getCours()->getLibelle();?>" <?php if(isset($_SESSION['cours']) && isset($_SESSION['cours']) && $_SESSION['cours']->getId() ==  $cours->getCours()->getId()) echo 'style="font-weight: bold; background-color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>
							   <?php echo $cours->getCours()->getLibelle();?>
							</a>
							<?php
                            }
                            ?>
                        </div>
                    </div>
                    <div id="bloc_page" class="col-xs-12 col-sm-12 col-lg-10">
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
                        <?php include_once('../Controleur/' . $page . '.php'); ?>
                    </div>
                </div>
            </div>
            <!--/container-->
		</div>
        <!-- footer -->
        <div id="footer" <?php if(isset($_SESSION['cours'])) echo 'style="background-color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>
        	<div class="container">
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
				  <div class="col-sm-2"><i class="glyphicon glyphicon-user"></i><?php echo "&nbsp;".$daoEtudiant->count();?> Inscripts<br><i class="glyphicon glyphicon-book"></i><?php echo "&nbsp;".$daoCours->count();?> Cours</div>
				  <div class="col-sm-2"><a href ="#" <?php if(isset($_SESSION['cours'])) echo 'style="font-weight: bold; text-decoration: underline; color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>Contact</a><br><a href ="#"<?php if(isset($_SESSION['cours'])) echo 'style="font-weight: bold; text-decoration: underline; color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>FAQ</a></div>
				</div>
				<div class="row" style="margin-top: 10px;">
				  <div class="col-sm-4 col-sm-offset-2">
				  	MyStudyCompanion - Tous droits réservés
				  </div>
				  <div class="col-sm-4">
				  	<a href ="#" <?php if(isset($_SESSION['cours'])) echo 'style="font-weight: bold; text-decoration: underline; color: '.$daoInscription->getCouleurFond($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).'; color: '.$daoInscription->getCouleurTexte($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId()).';"'; ?>>Conditions générales d'utilisation</a>
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
