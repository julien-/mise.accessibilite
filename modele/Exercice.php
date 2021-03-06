<?php
class Exercice {
	
	protected 
	$id,
	$titre,
	$numero,
	$theme;
	
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
	
	public function getTitre() {
		return $this->titre;
	}
	
	public function setTitre($titre) {
		$this->titre = $titre;
		return $this;
	}	
	
	public function getNumero() {
		return $this->numero;
	}
	
	public function setNumero($numero) {
		$this->numero = $numero;
		return $this;
	}
	
	public function getTheme() {
		return $this->theme;
	}
	
	public function setTheme($theme) {
		$this->theme = $theme;
		return $this;
	}
}