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

        <style type="text/css">
            .navbar-static-top {
                margin-bottom:20px;
            }

            i {
                font-size:18px;
            }

            footer {
                margin-top:20px;
                padding-top:20px;
                padding-bottom:20px;
                background-color:#efefef;
            }

            .nav>li .count {
                position: absolute;
                top: 10%;
                right: 25%;
                font-size: 10px;
                font-weight: normal;
                background: rgba(41,200,41,0.75);
                color: rgb(255,255,255);
                line-height: 1em;
                padding: 2px 4px;
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                -ms-border-radius: 10px;
                -o-border-radius: 10px;
                border-radius: 10px;
            }
        </style>
    </head>

    <!-- HTML code from Bootply.com editor -->

    <body  >
        <div id="wrap">
            <!-- Header -->
            <div id="top-nav" class="navbar navbar-inverse navbar-static-top" style="background-color: #f54f4f; margin-bottom: 0px;">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-toggle"></span>
                        </button>
                        <a href="index.php"><img src="../../images/logo_titre_centre.png" alt="logo"/></a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
							<li>
                                <a role="button" href="index.php?section=reception_messagerie" style="color: white;"><i class="glyphicon glyphicon-envelope"></i></a>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#" style="color: white;">
                                <?php if (isset($_SESSION['currentUser']))
                                {?>
                                    <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['currentUser']->getPrenom() . ' ' . $_SESSION['currentUser']->getNom(); ?><span class="caret"></span></a>
                                <?php 
                                }
                                ?>
                                <ul id="g-account-menu" class="dropdown-menu" role="menu">
                                    <li><a href="#"> Mon profil</a></li>
                                    <li><a href="../../deconnexion.php"><i class="glyphicon glyphicon-lock"></i> Se deconnecter</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div><!-- /container -->

            </div>
            <div class="navbar navbar-inverse" role="navigation" style="border-top: 1px solid white;">
                <div class="container">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" >
                        <ul class="nav navbar-nav">
                            <li class="<?php if (!isset($_GET['section'])) echo "active";?>"><a href="index.php">Mes cours</a></li>
                            <li class="<?php if (isset($_GET['section']) && $_GET['section'] == 'seance') echo "active";?>"><a href="index.php?section=seance">Mes séances</a></li>
                        	<li class="<?php if (isset($_GET['section']) && $_GET['section'] == 'mes_etudiants') echo "active";?>"><a href="index.php?section=mes_etudiants">Mes étudiants</a></li>
                        	
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
            <!-- /Header -->

            
            <!-- container -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-1">

                    </div>
                    <div class="col-sm-10">
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
                        <?php include_once($page . '.php'); ?>
                    </div>
                    <div class="col-sm-1">

                    </div>
                </div><!--/row-->
            </div><!--/container-->
        </div><!-- /wrap -->

		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
        <div id="footer">
            <div class="container">
                <p style="text-align: center;">    
                <br/>     
                	<span>Remarques, questions, bugs : <a href="mailto:mystudycompanion@gmail.com">mystudycompanion@gmail.com</a></span>
            		<br/>
            		<span>Copyright © 2014 - My Study Companion ® - Tous droits réservés</span>
            	</p>
            </div>
        </div>

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
        <?php if (file_exists("../../js/" . $pageWithoutPath . ".js")){?>
        <script type="text/javascript" src="../../js/<?php echo ($pageWithoutPath . ".js"); ?>"></script>
        <?php }?>
        <script type="text/javascript" src="../../js/commun.js"></script>

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