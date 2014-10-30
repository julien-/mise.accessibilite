<?php
class Pokemon {
	protected
	$pokemon,
	$evolution;

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
	
	public function getPokemon() {
		return $this->pokemon;
	}
	
	public function setPokemon($pokemon) {
		$this->pokemon = $pokemon;
		return $this;
	}
	
	public function getEvolution() {
		return $this->evolution;
	}
	
	public function setEvolution($evolution) {
		$this->evolution = $evolution;
		return $this;
	}	
}