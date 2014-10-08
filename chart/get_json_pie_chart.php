<?php
include_once('../sql/connexion_mysql.php');

include_once('../modele/sql/DAOAvancement.php');
include_once('../modele/sql/DAOMysqli.php');
include_once('../modele/sql/DBFactory.php');
$db = DBFactory::getMysqlConnexionWithMySQLi();

if ($_GET['user'] != -1)
{
	$progression = (int)$daoAvancement->getByThemeEtudiant($_GET['theme'], $_GET['user']);
}
else
{
	$progression = (int)$daoAvancement->getByTheme($_GET['theme']);
}

$table = array();
$table['cols'] = array(
    array('label' => 'faitpasfait', 'type' => 'string'),
    array('label' => 'nombre', 'type' => 'number')
);

$daoAvancement = new DAOAvancement($db);
$rows = array();
$temp = array();
$temp[] = array('v' => 'Fait');
$temp[] = array('v' => $progression); 
$rows[] = array('c' => $temp);
$temp = array();
$temp[] = array('v' => 'Restant');
$temp[] = array('v' => (100 - $progression)); 
$rows[] = array('c' => $temp);

$table['rows'] = $rows;

$jsonTable = json_encode($table);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo $jsonTable;
?>