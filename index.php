<?php
include_once ('lib/autoload.inc.php');
$db = DBFactory::getMysqlConnexionStandard ();

if (isset ( $_SESSION ['currentUser'] )) {
	if ($_SESSION ['currentUser']->getAdmin ())
		$typeUser = 'admin';
	else
		$typeUser = 'etudiant';
?>

	<script language="Javascript">
			document.location.replace("<?php echo $typeUser?>/controleur/index.php");
	</script>
<?php
}
if (isset($_SESSION['cours']))
{
	unset($_SESSION['cours']);
}
?><script type="text/javascript"
	src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'>
</script>
<!DOCTYPE html>
<html lang="en" class="full">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>My Study Companion</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport"
		content="width=device-width, initial-scale=1, maximum-scale=1">
	<link
		href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"
		rel="stylesheet">
	<link href="../../css/bootstrap/bootstrapValidator.min.css"
		rel="stylesheet">
	<link href="css/bootstrap/bootstrap.css" rel="stylesheet">
	<link href="css/perso/connexion.css" rel="stylesheet">
	<link href="css/perso/general.css" rel="stylesheet">
	<link href="css/tableau.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
	<link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
</head>
<body>
	<div id="wrap">
		<!-- Header -->
		<nav class="navbar navbar-default" role="navigation">
			  <div id="menu_haut" class="container-fluid">
			  	<div class="row">
                    <div class="menu_gauche col-xs-12 col-sm-6 col-md-offset-2 col-md-4">
						<a class="menu_haut_a" role="button" href="index.php">MY STUDY COMPANION</a>
		      		</div>
			      	<div class="menu_droite col-xs-12 col-sm-6 col-md-4 text-left-xs text-right-sm">
			      		<form role="form" method="post" action="requete/rq_connexion.php?connexion">
			      			<input type="pseudo" name="pseudo" id="pseudo" class="input" placeholder="Pseudo ou email">
							<input type="password" name="mdp" id="mdp" class="input" placeholder="Mot de passe">
							<input type="submit" id="btn-login" class="btn btn-custom btn-lg blue-bg" value="Connexion">
						</form>
			      	</div>
	      	</div>
		  </div>
		</nav>
		<!-- /Header -->

		<!-- container -->
		<div class="container-fluid">
			<div class="row">
					<div class="col-md-offset-2 col-md-8" style="background-color:#FFFFFF;">
                        <div class="col-md-6">
                        	MyStudyCompanion BLABLABLA
                        </div>
                 		<div class="col-md-6">
                        	<h1>Inscription</h1>
                        	<br>
							<form id="form_inscription" class="form-horizontal" method="post" enctype="multipart/form-data" action="requete/rq_inscription.php?inscription">
							    <div class="form-group has-feedback">
							        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
							            <input type="text" name="nom_minuscules" id="nom_minuscules" class="form-control" placeholder="Nom" />
							            <span class="glyphicon form-control-feedback" id="nom_minuscules1"></span>
							       </div>
							    </div>
							    <div class="form-group has-feedback">
							        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
							            <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" />
							            <span class="glyphicon form-control-feedback" id="prenom1"></span>
							        </div>
							    </div>
							    <div class="form-group has-feedback">
							        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
							            <input type="text" name="email" id="email" class="form-control" placeholder="E-mail"  />
							            <span class="glyphicon form-control-feedback" id="email1"></span>
							        </div>
							    </div>
							    <div class="form-group has-feedback">
							        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
							            <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo" />
							            <span class="glyphicon form-control-feedback" id="pseudo1"></span>
							        </div>
							    </div>
							    <!-- Upload photo -->
							    <div class="form-group">
							        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
							            <span class="btn btn-default btn-file">
										    Avatar <i class="glyphicon glyphicon-picture"></i> <input type="file" name="fichier">
										</span>
							        </div>
							    </div> 
							    <div class="form-group has-feedback">
							        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
							            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" />
							            <span class="glyphicon form-control-feedback" id="password1"></span>
							        </div>
							    </div>
							    <div class="form-group has-feedback">
							        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
							            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirmation du mot de passe" />
							            <span class="glyphicon form-control-feedback" id="confirm_password1"></span>
							        </div>
							    </div>	    
							    <div class="form-group">
							        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
							            Enseignant : <input type="checkbox" name="enseignant" id="enseignant"/>
							        </div>
							    </div>	    
							    <div id="cle">
							    </div>	    	      
							    <button type="submit" class="btn btn-primary">S'inscrire</button>
							    <button	type="reset" class="btn btn-default">Annuler</button>
							</form>		
                        </div> 	                        
	                </div>
				<div class="col-sm-1"></div>
			</div>
			<!--/row-->
		</div>
		<!--/container-->
	</div>
	<!-- /wrap -->

	<script type='text/javascript'
		src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type='text/javascript'
		src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript"
		src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript"
		src="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script type="text/javascript" language="javascript"
		src="js/bootstrap/dataTablePerso.js"></script>
	<script type="text/javascript" language="javascript"
		src="js/bootstrap/bootstrapValidator.min.js"></script>
	<script type="text/javascript" language="javascript"
		src="js/bootstrap/bootstrap-alert.js"></script>
	<script type="text/javascript" language="javascript"
		src="js/dataValidatorPerso.js"></script>
		
	<script type="text/javascript" src="js/inscription.js"></script>



	<script type="text/javascript" language="javascript"
		src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

</body>
</html>