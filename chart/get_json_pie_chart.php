<?php
include_once('../sql/connexion_mysql.php');

$cours = $_GET['cours'];
if ($_GET['user'] != -1)
{
    $sql = 'CREATE TEMPORARY TABLE R1 
            SELECT COUNT(*) * 100 as total 
            FROM exercice  
            WHERE id_theme = ' . $_GET['theme'];

    mysql_query($sql);

    $sql = 'CREATE TEMPORARY TABLE R2 
            SELECT SUM(fait+compris+assimile) as progression FROM theme t, avancement a, exercice e 
            WHERE t.id_theme = e.id_theme  
            AND e.id_exo = a.id_exo  
            AND id_etu = ' . $_GET['user'] . ' 
            AND t.id_theme = ' . $_GET['theme'];

    mysql_query($sql);

    $sql = 'SELECT progression, total 
            FROM R1, R2';
}
else
{
    $sql = 'CREATE TEMPORARY TABLE R1 
        SELECT COUNT(*) * 100 as total
        FROM exercice  
        WHERE id_theme = ' . $_GET['theme'];

    mysql_query($sql);
    
    $sql = 'CREATE TEMPORARY TABLE R2 
        SELECT SUM(fait+compris+assimile) as progression 
        FROM theme t, avancement a, exercice e 
        WHERE t.id_theme = e.id_theme  
        AND e.id_exo = a.id_exo  
        AND t.id_theme = ' . $_GET['theme'];

    mysql_query($sql);
    
    $sql = 'CREATE TEMPORARY TABLE R3
            SELECT COUNT(*) as nbEtudiants
            FROM etudiant';
    
    mysql_query($sql);
    
    $sql = 'SELECT progression, total * nbEtudiants as total
        FROM R3, R2, R1';
    
    $req_progression = mysql_query($sql) or die (mysql_error());  
}
$req_progression = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());

$progTotale = 0;
$donnees_progression = mysql_fetch_assoc($req_progression);

$total = $donnees_progression['total'];
$progTotale = $donnees_progression['progression'];
$pasFaits = ($total - $progTotale);

if ($progTotale + $pasFaits <= 0)
{
    $progTotale = 0;
    $pasFaits = 1;
}
$table = array();
$table['cols'] = array(
    array('label' => 'faitpasfait', 'type' => 'string'),
    array('label' => 'nombre', 'type' => 'number')
);

$rows = array();

$temp = array();
$temp[] = array('v' => 'Fait');
$temp[] = array('v' => (int)$progTotale); 
$rows[] = array('c' => $temp);
$temp = array();
$temp[] = array('v' => 'Restant');
$temp[] = array('v' => (int)$pasFaits); 
$rows[] = array('c' => $temp);

$table['rows'] = $rows;

$jsonTable = json_encode($table);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo $jsonTable;
?>