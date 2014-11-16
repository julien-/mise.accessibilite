<?php
class Messagerie {
	protected 
	$id,
	$expediteur,
	$destinataire,
	$date,
	$heure,
	$titre,
	$texte,
	$lu;

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
	
	public function getExpediteur() {
		return $this->expediteur;
	}
	
	public function setExpediteur($expediteur) {
		$this->expediteur = $expediteur;
		return $this;
	}
	
	public function getDestinataire() {
		return $this->destinataire;
	}
	
	public function setDestinataire($destinataire) {
		$this->destinataire = $destinataire;
		return $this;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
	
	public function getHeure() {
		return $this->heure;
	}
	
	public function setHeure($heure) {
		$this->heure = $heure;
		return $this;
	}
	
	public function getTitre() {
		return $this->titre;
	}
	
	public function setTitre($titre) {
		$this->titre = $titre;
		return $this;
	}
	
	public function getTexte() {
		return $this->texte;
	}
	
	public function setTexte($texte) {
		$this->texte = $texte;
		return $this;
	}
	
	public function getLu() {
		return $this->lu;
	}
	
	public function setLu($lu) {
		$this->lu = $lu;
		return $this;
	}	
}