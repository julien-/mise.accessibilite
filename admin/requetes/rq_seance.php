<?php 
include_once('../../lib/autoload.inc.php');
session_start();
$db = DBFactory::getMysqlConnexionStandard();
$daoSeance = new DAOSeance($db);



if (isset($_POST['edit']))
{
	$seance = $daoSeance->getByID($_POST['id-seance']);
	$seance->setDate(Outils::dateToUS($_POST['date-seance']));
	$daoSeance->update($seance);
}
echo Outils::dateToUS($_POST['date-seance']);
?>