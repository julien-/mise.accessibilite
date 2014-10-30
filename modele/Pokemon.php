<?php
class Pokemon {
	protected
	$id,
	$nom,
	$base;

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
	
	public function getNom() {
		return $this->nom;
	}
	
	public function setNom($nom) {
		$this->nom = $nom;
		return $this;
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function setBase($base) {
		$this->base = $base;
		return $this;
	}
	
}