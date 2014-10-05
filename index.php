<?php
session_start();
/* if ($_SESSION['admin'])
  $typeUser = "admin";
  else
  $typeUser = "etudiant";
  header('Location: ' . $typeUser . '/index.php'); */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/style.css" />

        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <title>My Study Companion - Suivez votre progression !</title>

    </head>
    <!--[if IE 6 ]><body class="ie6 old_ie"><![endif]-->
    <!--[if IE 7 ]><body class="ie7 old_ie"><![endif]-->
    <!--[if IE 8 ]><body class="ie8"><![endif]-->
    <!--[if IE 9 ]><body class="ie9"><![endif]-->
    <!--[if !IE]><!--><body><!--<![endif]-->
        <div id="bloc_index">
            <div id="haut_index" align="center" style="text-align: center;">
                <img src="images/logo_titre_centre.png" />
            </div>
            <div id="milieu_index">
                <div class="moitie">
                    <a href="etudiant/index.php">
                        <img src="images/academic.png"/>
                        <p>Etudiant</p>
                    </a>
                </div>
                <div class="moitie">
                    <a href="admin/index.php">
                        <img  src="images/teach.png"/>
                        <p>Enseignant</p>
                    </a>
                </div>
            </div><!--            <div id="bas_index">
                Copyright © 2014 - My Study Companion ® - Tous droits réservés
            </div>-->

        </div>
    </body> 
</html>


