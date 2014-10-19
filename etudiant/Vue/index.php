
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>My Study Companion</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/perso/index.css" rel="stylesheet">
        <link href="../../css/tableau.css" rel="stylesheet">
        <link href="../../css/style.css" rel="stylesheet">
        <link href="../../css/<?php echo $page; ?>.css" rel="stylesheet">
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
	                            <li class="dropdown">
	                                <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#" style="color: white;">
                                    <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['currentUser']->getPrenom() . ' ' . $_SESSION['currentUser']->getNom(); ?><span class="caret"></span></a>
	                                <ul id="g-account-menu" class="dropdown-menu" role="menu">
	                                    <li><a href="#">Mon compte</a></li>
	                                    <li><a href="../../deconnexion.php"><i class="glyphicon glyphicon-lock"></i>Se déconnecter</a></li>
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
                    <div class="collapse navbar-collapse" id="example-navbar-collapse">
                        <ul class="nav navbar-nav">
                        	<?php 
                        		if(isset($_SESSION["cours"]) || isset($_GET["id_cours"]))
                        		{
                        	?>
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
  									<li><a href="#">Ma Progression</a></li>
  									<li><a href="index.php?section=bonus">Bonus</a></li>
  									<li><a href="#">Forum</a></li>
                            <?php 
                        		}
                            ?>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
            <!-- /Header -->

            <!-- container -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3">
	                        <hr>
	                        <ul class="list-unstyled">
	                            <li class="nav-header"> 
	                                <a href="index.php?section=cours" data-toggle="collapse" data-target="#userMenu">
	                                    <h3 class="pokemon-red"><i class="glyphicon glyphicon-pencil pokemon-red"></i> Mes cours</h3>
	                                </a>
	                                <hr>
	                                <ul class="nav nav-stacked">
	                                    <?php
	                                    foreach ($listeCours as $cours) {
	                                        ?>
	                                        <li><a class="black" href="index.php?section=evolution&id_cours=<?php echo $cours->getCours()->getId(); ?>" title="<?php echo $cours->getCours()->getLibelle(); ?>"><i class="glyphicon glyphicon-book pokemon-red"></i> <?php echo $cours->getCours()->getLibelle(); ?></a></li>
	                                        <?php
	                                    }
	                                    ?>
	                                </ul>
	                            </li>
	                        </ul>

                    </div>
                    <div class="col-sm-9">
                        <?php include_once('../Controleur/' . $page . '.php'); ?>
                    </div>
                </div><!--/row-->
            </div><!--/container-->
        </div><!-- /wrap -->


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




        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type='text/javascript' src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>







        <!-- JavaScript jQuery code from Bootply.com editor  -->

        <script type='text/javascript'>

            $(document).ready(function() {



            });

        </script>

        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-40413119-1', 'bootply.com');
            ga('send', 'pageview');
        </script>
        <!-- Quantcast Tag -->
        <script type="text/javascript">
            var _qevents = _qevents || [];

            (function() {
                var elem = document.createElement('script');
                elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
                elem.async = true;
                elem.type = "text/javascript";
                var scpt = document.getElementsByTagName('script')[0];
                scpt.parentNode.insertBefore(elem, scpt);
            })();

            _qevents.push({
                qacct: "p-0cXb7ATGU9nz5"
            });
        </script>

    </body>
</html>