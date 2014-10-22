<?php
class Historique {
	
	protected 
$id,
$page,
$dateVisite,
$heureVisite,
$etudiant,
$cours;
	
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

public function getPage() {
    return $this->page;
}

public function setPage($page) {
    $this->page = $page;
    return $this;
}

public function getDateVisite() {
    return $this->dateVisite;
}

public function setDateVisite($dateVisite) {
    $this->dateVisite = $dateVisite;
    return $this;
}

public function getHeureVisite() {
    return $this->heureVisite;
}

public function setHeureVisite($heureVisite) {
    $this->heureVisite = $heureVisite;
    return $this;
}

public function getEtudiant() {
    return $this->etudiant;
}

public function setEtudiant($etudiant) {
    $this->etudiant = $etudiant;
    return $this;
}

public function getCours() {
    return $this->cours;
}

public function setCours($cours) {
    $this->cours = $cours;
    return $this;
}

	
}