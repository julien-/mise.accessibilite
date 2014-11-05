<?php
class Objectif {
	
	protected
	$id,
	$objectif,
	$description,
	$points;

	public function __construct($valeurs = array()) {
		if (! empty ( $valeurs ))
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
	
	public function getObjectif() {
		return $this->objectif;
	}
	
	public function setObjectif($objectif) {
		$this->objectif = $objectif;
		return $this;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	public function getPoints() {
		return $this->points;
	}
	
	public function setPoints($points) {
		$this->points = $points;
		return $this;
	}
}