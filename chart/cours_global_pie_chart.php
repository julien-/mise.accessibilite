<?php
include_once('../sql/connexion_mysql.php');
include_once('../fonctions.php');
include_once('../modele/sql/DAOAvancement.php');
include_once('../modele/sql/DAOMysqli.php');
include_once('../modele/sql/DBFactory.php');

$daoAvancement = new DAOAvancement($db);

if(isset($_GET['s']))
{
	$progression = $daoAvancement->getByCoursSeanceEtudiant($_GET['c'], $_GET['s'], $_GET['e']);
}
elseif(isset($_GET['e']))
{
	$progression = $daoAvancement->getByCoursEtudiant($_GET['c'], $_GET['e']);
}
else
{
	$progression = $daoAvancement->getByCours($_GET['c']);
}

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