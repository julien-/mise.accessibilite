<?php
include_once('DAOStandard.php');

class DAOAvancement extends DAOStandard
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
	
	public function deleteByEtudiantAndCours($idEtu, $idExo)
	{
		$this->executeQuery('DELETE FROM avancement WHERE id_exo =' . $idExo . ' AND id_etu =' . $idEtu);
	}
	
	public function getAllByCours($id, $limit)
	{
		$this->executeQuery("
				SELECT * 
				FROM avancement a, exercice e, theme t, cours c, etudiant et
				WHERE a.id_exo = e.id_exo
				AND e.id_theme = t.id_theme
				AND c.id_cours = t.id_cours
				AND et.id_etu = a.id_etu
				AND c.id_cours = " . $id ."
				ORDER BY date");
	}
	
	function getByCoursThemeEtudiant($idCours, $idTheme, $idEtudiant)
	{
		$sql = 'CREATE TEMPORARY TABLE TThemes
            SELECT COUNT(*) * 100 as total
            FROM exercice
            WHERE id_theme = ' . $idTheme;
		
		$this->executeQuery($sql);
		
		$sql = 'CREATE TEMPORARY TABLE TCalcultheme
            SELECT SUM(fait+compris+assimile) as progression FROM theme t, avancement a, exercice e
            WHERE t.id_theme = e.id_theme
            AND e.id_exo = a.id_exo
            AND id_etu = ' . $idEtudiant . '
            AND t.id_theme = ' . $idTheme . '
			AND t.id_cours = ' . $idCours;
		
		$this->executeQuery($sql);
		
		$sql = 'SELECT progression, total
            FROM TThemes, TCalcultheme';
		
		$result = $this->executeQuery($sql);
		
		$avancement = $this->fetchArray($result);
		
		$sql = 'DROP TEMPORARY TABLE TThemes;';
		$result = $this->executeQuery($sql);
		
		$sql = 'DROP TEMPORARY TABLE TCalcultheme;';
		$result = $this->executeQuery($sql);
		
		if ($avancement['total'] == 0)
			return 0;
			
		return number_format(($avancement['progression'] / $avancement['total']) * 100, 2);
	}
	
	function getByThemeEtudiant($idTheme, $idEtudiant)
	{
		$sql = 'CREATE TEMPORARY TABLE TThemes
            SELECT COUNT(*) * 100 as total
            FROM exercice
            WHERE id_theme = ' . $idTheme;
		
		$this->executeQuery($sql);
		
		$sql = 'CREATE TEMPORARY TABLE TCalcultheme
            SELECT SUM(fait+compris+assimile) as progression FROM theme t, avancement a, exercice e
            WHERE t.id_theme = e.id_theme
            AND e.id_exo = a.id_exo
            AND id_etu = ' . $idEtudiant . '
            AND t.id_theme = ' . $idTheme;
		
		$this->executeQuery($sql);
		
		$sql = 'SELECT progression, total
            FROM TThemes, TCalcultheme';
		
		$result = $this->executeQuery($sql);
		
		$avancement = $this->fetchArray($result);
		
		$sql = 'DROP TEMPORARY TABLE TThemes;';
		$result = $this->executeQuery($sql);
		
		$sql = 'DROP TEMPORARY TABLE TCalcultheme;';
		$result = $this->executeQuery($sql);
		
		if ($avancement['total'] == 0)
			return 0;
		 
		return number_format(($avancement['progression'] / $avancement['total']) * 100, 2);
	}
	

  	function getByTheme($idTheme)
  	{
  		$daoTheme = new DAOTheme($db);
  		$theme = $daoTheme->getByID($idTheme);
  		$daoExercice = new DAOExercice($db);
  		$daoExercice->getByAllByTheme($idTheme);
  		if (sizeof($daoExercice->getByAllByTheme($idTheme)) > 0)
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
	            FROM inscription
	  			WHERE id_cours =' . $theme->getCours()->getId();
	  	
	  	$this->executeQuery($sql);
	  	
	  	$sql = 'SELECT progression, total * nbEtudiants as total
	        FROM R3, R2, R1';
	  	
	  	$result = $this->executeQuery($sql);
	  	
	  	$avancement = $this->fetchArray($result);
		
	  	if ($avancement['total'] == 0)
	  		return 0;
	  	
	  	$sql = 'DROP TEMPORARY TABLE R1;';
	  	$result = $this->executeQuery($sql);
	  	
	  	$sql = 'DROP TEMPORARY TABLE R2;';
	  	$result = $this->executeQuery($sql);
	  	
	  	$sql = 'DROP TEMPORARY TABLE R3;';
	  	$result = $this->executeQuery($sql);
	  	
	  	return number_format(($avancement['progression'] / $avancement['total']) * 100, 2);
  		}
  		else
  			return 0;
   	}
  
   	function getByExercice($idExo)
   	{   		
   		$sql = 'SELECT e.id_etu FROM inscription e WHERE id_cours =' . $_SESSION['cours']->getId();
   		$req_total_etudiant = mysql_query($sql) or die (mysql_error());
   		$totalEtudiant = mysql_num_rows($req_total_etudiant);
   		
   		$total = $totalEtudiant * 100;
   		
   		$sql = '
   				SELECT SUM( assimile + compris + fait ) AS avancement
	            FROM avancement a, theme t, exercice e
	            WHERE a.id_exo = e.id_exo
	            AND t.id_theme = e.id_theme
				AND e.id_exo = ' . $idExo;

   		$req_progression = mysql_query($sql) or die (mysql_error());
   		$avancement = mysql_fetch_array($req_progression);
   		return number_format(($avancement['avancement'] / $total) * 100, 2);
   	}
   	
   	
  	function getByCours($idCours)
  	{  		
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
	            AND id_cours = ' . $idCours;
	  	
	  	$reqProgression = $this->executeQuery($sql);
	
	  	$avancement = $this->fetchArray($reqProgression);
	  	
	  	if ($total == 0)
	  		return 0;
	  	
	  	$sql = 'SELECT * FROM inscription WHERE id_cours = ' . $idCours;
  	
	  	$result = $this->executeQuery($sql) or die (mysql_error());
	  	
	  	$nbEtuInscrits = $this->countRows($result);
	  	
	  	$progression = $avancement['progression'] / $nbEtuInscrits;
	  
	  	return number_format(($progression / $total) * 100, 2);
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
  	
  	if($avancement['progression'] > 0)
  		return number_format(($avancement['progression'] / $total) * 100, 2);
  	else 
  		return 0;
  }
  
  function getByCoursSeanceEtudiant($idCours, $idSeance, $idEtudiant)
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
  			AND a.id_seance <= ' .$idSeance. '
            AND t.id_theme = e.id_theme
            AND id_cours = ' . $idCours . $sqlEtudiant;
  	 
  	$req_progression = $this->executeQuery($sql);
  	$avancement = $this->fetchArray($req_progression);
  	 
  	return number_format(($avancement['progression'] / $total) * 100, 2);
  }
  
  function getByCoursSeance($idCours, $idSeance)
  {    	
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
  			AND a.id_seance <= ' .$idSeance. '
            AND t.id_theme = e.id_theme
            AND id_cours = ' . $idCours;
  
  	$req_progression = $this->executeQuery($sql);
  	$avancement = $this->fetchArray($req_progression);
  	
  	$sql = 'SELECT * FROM inscription WHERE id_cours = ' . $idCours;
  	
  	$result = $this->executeQuery($sql) or die (mysql_error());
  	
  	$nbEtuInscrits = $this->countRows($result);
  	
  	$progression = $avancement['progression'] / $nbEtuInscrits;
  
  	return number_format(($progression / $total) * 100, 2);
  }
  
  	function getTabByCoursEtudiant($idCours, $idEtudiant)
  	{
	  	$result = $this->executeQuery('SELECT * FROM avancement, theme, exercice, seance
	  			WHERE avancement.id_etu = ' . $idEtudiant . '
				AND avancement.id_exo = exercice.id_exo
	  			AND exercice.id_theme = theme.id_theme
	  			AND theme.id_cours = ' . $idCours);
	  	
	  	$listeAvancement = array();
	  	while ($avancement = $this->fetchArray($result)) {
	  		 
	  		$listeAvancement[] = array('exercice' => array('id' => $avancement['id_exo'],
	  				'titre' => $avancement['titre_exo'],
	  				'numero' => $avancement['num_exo'],
	  				'theme' => array ('id' => $avancement['id_theme'],
	  						'titre' => $avancement['titre_theme'])),
	  				'fait' => $avancement['fait'],
	  				'compris' => $avancement['compris'],
	  				'assimile' => $avancement['assimile']);
	  	}
	  	return $listeAvancement;
  	}
  
  	function getTabBySeanceThemeEtudiant($idSeance, $idTheme, $idEtudiant)
  	{
	  	$result = $this->executeQuery('SELECT e.id_exo, titre_exo, num_exo, e.id_theme, titre_theme, COALESCE(fait, 0) AS fait, COALESCE(compris, 0) AS compris, COALESCE(assimile, 0) AS assimile
	  	FROM theme t, exercice e
	  	LEFT JOIN avancement a ON e.id_exo = a.id_exo
	  	AND id_seance <= '.$idSeance.'
	  	AND id_etu = '.$idEtudiant.'
	  	WHERE e.id_theme = '.$idTheme.'
	  	GROUP BY e.id_exo');
	  	 
	  	$listeAvancement = array();
	  	 
	  	while ($avancement = $this->fetchArray($result)) {
	  			
	  		$listeAvancement[] = array('exercice' => array('id' => $avancement['id_exo'],
	  				'titre' => $avancement['titre_exo'],
	  				'numero' => $avancement['num_exo'],
	  				'theme' => array ('id' => $avancement['id_theme'],
	  						'titre' => $avancement['titre_theme'])),
	  				'fait' => $avancement['fait'],
	  				'compris' => $avancement['compris'],
	  				'assimile' => $avancement['assimile']);
	  	}
	  	return $listeAvancement;
  	}
  
  	
  function getTabByThemeEtudiant($idTheme, $idEtudiant)
  {  	
  	$result = $this->executeQuery('SELECT e.id_exo, titre_exo, num_exo, e.id_theme, titre_theme, COALESCE(SUM(fait), 0) AS fait, COALESCE(SUM(compris), 0) AS compris, COALESCE(SUM(assimile), 0) AS assimile
  	FROM theme t, exercice e
  	LEFT JOIN avancement a ON e.id_exo = a.id_exo
  	AND id_etu = '.$idEtudiant.'
  	WHERE e.id_theme = '.$idTheme.'
  	AND t.id_theme = e.id_theme
  	GROUP BY e.id_exo');
  	
  	$listeAvancement = array();
  	
  	while ($avancement = $this->fetchArray($result)) {
  			
  		$listeAvancement[] = array('exercice' => array('id' => $avancement['id_exo'],
  				'titre' => $avancement['titre_exo'],
  				'numero' => $avancement['num_exo'],
  				'theme' => array ('id' => $avancement['id_theme'],
  						'titre' => $avancement['titre_theme'])),
  				'fait' => $avancement['fait'],
  				'compris' => $avancement['compris'],
  				'assimile' => $avancement['assimile']);
  	}
  	return $listeAvancement;
  }
  
  function getScoreEtudiantCours($idCours, $idEtudiant)
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
  	 
  	return $avancement['progression'];
  }
  
  public function getTotalScoreEtudiant($idEtudiant)
  {
  	$daoInscription = new DAOInscription($db);
  	$score = 0;
  	$listeCours = $daoInscription->getAllByEtudiant($idEtudiant);
  	foreach($listeCours as $cours)
  	{
  		$score = $this->getScoreEtudiantCours($cours->getCours()->getId(), $idEtudiant) + $score;
  	}
  	
  	return $score;
  }
  
  public function insertFaitByExerciceEtudiantSeance($id_exo, $id_etu, $id_seance)
  {
  	$this->executeQuery('INSERT INTO avancement
  							SET id_etu = ' . $id_etu . ',
  							id_exo = ' . $id_exo . ',
  							fait = 25,
  							compris = 0,
  							assimile = 0,
  							date = now(),
  							id_seance = ' . $id_seance);
  }
  
  public function insertComprisByExerciceEtudiantSeance($id_exo, $id_etu, $id_seance)
  {
  	$this->executeQuery('INSERT INTO avancement
  							SET id_etu = ' . $id_etu . ',
  							id_exo = ' . $id_exo . ',
  							fait = 0,
  							compris = 25,
  							assimile = 0,
  							date = now(),
  							id_seance = ' . $id_seance);
  }
  
  public function insertAssimileByExerciceEtudiantSeance($id_exo, $id_etu, $id_seance)
  {
  	$this->executeQuery('INSERT INTO avancement
  							SET id_etu = ' . $id_etu . ',
  							id_exo = ' . $id_exo . ',
  							fait = 0,
  							compris = 0,
  							assimile = 50,
  							date = now(),
  							id_seance = ' . $id_seance);
  }
  
  public function getBySeanceExerciceEtudiant($idSeance, $idExo, $idEtu)
  {
  	$result = $this->executeQuery('SELECT COALESCE(SUM(fait), 0) AS fait, COALESCE(SUM(compris), 0) AS compris, COALESCE(SUM(assimile), 0) AS assimile
  									FROM avancement
  									WHERE id_etu = ' . $idEtu . '
  									AND id_exo = ' . $idExo . '
  									AND id_seance <= '.$idSeance);
  	
  	$avancement = $this->fetchArray($result);
  	 
  	$avancement_pourcentage = $avancement['fait'] + $avancement['compris'] + $avancement['assimile'];
  	 
  	return $avancement_pourcentage;
  }
  
  public function getByExerciceEtudiant($idExo, $idEtu)
  {
  	$result = $this->executeQuery('SELECT COALESCE(SUM(fait), 0) AS fait, COALESCE(SUM(compris), 0) AS compris, COALESCE(SUM(assimile), 0) AS assimile
  									FROM avancement
  									WHERE id_etu = ' . $idEtu . '
  									AND id_exo = ' . $idExo);
  	$avancement = $this->fetchArray($result);
  	
  	$avancement_pourcentage = $avancement['fait'] + $avancement['compris'] + $avancement['assimile'];
  	
  	return $avancement_pourcentage;
  }
  
  public function getAssimileByExercice($idExo)
  {
  	$daoEtudiant = new DAOEtudiant($db);
  	$result = $this->executeQuery('SELECT id_etu
  									FROM avancement
  									WHERE id_exo = ' . $idExo . '
  									AND assimile = 50');
  	if ($result == null)
  		return false;
  	else 
  	{
	  	$listeEtudiants = array();
	  	while ($avancement = $this->fetchArray($result)) {
	  		$listeEtudiants[] = $daoEtudiant->getByID($avancement['id_etu']);
	  	}
	  	return $listeEtudiants;
  	}
  }
  
  public function getTabProgressionSeanceByEtuCours($idEtu, $idCours)
  {  	
  	$sql = 'SELECT e.id_exo 
  			FROM exercice e, theme t
  			WHERE e.id_theme = t.id_theme
  			AND t.id_cours = ' . $idCours;
  	
  	$req_total = $this->executeQuery($sql) or die (mysql_error());
  	$total = $this->countRows($req_total);
  	
  	$total = $total * 100;
  	
  	$sql = 'CREATE TEMPORARY TABLE R1
  	 SELECT id_seance
  	 FROM seance
  	 WHERE id_cours = '. $idCours;
  	  
  	 $result = $this->executeQuery($sql);
  	
  	$sql = 'SELECT SUM( assimile + compris + fait ) AS progression, a.id_seance AS seance
            FROM avancement a, R1
            WHERE a.id_etu = ' . $idEtu . '
            AND a.id_seance = R1.id_seance
  			GROUP BY R1.id_seance';
  	
  	$result = $this->executeQuery($sql);
  	
  	$progression_seance = array();
  	while ($progression = $this->fetchArray($result)) {
  		$progression_seance[] = array( 'seance' => $progression['seance'], 'progression' => number_format(($progression['progression'] / $total) * 100, 2));
  	}
  	return $progression_seance;  	
  }
}
