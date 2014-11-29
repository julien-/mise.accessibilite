<?php
class OubliPassword {
	protected 
	$id, 
	$etudiant, 
	$cle, 
	$date;
	
	
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

	public function setId($value) {
		$this->id = $value;
	}
	public function setEtudiant($value) {
		$this->etudiant = $value;
	}
	public function setCle($value) {
		$this->cle = $value;
	}
	public function setDate($value) {
		$this->date = $value;
	}
	public function getId() {
		return $this->id;
	}
	public function getEtudiant() {
		return $this->etudiant;
	}
	public function getCle() {
		return $this->cle;
	}
	public function getDate() {
		return $this->date;
	}
}