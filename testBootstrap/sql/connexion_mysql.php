<?php

//parametres de connection

$server = 'localhost'; //'sql.franceserv.fr'; //Adresse Serveur MySQL
$user = 'root'; //'projetir'; //Utilisateur
$mdp = ''; //vivele54'; //Mot de Passe
$base = 'apprentissage'; //'projetir_db1'; // Base de Données
//Connexion eu serveur mysql
$db = mysql_connect($server, $user, $mdp) or die("erreur de connexion");

//connexion a la basegip
mysql_select_db($base, $db) or die("erreur de selection base");
mysql_query("SET NAMES UTF8");  //indique avec quel jeu de caractères on envoie les données à MySQL, 
                                //quel que soit le jeu utilisé dans la colonne cible
?>