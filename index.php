<?php
include_once ('lib/autoload.inc.php');
$db = DBFactory::getMysqlConnexionStandard ();
session_start();
$_SESSION['referrer'] = Outils::currentPageURL();

if (isset($_SESSION['mailEnvoye']))
{
	unset($_SESSION['mailEnvoye']);
	$alerte = new AlerteSuccess('Mail de réinitialisation du Mot de passe envoyé !');
	$alerte->show_racine();
}

if (isset($_SESSION['typeFichierInvalide']))
{
	unset($_SESSION['typeFichierInvalide']);
	$alerte = new AlerteWarning('Extension de fichier invalide ! (valides : .jpeg, .jpg, .gif, .bmp, .png)');
	$alerte->show_racine();
}

if (isset($_SESSION['nomFichierInvalide']))
{
	unset($_SESSION['nomFichierInvalide']);
	$alerte = new AlerteWarning('Nom de fichier invalide !');
	$alerte->show_racine();
}

if (isset($_SESSION['pseudoUtilise']))
{
	unset($_SESSION['pseudoUtilise']);
	$alerte = new AlerteWarning('Pseudo déjà attribué !');
	$alerte->show_racine();
}

if (isset($_SESSION['cleInvalide']))
{
	unset($_SESSION['cleInvalide']);
	$alerte = new AlerteWarning('Clé Enseignant invalide !');
	$alerte->show_racine();
}

if (isset($_SESSION['utilisateurInconnu']))
{
	unset($_SESSION['utilisateurInconnu']);
	$alerte = new AlerteWarning('Utilisateur inconnu !');
	$alerte->show_racine();
}

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
	<link href="css/bootstrap/bootstrapValidator.min.css" rel="stylesheet">
	<link href="css/bootstrap/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="screen" href="css/login.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/login-orange.css">
	
	
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
	<link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
</head>
<body>
	<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8" style="height: 100%;">
		<div id="form-login" class="col-xs-12 col-sm-12 col-md-7">
			<?php 
			$daoOubliPassword = new DAOOubliPassword($db);
			if(isset($_GET["cle"]) && !empty($_GET["cle"]) && $daoOubliPassword->existsByCle($_GET["cle"]))
			{
				include_once('oubli_password.php');
			}
			else 
			{
			?>
        	<ul id="loginTab" class="nav tabs" style="font-weight: bold;">
        		<li class="active"><a href="#companion" data-toggle="tab">MyStudyCompanion</a></li>
        		<li><a href="#login" data-toggle="tab">Connexion</a></li>
	          	<li><a href="#register" data-toggle="tab">Inscription</a></li>
	          	<li><a href="#reset" data-toggle="tab">Mot de passe oublié</a></li>
	      	</ul>
	      	<div id="loginTabContent" class="tab-content form-login-content">
	      		<div class="tab-pane fade active in" id="companion">
	          		<h1>MyStudyCompanion</h1> 
	          		<p>MyStudyCompanion est un outil de gestion de cours pour les étudiants et les enseignants.</p>
					<div class="col-xs-6 col-sm-6">
					  	<h2>Statistiques</h2>
					  	<i class="glyphicon glyphicon-user"></i><?php $daoEtudiant= new DAOEtudiant($db); echo "&nbsp;".$daoEtudiant->count();?> Inscrits
				  		<br>
				  		<i class="glyphicon glyphicon-book"></i><?php $daoCours = new DAOCours($db); echo "&nbsp;".$daoCours->count();?> Cours
		  		  	</div>
				  	<div class="col-xs-6 col-sm-6">
					  	<h2>Aide</h2>
					  	<a href ="#">Contact</a>
					  	<br>
					  	<a href ="#">FAQ</a>
				  	</div>
				  	<div class="col-xs-12 col-sm-12" style="margin-top: 10px;">
				  		MyStudyCompanion - Tous droits réservés
				  	</div>
				  	<div class="col-xs-12 col-sm-12" style="margin-top: 10px; margin-bottom: 20px;">
				  		<a href ="#">Conditions générales d'utilisation</a>
			  		</div>
		        </div>
	        	<div class="tab-pane fade" id="login">
	          		<h1>Connexion</h1> 
	          		<p>Veuillez vous connecter avec votre Identifiant et votre Mot de passe.</p>
			  		<form id="form_connexion" class="form-horizontal" method="post" action="requete/rq_connexion.php?connexion">
				    	<div class="form-group has-feedback">
				        	<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
				        		<input type="text" name="pseudo_conn" id="pseudo_conn" class="form-control" placeholder="Identifiant" />
					            <span class="glyphicon form-control-feedback" id="pseudo_conn1"></span>
					       	</div>
					    </div>
					    <div class="form-group has-feedback">
					        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
					        	<input type="password" name="password_conn" id="password_conn" class="form-control" placeholder="Mot de passe" />
					            <span class="glyphicon form-control-feedback" id="password_conn1"></span>
					       	</div>
					    </div>
					    <button type="submit" class="btn btn-primary">Connexion</button>
					    <button	type="reset" class="btn btn-default">Effacer</button>
					</form>
		        </div>
		        <div class="tab-pane fade" id="register">
	          		<h1>Inscription</h1> 
		          	<p>Veuillez remplir les différents champs pour vous inscrire.</p>
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
					    <button type="submit" class="btn btn-primary">Inscription</button>
					    <button	type="reset" class="btn btn-default">Effacer</button>
					</form>
	        	</div>
	        	<div class="tab-pane fade" id="reset">
	          		<h1>Mot de passe oublié</h1> 
		          	<p>Veuillez renseigner votre Identifiant et votre E-mail. Vous recevrez un e-mail pour réinitialiser votre Mot de passe.</p>
			  		<form id="form_oubli_mdp" class="form-horizontal" method="post" action="requete/rq_oubli_mdp.php?oubli_mdp">
				    	<div class="form-group has-feedback">
				        	<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
				        		<input type="text" name="pseudo_oubli" id="pseudo_oubli" class="form-control" placeholder="Identifiant" />
					            <span class="glyphicon form-control-feedback" id="pseudo_oubli1"></span>
					       	</div>
					    </div>
					    <div class="form-group has-feedback">
					        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
					        	<input type="text" name="email_oubli" id="email_oubli" class="form-control" placeholder="E-mail" />
					            <span class="glyphicon form-control-feedback" id="email_oubli1"></span>
					       	</div>
					    </div>
					    <button type="submit" class="btn btn-primary">Envoyer</button>
					    <button	type="reset" class="btn btn-default">Effacer</button>
					</form>
		        </div>
	      	</div>
	      	<?php 
			}
			?>
	  	</div>
  	</div>
  	<!-- /Container -->  	

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
		
	<script type="text/javascript" src="js/index.js"></script>



	<script type="text/javascript" language="javascript"
		src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

</body>
</html>