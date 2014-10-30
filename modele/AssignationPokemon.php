<?php
class AssignationPokemon {
	protected
	$etudiant,
	$pokemon,
	$exercice,
	$courant;
	
	
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
	
	public function getEtudiant() {
		return $this->etudiant;
	}
	
	public function setEtudiant($etudiant) {
		$this->etudiant = $etudiant;
		return $this;
	}
	
	public function getPokemon() {
		return $this->pokemon;
	}
	
	public function setPokemon($pokemon) {
		$this->pokemon = $pokemon;
		return $this;
	}
	
	public function getExercice() {
		return $this->exercice;
	}
	
	public function setExercice($exercice) {
		$this->exercice = $exercice;
		return $this;
	}
	
	public function getCourant() {
		return $this->courant;
	}
	
	public function setCourant($courant) {
		$this->courant = $courant;
		return $this;
	}
}