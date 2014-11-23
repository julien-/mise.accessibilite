<?php
include_once('DAOStandard.php');

class DAOBonus extends DAOStandard {
	public function saveOrUpdate(Bonus $bonus) {
		if (exists ( $bonus ))
			update ( $bonus );
		else
			save ( $bonus );
	}
	public function save(Bonus $bonus) {
		$this->executeQuery ( 'INSERT INTO bonus SET id_bonus = "' . $bonus->getId () . '", titre_bonus = ' . $bonus->getTitre () . ', type_bonus =' . $bonus->getType () . ' id_theme = ' . $bonus->getTheme ()->getId () );
	}
	public function update(Bonus $bonus) {
		$this->executeQuery ( 'UPDATE bonus SET id_bonus = "' . $bonus->getId () . '", titre_bonus = ' . $bonus->getTitre () . ', type_bonus =' . $bonus->getType () . ' id_theme = ' . $bonus->getTheme ()->getId () );
	}
	
	public function delete($id)
	{
		$daoAvancementBonus = new DAOAvancement_bonus($db);
		$daoAvancementBonus->deleteByBonus($id);
		$this->executeQuery('DELETE FROM bonus WHERE id_bonus = ' . $id);
	}
	
	public function insertByTitreTypeTheme($titre, $type, $theme) {	
		$this->executeQuery ( 'INSERT INTO bonus SET titre_bonus = "' . $titre . '", type_bonus = "' . $type . '", id_theme = ' . $theme);		
	}
	
	public function getLastInsertBonus() {
		$result = $this->executeQuery("SELECT LAST_INSERT_ID() AS id_bonus_insere FROM bonus");
		$id_bonus = $this->fetchArray ( $result );
		return $id_bonus['id_bonus_insere'];
	}
	
	public function getByID($id) {
		
		$daoTheme = new DAOTheme($db);
		
		$result = $this->executeQuery ( 'SELECT *
										FROM bonus, theme, cours, etudiant, cle
										WHERE bonus.id_bonus = ' . $id . '
										AND bonus.id_theme = theme.id_theme
										AND theme.id_cours = cours.id_cours
										AND cours.id_prof = etudiant.id_etu
										AND cours.id_cle = cle.id_cle' );
		
		$bonus = $this->fetchArray ( $result );
		return new Bonus ( array (
				'id' => $bonus ['id_bonus'],
				'titre' => $bonus ['titre_bonus'],
				'type' => $bonus ['type_bonus'],
				'theme' => $daoTheme->getByID($bonus ['id_theme'])
		) );
	}
	
	public function getAllByTheme($id_theme) {
		
		$daoTheme = new DAOTheme($db);
		
		$result = $this->executeQuery ( 'SELECT *
										FROM bonus, theme, cours, etudiant, cle
										WHERE bonus.id_theme = ' . $id_theme . '
										AND bonus.id_theme = theme.id_theme
										AND theme.id_cours = cours.id_cours
										AND cours.id_prof = etudiant.id_etu
										AND cours.id_cle = cle.id_cle
										GROUP BY bonus.id_bonus' );
		
		$listeBonus = array ();
		while ( $bonus = $this->fetchArray ( $result ) ) {
			$listeBonus [] = new Bonus ( array (
					'id' => $bonus ['id_bonus'],
					'titre' => $bonus ['titre_bonus'],
					'type' => $bonus ['type_bonus'],
					'theme' => $daoTheme->getByID($bonus ['id_theme'])
			) );
		}
		return $listeBonus;
	}
	
	public function getAllByThemeExceptMine($idTheme, $idEtu)
	{
		$daoTheme = new DAOTheme($db);
		
		$result = $this->executeQuery ( 'SELECT *
										FROM bonus
										WHERE id_theme = ' . $idTheme . '
										AND id_bonus NOT IN (	SELECT id_bonus
																FROM avancement_bonus
																WHERE id_etu = ' . $idEtu . '
																AND fait = 1)');
		
		$listeBonus = array ();
		while ( $bonus = $this->fetchArray ( $result ) ) {
			$listeBonus [] = new Bonus ( array (
					'id' => $bonus ['id_bonus'],
					'titre' => $bonus ['titre_bonus'],
					'type' => $bonus ['type_bonus'],
					'theme' => $daoTheme->getByID($bonus ['id_theme'])
			) );
		}		
		return $listeBonus;
	}
}
?>