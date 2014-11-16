<?php
class Inscription {
	
	protected 
	$id,
	$cours,
	$etudiant,
	$date,
	$couleur_fond,
	$couleur_texte;
	
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
	
	public function getCours() {
		return $this->cours;
	}
	
	public function setCours($cours) {
		$this->cours = $cours;
		return $this;
	}
	
	public function setEtudiant($etudiant) {
		$this->etudiant = $etudiant;
		return $this;
	}
	
	public function getEtudiant() {
		return $this->etudiant;
	}
	
	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function setCouleurFond($couleur_fond) {
		$this->couleur_fond = $couleur_fond;
		return $this;
	}
	
	public function getCouleurFond() {
		return $this->couleur_fond;
	}
	
	public function setCouleurTexte($couleur_texte) {
		$this->couleur_texte = $couleur_texte;
		return $this;
	}
	
	public function getCouleurTexte() {
		return $this->couleur_texte;
	}
}