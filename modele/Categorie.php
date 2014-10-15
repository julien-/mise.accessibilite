<?php
class Categorie {
	
	protected 
	$id,
	$titre,
	$description,
	$cours,
	$nbSujets,
	$nbMessages,
	$parent;

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
	
	public function getNbSujets() {
		return $this->nbSujets;
	}
	
	public function setNbSujets($nbSujets) {
		$this->nbSujets = $nbSujets;
		return $this;
	}
	
	public function getNbMessages() {
		return $this->nbMessages;
	}
	
	public function setNbMessages($nbMessages) {
		$this->nbMessages = $nbMessages;
		return $this;
	}
	
	
	
	public function getTitre() {
		return $this->titre;
	}
	
	public function setTitre($titre) {
		$this->titre = $titre;
		return $this;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	
	public function getCours() {
		return $this->cours;
	}
	
	public function setCours($cours) {
		$this->cours = $cours;
		return $this;
	}
	
	public function getParent() {
		return $this->parent;
	}
	
	public function setParent($parent) {
		$this->parent = $parent;
		return $this;
	}
	
	
	
}