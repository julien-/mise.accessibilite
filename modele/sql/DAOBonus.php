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
	public function getByID($id) {
		$result = $this->executeQuery ( 'SELECT * 
										FROM bonus, theme, cours, etudiant, cle  
										WHERE bonus id_bonus = ' . $id . '
										AND bonus.id_theme = theme.id_theme
										AND theme.id_cours = cours.id_cours
										AND cours.id_prof = etudiant.id_etu
										AND cours.id_cle = cle.id_cle' );
		
		$bonus = $this->fetchArray ( $result );
		return new Bonus ( array (
				'id' => $bonus ['id_bonus'],
				'titre' => $bonus ['titre_bonus'],
				'type' => $bonus ['type_bonus'],
				'theme' => new Theme ( array (
						'id' => $bonus ['id_theme'],
						'titre' => $bonus ['titre_theme'],
						'cours' => new Cours ( array (
								'id' => $bonus ['id_cours'],
								'libelle' => $bonus ['libelle_cours'],
								'couleurCalendar' => $bonus ['couleur_calendar'],
								'idProf' => new Professeur ( array (
										'id' => $bonus ['id_etu'],
										'nom' => $bonus ['nom_etu'],
										'prenom' => $bonus ['prenom_etu'],
										'mail' => $bonus ['mail_etu'],
										'login' => $bonus ['pseudo_etu'],
										'pass' => $bonus ['pass_etu'],
										'admin' => $bonus ['admin'] 
								) ),
								'idCle' => new Cle ( array (
										'id' => $bonus ['id_cle'],
										'cle' => $bonus ['valeur_cle'] 
								) ) 
						) ) 
				) ) 
		) );
	}
	public function getAllByTheme($id_theme) {
		$result = $this->executeQuery ( 'SELECT *
										FROM bonus, theme, cours, etudiant, cle
										WHERE bonus.id_theme = ' . $id_theme . '
										AND bonus.id_theme = theme.id_theme
										AND theme.id_cours = cours.id_cours
										AND cours.id_prof = etudiant.id_etu
										AND cours.id_cle = cle.id_cle' );
		
		$listeBonus = array ();
		while ( $bonus = $this->fetchArray ( $result ) ) {
			$listeBonus [] = new Bonus ( array (
					'id' => $bonus ['id_bonus'],
					'titre' => $bonus ['titre_bonus'],
					'type' => $bonus ['type_bonus'],
					'theme' => new Theme ( array (
							'id' => $bonus ['id_theme'],
							'titre' => $bonus ['titre_theme'],
							'cours' => new Cours ( array (
									'id' => $bonus ['id_cours'],
									'libelle' => $bonus ['libelle_cours'],
									'couleurCalendar' => $bonus ['couleur_calendar'],
									'idProf' => new Professeur ( array (
											'id' => $bonus ['id_etu'],
											'nom' => $bonus ['nom_etu'],
											'prenom' => $bonus ['prenom_etu'],
											'mail' => $bonus ['mail_etu'],
											'login' => $bonus ['pseudo_etu'],
											'pass' => $bonus ['pass_etu'],
											'admin' => $bonus ['admin'] 
									) ),
									'idCle' => new Cle ( array (
											'id' => $bonus ['id_cle'],
											'cle' => $bonus ['valeur_cle'] 
									) ) 
							) ) 
					) ) 
			) );
		}
		return $listeBonus;
	}
}
?>