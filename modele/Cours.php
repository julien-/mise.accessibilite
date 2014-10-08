<?php
class Cours {
	
	protected 
	$id,
	$libelle,
	$couleurCalendar,
	$prof,
	$cle;
	
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
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getLibelle() {
		return $this->libelle;
	}
	
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
		return $this;
	}
	
	public function getCouleurCalendar() {
		return $this->couleurCalendar;
	}
	
	public function setCouleurCalendar($couleurCalendar) {
		$this->couleurCalendar = $couleurCalendar;
		return $this;
	}
	
	public function getProf() {
		return $this->prof;
	}
	
	public function setProf($prof) {
		$this->prof = $prof;
		return $this;
	}
	
	public function getCle() {
		return $this->cle;
	}
	
	public function setCle($cle) {
		$this->cle = $cle;
		return $this;
	}
}