<?php
include_once('../sql/connexion_mysql.php');
require 'jsonwrapper.php';

if ($_GET['user'] == -1)
{
    $sql = 'CREATE TEMPORARY TABLE R1 
            SELECT COUNT(*) * 100 as total, id_exo, titre_exo, num_exo
            FROM exercice 
            WHERE id_theme = ' . $_GET['theme'] . ' 
            GROUP BY id_exo';
    
    mysql_query($sql);
    
    $sql = 'CREATE TEMPORARY TABLE R2 
            SELECT a.id_exo, SUM(fait+compris+assimile) as progression 
            FROM avancement a, theme t, exercice e 
            WHERE t.id_theme = e.id_theme
            AND e.id_exo = a.id_exo 
            AND t.id_theme = ' . $_GET['theme'] . ' 
            GROUP BY a.id_exo ';
    
    mysql_query($sql);
    
    $sql = 'CREATE TEMPORARY TABLE R3
            SELECT COUNT(*) as nbEtudiants
            FROM etudiant';
    
    mysql_query($sql);
    
    $sql = 'SELECT a.id_exo, num_exo, titre_exo, (progression/(total*nbEtudiants))*100 as avancement 
            FROM R3, R1 a
            LEFT JOIN R2 g ON g.id_exo = a.id_exo';
    
    $req_progression = mysql_query($sql) or die (mysql_error());   
}
else
{
    $sql = 'CREATE TEMPORARY TABLE R1 
            SELECT COUNT(*) * 100 as total, id_exo, titre_exo, num_exo
            FROM exercice 
            WHERE id_theme = ' . $_GET['theme'] . ' 
            GROUP BY id_exo';
    
    mysql_query($sql);
    
    $sql = 'CREATE TEMPORARY TABLE R2 
            SELECT a.id_exo, SUM(fait+compris+assimile) as progression 
            FROM avancement a, theme t, exercice e 
            WHERE t.id_theme = e.id_theme 
            AND e.id_exo = a.id_exo 
            AND t.id_theme = ' . $_GET['theme'] . ' 
            AND id_etu = ' . $_GET['user'] . ' 
            GROUP BY a.id_exo ';
    
    mysql_query($sql);
    
    $sql = 'SELECT a.id_exo, num_exo, titre_exo, (progression/(total))*100 as avancement 
            FROM R1 a
            LEFT JOIN R2 g ON g.id_exo = a.id_exo';
    
    $req_progression = mysql_query($sql) or die (mysql_error());   
}

$req_progression = mysql_query($sql) or die (mysql_error());
$table = array();
$table['cols'] = array(
        array('label' => 'Exercice', 'type' => 'string'),
	array('label' => 'Progression', 'type' => 'number'),
        array('role' => 'tooltip', 'type' => 'string', 'p' => array( 'role' => 'tooltip')),
        array('role' => 'style', 'type' => 'string', 'p' => array( 'role' => 'style'))       
);

$rows = array();

while($donnees = mysql_fetch_array($req_progression))
{
        if ((int)$donnees['avancement'] <= 25)
            $color = '#FF6633';
        else if ((int)$donnees['avancement'] > 25 && (int)$donnees['avancement'] <= 75)
            $color = '#FFCC33';
        else
            $color = '#99FF33';
            
        $temp = array();
	$temp[] = array('v' => 'Exercice ' . $donnees['num_exo']);
	$temp[] = array('v' => (int)$donnees['avancement']); 
        $temp[] = array('v' => $donnees['titre_exo'] . ' (' . (int)$donnees['avancement'] . '%)'); 
        $temp[] = array('v' => $color); 
        $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$temp = array('p' => null);
$table['p']= $temp['p'];

$jsonTable = json_encode($table);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo $jsonTable;
?>