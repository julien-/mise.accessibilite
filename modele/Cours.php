<?php
class Cours {
	
	protected 
	$id,
	$libelle,
	$couleurCalendar,
	$idProf,
	$idCle;
	
	public function __construct($valeurs = array()) {
		if (! empty ( $valeurs )) // Si on a spécifié des valeurs, alors on hydrate l'objet.
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
	
	public function getIdProf() {
		return $this->idProf;
	}
	
	public function setIdProf($idProf) {
		$this->idProf = $idProf;
		return $this;
	}
	
	public function getIdCle() {
		return $this->idCle;
	}
	
	public function setIdCle($idCle) {
		$this->idCle = $idCle;
		return $this;
	}
	
	
	
}