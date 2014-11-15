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
        <!-- CSS code from Bootply.com editor -->
    </head>

    <!-- HTML code from Bootply.com editor -->

    <body class="main">
        <div id="wrap">
            <!-- Header -->            
            <nav class="navbar navbar-default" role="navigation">
			  <div class="container-fluid">
			    <!--<div class="navbar-header">
			      <a href="index.php"><img src="../../images/logo_titre_centre.png" alt="logo"/></a> 
			    </div>-->
			    <ul class="nav navbar-nav navbar-left">
			    	<li><a role="button" href="index.php">MY STUDY COMPANION</a></li>
			    </ul>
			      <ul class="nav navbar-nav navbar-right">
			        <li><a role="button" href="index.php?section=reception_messagerie"><?php echo $nbMessagesNnLu;?>&nbsp;<i class="glyphicon glyphicon-envelope"></i></a></li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['currentUser']->getPrenom() . ' ' . $_SESSION['currentUser']->getNom(); ?> <span class="caret"></span></a>
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
                    <?php
                    if (isset($_SESSION['cours']))
                    {
                    ?>
                    <div class="collapse navbar-collapse" >
                        <ul class="nav navbar-nav">
                            <li class="<?php if (!isset($_GET['section'])) echo "active";?>"><a href="index.php?section=gestion_cours">Gestion du cours</a></li>
                            <li class="<?php if (isset($_GET['section']) && $_GET['section'] == 'seance') echo "active";?>"><a href="index.php?section=seance">Séances</a></li>
                        	<li class="<?php if (isset($_GET['section']) && $_GET['section'] == 'mes_etudiants') echo "active";?>"><a href="index.php?section=mes_etudiants">Etudiants</a></li>
                        	<li class="<?php if (isset($_GET['section']) && $_GET['section'] == 'details_cours') echo "active";?>"><a href="index.php?section=details_cours">Statistiques</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                    <?php
                    }
                    ?>
                </div>
            </nav>
            <!-- /Header -->

            
            <!-- container -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2" style="background-color: #f5f5f5; height: 100%; ">
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
                        <?php  if ($page == 'gestion_cours') include_once('../controleur/gauche_gestion_fichier.php');?>
                    </div>
                    <div class="col-sm-9 main-container">
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
                    </div>
                </div><!--/row-->
            </div><!--/container-->
        </div><!-- /wrap -->
        <!-- footer -->
        <div id="footer">
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
		<script type="text/javascript" src="../../js/bootstrap/jquery.validate.min.js"></script>
		<script type="text/javascript" src='../../js/googleChartAPI.js'></script>
		<script type="text/javascript" src="../../js/commun.js"></script>
        <!--Integration des fichiers js de chaque page-->
        <?php if (file_exists("../../js/" . $pageWithoutPath . ".js")){?>
        <script type="text/javascript" src="../../js/<?php echo ($pageWithoutPath . ".js"); ?>"></script>
        <?php }?>
       

        <script type="text/javascript">
		// Instance the tour
		
var tour = new Tour({
  steps: [
  {
    element: "#addcours",
    title: "Welcome",
    content: "Welcome to our app, take this tour to be familirized with it.",
    	backdrop:true
  },
  {
    element: "#addcours",
    title: "This Image",
    content: "In this application we generate random placeholder images for any case.",
    backdrop: true
  }  
]
});
		// Initialize the tour
		tour.init();
		 // Added this

		$("#demo").click(function(){
			tour.restart();
			});

		
		</script>
		

    </body>
</html>