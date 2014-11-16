<?php
class Message {
	protected 
	$id,
	$auteur,
	$message,
	$dateReponse,
	$sujet;

	
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
	
	public function getAuteur() {
		return $this->auteur;
	}
	
	public function setAuteur($auteur) {
		$this->auteur = $auteur;
		return $this;
	}
	
	public function getMessage() {
		return $this->message;
	}
	
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	
	public function getDateReponse() {
		return $this->dateReponse;
	}
	
	public function setDateReponse($dateReponse) {
		$this->dateReponse = $dateReponse;
		return $this;
	}
	
	public function getSujet() {
		return $this->sujet;
	}
	
	public function setSujet($sujet) {
		$this->sujet = $sujet;
		return $this;
	}
	
	
}