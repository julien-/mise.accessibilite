<?php
include_once('../lib/autoload.inc.php');

$db = DBFactory::getMysqlConnexionStandard();
$daoAvancement = new DAOAvancement($db);
if (isset($_GET['c']))
{
	$progression = (int)$daoAvancement->getByCoursThemeEtudiant($_GET['c'], $_GET['t'], $_GET['e']);
}
if (isset($_GET['e']))
{
	$progression = (int)$daoAvancement->getByThemeEtudiant($_GET['t'], $_GET['e']);
}
else
{
	$progression = (int)$daoAvancement->getByTheme($_GET['t']);
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