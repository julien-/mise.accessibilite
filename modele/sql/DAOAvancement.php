<?php
include_once('DAOMysqli.php');

class DAOAvancement extends DAOMysqli
{
	public function saveOrUpdate(Avancement $avancement)
	{
		if (!$this->exists($avancement))
			$this->executeQuery('INSERT INTO avancement SET id_etu = ' . $avancement->getEtudiant()->getId() . ', id_exo = ' . $avancement->getExercice()->getId() . ', fait = ' . $avancement->getFait() . ', compris = ' . $avancement->getCompris() . ', assimile = ' . $avancement->getAssimile() . ', id_seance = ' . $avancement->getSeance()->getId());
		else 
			$this->executeQuery('UPDATE avancement SET id_etu = ' . $avancement->getEtudiant()->getId() . ', id_exo = ' . $avancement->getExercice()->getId() . ', fait = ' . $avancement->getFait() . ', compris = ' . $avancement->getCompris() . ', assimile = ' . $avancement->getAssimile() . ', id_seance = ' . $avancement->getSeance()->getId() . ' WHERE id_etu = ' . $avancement->getEtudiant()->getId() . ', id_exo = ' . $avancement->getExercice()->getId());
	}
	
	public function exists(Avancement $avancement)
	{
		$result = $this->executeQuery('SELECT * FROM avancement WHERE id_etu = ' . $avancement->getEtudiant()->getId() . ' AND id_exo = ' . $avancement->getExercice()->getId() . ' AND id_seance = ' . $avancement->getSeance()->getId());
		
		return $this->countRows($result) > 0;
	}
	
	public function deleteByExercice($id)
	{
		$this->executeQuery('DELETE FROM avancement WHERE id_exo = ' . $id);
	}
	
	public function deleteByEtudiant($id)
	{
		$this->executeQuery('DELETE FROM avancement WHERE id_etu = ' . $id);
	}
	
	function getByThemeEtudiant($idTheme, $idEtudiant)
	{
		$sql = 'CREATE TEMPORARY TABLE R1
            SELECT COUNT(*) * 100 as total
            FROM exercice
            WHERE id_theme = ' . $_GET['theme'];
		
		$this->executeQuery($sql);
		
		$sql = 'CREATE TEMPORARY TABLE R2
            SELECT SUM(fait+compris+assimile) as progression FROM theme t, avancement a, exercice e
            WHERE t.id_theme = e.id_theme
            AND e.id_exo = a.id_exo
            AND id_etu = ' . $_GET['user'] . '
            AND t.id_theme = ' . $_GET['theme'];
		
		$this->executeQuery($sql);
		
		$sql = 'SELECT progression, total
            FROM R1, R2';
		
		$result = $this->executeQuery($sql);
		 
		$avancement = $this->fetchArray($result);
		
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
  	
  	$this->executeQuery($sql);
  	
  	$sql = 'CREATE TEMPORARY TABLE R2
        SELECT SUM(fait+compris+assimile) as progression
        FROM theme t, avancement a, exercice e
        WHERE t.id_theme = e.id_theme
        AND e.id_exo = a.id_exo
        AND t.id_theme = ' . $idTheme;
  	
  	$this->executeQuery($sql);
  	
  	$sql = 'CREATE TEMPORARY TABLE R3
            SELECT COUNT(*) as nbEtudiants
            FROM etudiant';
  	
  	$this->executeQuery($sql);
  	
  	$sql = 'SELECT progression, total * nbEtudiants as total
        FROM R3, R2, R1';
  	
  	$result = $this->_db->query($sql) or die (mysql_error());
  	
  	$avancement = $this->fetchArray($result);
	
  	if ($avancement['total'] == 0)
  		return 0;
  	
  	return number_format(($avancement['progression'] / $avancement['total']) * 100, 2);
  }
  
  function getByCours($idCours)
  {
  	
  	$sql = '    SELECT e.id_exo '
  			. ' FROM exercice e, theme t '
  			. ' WHERE t.id_theme = e.id_theme '
  					. ' AND id_cours = ' . $idCours;
  	
  	$reqTotal = $this->executeQuery($sql);
  	$total = $this->countRows($reqTotal);
  	
  	$sql = 'SELECT e.id_etu FROM etudiant e';
  	$reqTotalEtudiant = $this->executeQuery($sql);
  	$totalEtudiant = $this->countRows($reqTotalEtudiant);
  	
  	$total = $total * $totalEtudiant * 100;

  	$sql = 'SELECT SUM( assimile + compris + fait ) AS progression
            FROM avancement a, theme t, exercice e
            WHERE a.id_exo = e.id_exo
            AND t.id_theme = e.id_theme
            AND id_cours = ' . $idCours;
  	
  	$reqProgression = $this->executeQuery($sql);

  	$avancement = $this->fetchArray($reqProgression);
  	
  	if ($total == 0)
  		return 0;
  	
  	return number_format(($avancement['progression'] / $total) * 100, 2);
  }
  
  function getByCoursEtudiant($idCours, $idEtudiant)
  {
  	$sqlEtudiant = ' AND id_etu = ' . $idEtudiant . ' ';
  	
  	$sql = '    SELECT e.id_exo '
  			. ' FROM exercice e, theme t '
  			. ' WHERE t.id_theme = e.id_theme '
  					. ' AND id_cours = ' . $idCours;

  	$req_total = $this->executeQuery($sql) or die (mysql_error());
  	$total = $this->countRows($req_total);
  	
  	$total = $total * 100;
  	
  	$sql = 'SELECT SUM( assimile + compris + fait ) AS progression
            FROM avancement a, theme t, exercice e
            WHERE a.id_exo = e.id_exo
            AND t.id_theme = e.id_theme
            AND id_cours = ' . $idCours . $sqlEtudiant;
  	
  	$req_progression = $this->executeQuery($sql);
  	$avancement = $this->fetchArray($req_progression);
  	
  	return number_format(($avancement['progression'] / $total) * 100, 2);
  }
}
