<?php
class Inscription {
	
	protected 
	$cours,
	$etudiant,
	$date,
	$couleur_cours;
	
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
	
	public function getCours() {
		return $this->cours;
	}
	
	public function setCours($cours) {
		$this->cours = $cours;
		return $this;
	}
	
	public function setEtudiant($etudiant) {
		$this->etudiant = $etudiant;
		return $this;
	}
	
	public function getEtudiant() {
		return $this->etudiant;
	}
	
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function setCouleur($couleur_cours) {
		$this->couleur_cours = $couleur_cours;
		return $this;
	}
	
	public function getCouleur() {
		return $this->couleur_cours;
	}
}