<?php
include_once('../sql/connexion_mysql.php');
include_once('../fonctions.php');

if (isset($_GET['e']))
    $etudiant = $_GET['e'];
else
    $etudiant = -1;

if (isset($_GET['ex']))
    $exercice = $_GET['ex'];
else
    $exercice = -1;

$infosProgression = progressionEtudiant($etudiant, $_GET['c'], $exercice);
$table = array();
$table['cols'] = array(

    array('label' => 'Exercice', 'type' => 'string'),
    array('label' => 'Progression', 'type' => 'number'),
    array('role' => 'style', 'type' => 'string', 'p' => array( 'role' => 'style'))    
);

$rows = array();

if ($infosProgression['total'] != 0)
    $progression = (($infosProgression['progression']/($infosProgression['total'])) * 100);
else
    $progression = 0;
if ($progression <= 25)
    $color = '#FF6633';
else if ($progression > 25 && $progression <= 75)
    $color = '#FFCC33';
else
    $color = '#99FF33';
$temp = array();
if (!isset($_GET['t']))
{
    $temp[] = array('v' => 'Progression totale ' . number_format($progression, 2) . '%');
}
else
    $temp[] = array('v' => '');
$temp[] = array('v' => (int)$progression); 
$temp[] = array('v' => $color); 
$rows[] = array('c' => $temp);

$table['rows'] = $rows;
$temp = array('p' => null);
$table['p']= $temp['p'];

$jsonTable = json_encode($table);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo $jsonTable;
?>