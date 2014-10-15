<?php
class Sujet {
	
	protected 
	$id,
	$auteur,
	$titre,
	$dateDerniereReponse,
	$categorie,
	$nbMessages
	;

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
	
	public function getNbMessages() {
		return $this->nbMessages;
	}
	
	public function setNbMessages($nbMessages) {
		$this->nbMessages = $nbMessages;
		return $this;
	}
	
	public function getAuteur() {
		return $this->auteur;
	}
	
	public function setAuteur($auteur) {
		$this->auteur = $auteur;
		return $this;
	}
	
	public function getTitre() {
		return $this->titre;
	}
	
	public function setTitre($titre) {
		$this->titre = $titre;
		return $this;
	}
	
	public function getDateDerniereReponse() {
		return $this->dateDerniereReponse;
	}
	
	public function setDateDerniereReponse($dateDerniereReponse) {
		$this->dateDerniereReponse = $dateDerniereReponse;
		return $this;
	}
	
	public function getCategorie() {
		return $this->categorie;
	}
	
	public function setCategorie($categorie) {
		$this->categorie = $categorie;
		return $this;
	}
}