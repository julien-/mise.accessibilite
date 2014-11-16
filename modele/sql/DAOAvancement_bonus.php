<?php
include_once ('DAOStandard.php');
class DAOAvancement_bonus extends DAOStandard {
	public function saveOrUpdate(Avancement_bonus $avancement_bonus) {
		if (exists ( $avancement_bonus ))
			update ( $avancement_bonus );
		else
			save ( $avancement_bonus );
	}
	public function save(Avancement_bonus $avancement_bonus) {
		$this->executeQuery ( 'INSERT INTO avancement_bonus SET id_etu = ' . $avancement_bonus->getEtudiant ()->getId () . ', id_bonus = ' . $avancement_bonus->getBonus ()->getId () . ', fait =' . $avancement_bonus->getFait () . ' suivi = ' . $avancement_bonus->getSuivi () . ' note= ' . $avancement_bonus->getNote () . ' remarque = ' . $avancement_bonus->getRemarque () );
	}
	public function update(Avancement_bonus $avancement_bonus) {
		$this->executeQuery ( 'UPDATE avancement_bonus SET id_etu = ' . $avancement_bonus->getEtudiant ()->getId () . ', id_bonus = ' . $avancement_bonus->getBonus ()->getId () . ', fait =' . $avancement_bonus->getFait () . ' suivi = ' . $avancement_bonus->getSuivi () . ' note= ' . $avancement_bonus->getNote () . ' remarque = ' . $avancement_bonus->getRemarque () );
	}
	
	public function deleteByBonus($id)
	{
		$this->executeQuery('DELETE FROM avancement_bonus WHERE id_bonus = ' . $id);
	}
	
	public function getNumberBonusByEtudiant($idEtudiant)
	{
		$result = $this->executeQuery('SELECT * FROM avancement_bonus WHERE fait = 1 AND id_etu = ' . $idEtudiant);
		
		return $this->countRows($result);
	}
	
	
	public function insertSuiviByEtuBonus($id_etu, $id_bonus) {
	
		$this->executeQuery ( 'INSERT INTO avancement_bonus
								SET
								id_etu = ' . $id_etu . ', 
								id_bonus = ' . $id_bonus . ',								
								fait = 0,
								suivi = 1');
	}
	
	public function insertFaitByEtuBonus($id_etu, $id_bonus) {
	
		$this->executeQuery ( 'INSERT INTO avancement_bonus
								SET
								id_etu = ' . $id_etu . ',
								id_bonus = ' . $id_bonus . ',
								fait = 1,
								suivi = 0');
	}
	
	public function updateRemarqueByEtuBonus($id_etu, $id_bonus, $remarque) {
		
		$this->executeQuery ( 'UPDATE avancement_bonus 
								SET remarque = "' . $remarque . '"
								WHERE id_bonus = ' . $id_bonus . '
								AND id_etu = ' . $id_etu );
	}
	
	public function updateNoteByEtuBonus($id_etu, $id_bonus, $note) {
	
		$this->executeQuery ( 'UPDATE avancement_bonus
								SET note = ' . $note . '
								WHERE id_bonus = ' . $id_bonus . '
								AND id_etu = ' . $id_etu );
	}
	
	public function getByThemeEtudiantFait($id_theme,$id_etu) {
		
		$daoTheme = new DAOTheme($db);
		
		$result = $this->executeQuery ( 'SELECT *
										FROM avancement_bonus, bonus, theme, cours, cle, etudiant
										WHERE avancement_bonus.id_etu = ' . $id_etu . '
										AND avancement_bonus.fait = 1
										AND avancement_bonus.id_bonus = bonus.id_bonus
										AND bonus.id_theme = ' . $id_theme . '
										AND bonus.id_theme = theme.id_theme
										AND theme.id_cours = cours.id_cours
										AND cours.id_cle = cle.id_cle
										AND cours.id_prof = etudiant.id_etu
										GROUP BY bonus.id_bonus' );
	
		$listeBonus = array();		
		while($avancement_bonus = $this->fetchArray ( $result ))
		{			
			$listeBonus[] = new Bonus ( array (
				'id' => $avancement_bonus ['id_bonus'],
				'titre' => $avancement_bonus ['titre_bonus'],
				'type' => $avancement_bonus ['type_bonus'],
				'theme' => $daoTheme->getByID($avancement_bonus ['id_theme'])
			) );
		}
		return $listeBonus;
	}
	
	public function getByThemeFait($id_theme) {
		
		$daoTheme = new DAOTheme($db);
		
		$result = $this->executeQuery ( 'SELECT *
										FROM avancement_bonus, bonus, theme, cours, cle, etudiant
										WHERE avancement_bonus.fait = 1
										AND avancement_bonus.id_bonus = bonus.id_bonus
										AND bonus.id_theme = ' . $id_theme . '
										AND bonus.id_theme = theme.id_theme
										AND theme.id_cours = cours.id_cours
										AND cours.id_cle = cle.id_cle
										AND cours.id_prof = etudiant.id_etu
										GROUP BY bonus.id_bonus' );
	
		$listeBonus = array();
		while($avancement_bonus = $this->fetchArray ( $result ))
		{
			$listeBonus[] = new Bonus ( array (
					'id' => $avancement_bonus ['id_bonus'],
					'titre' => $avancement_bonus ['titre_bonus'],
					'type' => $avancement_bonus ['type_bonus'],
					'theme' => $daoTheme->getByID($avancement_bonus ['id_theme'])
			) );
		}
		return $listeBonus;
	}
	
	public function getByEtudiantFait($id_etu) {
		
		$daoTheme = new DAOTheme($db);
		
		$result = $this->executeQuery ( 'SELECT *
										FROM avancement_bonus, bonus, theme, cours, cle, etudiant
										WHERE avancement_bonus.id_etu = ' . $id_etu . '
										AND avancement_bonus.fait = 1
										AND avancement_bonus.id_bonus = bonus.id_bonus
										AND bonus.id_theme = theme.id_theme
										AND theme.id_cours = cours.id_cours
										AND cours.id_cle = cle.id_cle
										AND cours.id_prof = etudiant.id_etu
										GROUP BY bonus.id_bonus' );
	
		$listeBonus = array();
		while($avancement_bonus = $this->fetchArray ( $result ))
		{
			$listeBonus[] = new Bonus ( array (
					'id' => $avancement_bonus ['id_bonus'],
					'titre' => $avancement_bonus ['titre_bonus'],
					'type' => $avancement_bonus ['type_bonus'],
					'theme' => $daoTheme->getByID($avancement_bonus ['id_theme'])
			) );
		}
		return $listeBonus;
	}
	
	public function getMoyenneBonus($id_bonus) {
		$result = $this->executeQuery ( 'SELECT AVG(note) AS Moyenne
										FROM avancement_bonus
										WHERE avancement_bonus.id_bonus = ' . $id_bonus . '
										AND avancement_bonus.suivi = 1');
	
		$avancement_bonus = $this->fetchArray ( $result );
		return $avancement_bonus['Moyenne'];
	}
	
	public function getByEtudiantBonus($id_etu, $id_bonus) {
		$result = $this->executeQuery ( 'SELECT *
										FROM avancement_bonus
										WHERE avancement_bonus.id_bonus = ' . $id_bonus . '
										AND avancement_bonus.id_etu = ' . $id_etu . '
										AND avancement_bonus.suivi = 1');
	
		if($avancement_bonus = $this->fetchArray ( $result ))
		{
			$avancement = array();
			
			$avancement['suivi'] = $avancement_bonus['suivi'];
			$avancement['note'] = $avancement_bonus['note'];
			$avancement['remarque'] = $avancement_bonus['remarque'];
			
			return $avancement;
		}
		else
			return null;
	}
	
	public function getCreateurs($id_bonus) {
		
		$daoEtudiant = new DAOEtudiant($db);
		
		$result = $this->executeQuery ( 'SELECT *
										FROM avancement_bonus, etudiant
										WHERE avancement_bonus.id_bonus = ' . $id_bonus . '
										AND avancement_bonus.fait = 1
										AND avancement_bonus.id_etu = etudiant.id_etu');
	
		$listeEtudiants = array();
		while($avancement_bonus = $this->fetchArray ( $result ))
		{
			$listeEtudiants[] = $daoEtudiant->getByID($avancement_bonus ['id_etu']);
		}
		return $listeEtudiants;
	}
	
	public function VerifCreateur($id_bonus,$id_etu) {
		$result = $this->executeQuery ( 'SELECT fait
										FROM avancement_bonus
										WHERE avancement_bonus.id_bonus = ' . $id_bonus . '
										AND avancement_bonus.id_etu = ' . $id_etu);

		$avancement_bonus = $this->fetchArray ( $result );
		if($avancement_bonus['fait'] == '1')
			return true;
		else 
			return false;			
	}
	
	public function countNotesByEtudiantCours($idEtu, $idCours) {
		$sql = 'SELECT * 
				FROM avancement_bonus, bonus, theme
				WHERE avancement_bonus.id_etu = ' .$idEtu . '
				AND avancement_bonus.suivi = 1
				AND avancement_bonus.note IS NOT NULL 
				AND avancement_bonus.id_bonus = bonus.id_bonus
				AND bonus.id_theme = theme.id_theme
				AND theme.id_cours = ' .$idCours;
		$ressource = $this->executeQuery($sql);
	
		return $this->countRows($ressource);
	}
	
	public function countFaitByEtudiantCours($idEtu, $idCours) {
		$sql = 'SELECT * 
				FROM avancement_bonus, bonus, theme
				WHERE avancement_bonus.id_etu = ' .$idEtu . '
				AND avancement_bonus.fait = 1
				AND avancement_bonus.id_bonus = bonus.id_bonus
				AND bonus.id_theme = theme.id_theme
				AND theme.id_cours = ' .$idCours;
		$ressource = $this->executeQuery($sql);
	
		return $this->countRows($ressource);
	}
	
	public function countNotesRecuesEgal5ByEtudiantCours($idEtu, $idCours){
		
		$sql = 'CREATE TEMPORARY TABLE R1
				SELECT avancement_bonus.id_bonus
				FROM avancement_bonus, bonus, theme
				WHERE avancement_bonus.id_etu = '.$idEtu.'
				AND avancement_bonus.fait = 1
				AND avancement_bonus.id_bonus = bonus.id_bonus
				AND bonus.id_theme = theme.id_theme
				AND theme.id_cours = ' .$idCours.';';
		
		$result = $this->executeQuery($sql);
		
		$sql = 'CREATE TEMPORARY TABLE R2
				SELECT avancement_bonus.id_bonus 
				FROM avancement_bonus, R1
				WHERE avancement_bonus.id_bonus = R1.id_bonus
				AND avancement_bonus.suivi = 1
				AND avancement_bonus.note = 5;';
		
		$result = $this->executeQuery($sql);
		
		$sql = 'SELECT *
				FROM R2';
		
		$ressource = $this->executeQuery($sql);
		
		$sql = 'DROP TEMPORARY TABLE R1';
		$this->executeQuery($sql);
		
		$sql = 'DROP TEMPORARY TABLE R2';
		$this->executeQuery($sql);
		
		return $this->countRows($ressource);
	}
}
?>