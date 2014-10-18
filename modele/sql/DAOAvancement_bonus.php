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
	
	public function updateRemarqueByEtuBonus($id_etu, $id_bonus, $remarque) {
		
		$this->executeQuery ( 'UPDATE avancement_bonus 
								SET remarque = "' . $remarque . '"
								WHERE id_bonus = ' . $id_bonus . '
								AND id_etu = ' . $id_etu );
	}
	
	
	
	public function getByBonusEtudiant($id_bonus, $id_etu) {
		$result = $this->executeQuery ( 'SELECT *
										FROM bonus, theme, cours, etudiant, cle, avancement_bonus 
										WHERE avancement_bonus.id_etu = ' . $id_etu . '
										AND avancement_bonus.id_bonus = ' . $id_bonus . '
										AND avancement_bonus.suivi = 1
										AND avancement_bonus.id_bonus = bonus.id_bonus
										AND bonus.id_theme = theme.id_theme
										AND theme.id_cours = cours.id_cours
										AND cours.id_prof = etudiant.id_etu
										AND cours.id_cle = cle.id_cle' );
		
		$avancement_bonus = $this->fetchArray ( $result );
		return new Avancement_bonus ( array (
				'etudiant' => new Etudiant ( array (
						'id' => $avancement_bonus ['id_etu'],
						'nom' => $avancement_bonus ['nom_etu'],
						'prenom' => $avancement_bonus ['prenom_etu'],
						'mail' => $avancement_bonus ['mail_etu'],
						'login' => $avancement_bonus ['pseudo_etu'],
						'pass' => $avancement_bonus ['pass_etu'],
						'admin' => $avancement_bonus ['admin'] 
				) ),
				'bonus' => new Bonus ( array (
						'id' => $avancement_bonus ['id_bonus'],
						'titre' => $avancement_bonus ['titre_bonus'],
						'type' => $avancement_bonus ['type_bonus'],
						'theme' => new Theme ( array (
								'id' => $avancement_bonus ['id_theme'],
								'titre' => $avancement_bonus ['titre_theme'],
								'cours' => new Cours ( array (
										'id' => $avancement_bonus ['id_cours'],
										'libelle' => $avancement_bonus ['libelle_cours'],
										'couleurCalendar' => $avancement_bonus ['couleur_calendar'],
										'idProf' => new Professeur ( array (
												'id' => $avancement_bonus ['id_etu'],
												'nom' => $avancement_bonus ['nom_etu'],
												'prenom' => $avancement_bonus ['prenom_etu'],
												'mail' => $avancement_bonus ['mail_etu'],
												'login' => $avancement_bonus ['pseudo_etu'],
												'pass' => $avancement_bonus ['pass_etu'],
												'admin' => $avancement_bonus ['admin'] 
										) ),
										'idCle' => new Cle ( array (
												'id' => $avancement_bonus ['id_cle'],
												'cle' => $avancement_bonus ['valeur_cle'] 
										) ) 
								) ) 
						)
						 ),
						'note' => $avancement_bonus ['moyenne_notes'] 
				) ),
				'fait' => $avancement_bonus ['fait'],
				'suivi' => $avancement_bonus ['suivi'],
				'note' => $avancement_bonus ['note'],
				'remarque' => $avancement_bonus ['remarque'] 
		) );
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
		$result = $this->executeQuery ( 'SELECT *
										FROM avancement_bonus, etudiant
										WHERE avancement_bonus.id_bonus = ' . $id_bonus . '
										AND avancement_bonus.fait = 1
										AND avancement_bonus.id_etu = etudiant.id_etu');
	
		$listeEtudiants = array();
		while($avancement_bonus = $this->fetchArray ( $result ))
		{
			$listeEtudiants[] = new Etudiant ( array (
					'id' => $avancement_bonus ['id_etu'],
					'nom' => $avancement_bonus ['nom_etu'],
					'prenom' => $avancement_bonus ['prenom_etu'],
					'mail' => $avancement_bonus ['mail_etu'],
					'login' => $avancement_bonus ['pseudo_etu'],
					'pass' => $avancement_bonus ['pass_etu'],
					'admin' => $avancement_bonus ['admin']
			) );				
		}
		return $listeEtudiants;
	}
	
	
}
?>