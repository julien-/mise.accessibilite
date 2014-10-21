<?php
class Fichier {
	
	protected 
	$id,
	$exercice,
	$chemin,
	$nom,
	$commentaire,
	$codeLien,
	$enLigne,
	$telechargements
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
	
	public function getExercice() {
		return $this->exercice;
	}
	
	public function setExercice($exercice) {
		$this->exercice = $exercice;
		return $this;
	}
	
	public function getChemin() {
		return $this->chemin;
	}
	
	public function setChemin($chemin) {
		$this->chemin = $chemin;
		return $this;
	}
	
	public function getNom() {
		return $this->nom;
	}
	
	public function setNom($nom) {
		$this->nom = $nom;
		return $this;
	}
	
	public function getCommentaire() {
		return $this->commentaire;
	}
	
	public function setCommentaire($commentaire) {
		$this->commentaire = $commentaire;
		return $this;
	}
	
	public function getCodeLien() {
		return $this->codeLien;
	}
	
	public function setCodeLien($codeLien) {
		$this->codeLien = $codeLien;
		return $this;
	}
	
	public function getEnLigne() {
		return $this->enLigne;
	}
	
	public function setEnLigne($enLigne) {
		$this->enLigne = $enLigne;
		return $this;
	}
	
	public function getTelechargements() {
		return $this->telechargements;
	}
	
	public function setTelechargements($telechargements) {
		$this->telechargements = $telechargements;
		return $this;
	}
	
	public function deleteFromServer($pathToUploadFile)
	{
		return unlink($pathToUploadFile.Outils::$UPLOAD_FOLDER.$this->getChemin());
	}
	
}