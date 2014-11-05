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
if (isset ( $_GET ['section'] ))
	$page = $_GET ['section'];
else
	$page = 'connexion';
session_start ();
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
<link href="css/perso/index.css" rel="stylesheet">
<link href="css/perso/general.css" rel="stylesheet">
<link href="css/tableau.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/<?php echo $page; ?>.css" rel="stylesheet">
<!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
<link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="/bootstrap/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="/bootstrap/img/apple-touch-icon-114x114.png">
<!-- CSS code from Bootply.com editor -->

<style type="text/css">
.navbar-static-top {
	margin-bottom: 20px;
}

i {
	font-size: 18px;
}

footer {
	margin-top: 20px;
	padding-top: 20px;
	padding-bottom: 20px;
	background-color: #efefef;
}

.nav>li .count {
	position: absolute;
	top: 10%;
	right: 25%;
	font-size: 10px;
	font-weight: normal;
	background: rgba(41, 200, 41, 0.75);
	color: rgb(255, 255, 255);
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

<body>
	<div id="wrap">
		<!-- Header -->

		<!-- /Header -->

		<!-- container -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
                        <?php
						include_once ('controleur/' . $page . '.php');
						?>
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



	<script type="text/javascript" language="javascript"
		src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

	<script type="text/javascript">
		$('#tableau').DataTable( {
		    language: {
		    	processing:     "Traitement en cours...",
		        search:         "Rechercher&nbsp;:",
		        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
		        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
		        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
		        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
		        infoPostFix:    "",
		        loadingRecords: "Chargement en cours...",
		        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
		        emptyTable:     "Aucune donnée disponible dans le tableau",
		        paginate: {
		            first:      "Premier",
		            previous:   "Pr&eacute;c&eacute;dent",
		            next:       "Suivant",
		            last:       "Dernier"
		        },
		        aria: {
		            sortAscending:  ": activer pour trier la colonne par ordre croissant",
		            sortDescending: ": activer pour trier la colonne par ordre décroissant"
		        }
		        
			        
		    }
		} );
		</script>
	<!--Integration des fichiers js de chaque page-->
	<script type="text/javascript"
		src="../../js/<?php echo ($page . ".js"); ?>"></script>
	<script type="text/javascript" src="../../js/commun.js"></script>

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