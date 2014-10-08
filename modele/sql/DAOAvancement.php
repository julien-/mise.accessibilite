<?php
include_once('DAOMysqli.php');
class DAOAvancement extends DAOMysqli
{
	function getByThemeEtudiant($idTheme, $idEtudiant)
	{
		$sql = 'CREATE TEMPORARY TABLE R1
            SELECT COUNT(*) * 100 as total
            FROM exercice
            WHERE id_theme = ' . $_GET['theme'];
		
		$this->_db->query($sql);
		
		$sql = 'CREATE TEMPORARY TABLE R2
            SELECT SUM(fait+compris+assimile) as progression FROM theme t, avancement a, exercice e
            WHERE t.id_theme = e.id_theme
            AND e.id_exo = a.id_exo
            AND id_etu = ' . $_GET['user'] . '
            AND t.id_theme = ' . $_GET['theme'];
		
		$this->_db->query($sql);
		
		$sql = 'SELECT progression, total
            FROM R1, R2';
		
		$result = $this->_db->query($sql);
		 
		$avancement = $result->fetch_assoc();
		
		if ($avancement['total'] == 0)
			return 0;
		 
		return number_format(($avancement['progression'] / $avancement['total']) * 100, 2);
	}
  function getByTheme($idTheme)
  {
  	$sql = 'CREATE TEMPORARY TABLE R1
        SELECT COUNT(*) * 100 as total
        FROM exercice
        WHERE id_theme = ' . $idTheme;
  	
  	$this->_db->query($sql);
  	
  	$sql = 'CREATE TEMPORARY TABLE R2
        SELECT SUM(fait+compris+assimile) as progression
        FROM theme t, avancement a, exercice e
        WHERE t.id_theme = e.id_theme
        AND e.id_exo = a.id_exo
        AND t.id_theme = ' . $idTheme;
  	
  	$this->_db->query($sql);
  	
  	$sql = 'CREATE TEMPORARY TABLE R3
            SELECT COUNT(*) as nbEtudiants
            FROM etudiant';
  	
  	$this->_db->query($sql);
  	
  	$sql = 'SELECT progression, total * nbEtudiants as total
        FROM R3, R2, R1';
  	
  	$result = $this->_db->query($sql) or die (mysql_error());
  	
  	$avancement = $result->fetch_assoc();
	
  	if ($avancement['total'] == 0)
  		return 0;
  	
  	return number_format(($avancement['progression'] / $avancement['total']) * 100, 2);
  }
}
