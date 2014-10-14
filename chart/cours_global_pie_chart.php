<?php
include_once('../sql/connexion_mysql.php');
include_once('../fonctions.php');
include_once('../modele/sql/DAOAvancement.php');
include_once('../modele/sql/DAOMysqli.php');
include_once('../modele/sql/DBFactory.php');

if (isset($_GET['e']))
    $etudiant = $_GET['e'];
else
    $etudiant = -1;

if (isset($_GET['ex']))
    $exercice = $_GET['ex'];
else
    $exercice = -1;

$daoAvancement = new DAOAvancement($db);
$progression = $daoAvancement->getByCours(1);
$table = array();
$table['cols'] = array(

    array('label' => 'Exercice', 'type' => 'string'),
    array('label' => 'Progression', 'type' => 'number'),
		array('label' => 'Pasfait', 'type' => 'number')
);

$rows = array();


$temp = array();
$temp[] = array('v' => 'Fait');
$temp[] = array('v' => (int)$progression); 
$rows[] = array('c' => $temp);

$temp = array();
$temp[] = array('v' => 'Restant');
$temp[] = array('v' => (100 - $progression));
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