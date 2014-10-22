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
	  	$sql = 'SELECT (SUM(fait+compris+assimile) / (count(e.id_exo) * 100)) * 100 as progression
				FROM theme t, exercice e
				LEFT JOIN avancement a ON e.id_exo = a.id_exo
				AND id_etu = ' . $idEtudiant.'
				WHERE t.id_cours = ' . $idCours.'
				AND e.id_theme = t.id_theme
				GROUP BY t.id_cours';
	  	
	  	$req_progression = $this->executeQuery($sql);
	  	$avancement = $this->fetchArray($req_progression);
	  	
	  	return number_format($avancement['progression'], 2);
  	}
  
  	function getBySeanceEtudiant($idSeance, $idEtudiant)
  	{
	  	$result = $this->executeQuery('SELECT * FROM avancement, theme, exercice 
	  			WHERE avancement.id_etu = ' . $idEtudiant . '
				AND avancement.id_seance = ' . $idSeance .'
				AND avancement.id_exo = exercice.id_exo
	  			AND exercice.id_theme = theme.id_theme');
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
	  	$result = $this->executeQuery('SELECT e.id_exo, titre_exo, num_exo, e.id_theme, titre_theme, COALESCE(fait, 0) AS fait, COALESCE(compris, 0) AS compris, COALESCE(assimile, 0) AS assimile
	  	FROM theme t, exercice e
	  	LEFT JOIN avancement a ON e.id_exo = a.id_exo
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
}
