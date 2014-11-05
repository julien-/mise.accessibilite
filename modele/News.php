<?php
class News {
	
	protected 
	$date,
	$activite,
	$etudiant;
	
	public function __construct($valeurs = array()) {
		if (! empty ( $valeurs )) // Si on a sp�cifi� des valeurs, alors on hydrate l'objet.
		{
			$this->hydrate ( $valeurs );
		}
	}
	public function hydrate($donnees) {
		foreach ( $donnees as $attribut => $valeur ) {
			$methode = 'set' . ucfirst ( $attribut );
			
			if (is_callable ( array (
					$this,
					$methode 
			) )) {
				$this->$methode ( $valeur );
			}
		}
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
	
	public function getActivite() {
		return $this->activite;
	}
	
	public function setActivite($activite) {
		$this->activite = $activite;
		return $this;
	}
	
	public function setEtudiant($etudiant) {
		$this->etudiant = $etudiant;
		return $this;
	}
	
	public function getEtudiant() {
		return $this->etudiant;
	}
	

}