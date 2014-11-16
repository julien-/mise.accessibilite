<?php
class Avancement {
	protected 
	$etudiant,
	$exercice,
	$fait,
	$compris,
	$assimile,
	$seance,
	$date,
	$avancement;
	
	public function __construct($theme, $avancement) {
	
		$this->setTheme($theme);
		$this->setAvancement($avancement);
	}
	
	public function __construct($exercice, $avancement) {
		
		$this->setExercice($exercice);
		$this->setAvancement($avancement);
	}
	
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
	
	function setEtudiant($etudiant) { $this->etudiant = $etudiant; }
	function getEtudiant() { return $this->etudiant; }
	function setExercice($exercice) { $this->exercice = $exercice; }
	function getExercice() { return $this->exercice; }
	function setFait($fait) { $this->fait = $fait; }
	function getFait() { return $this->fait; }
	function setCompris($compris) { $this->compris = $compris; }
	function getCompris() { return $this->compris; }
	function setAssimile($assimile) { $this->assimile = $assimile; }
	function getAssimile() { return $this->assimile; }
	function setSeance($seance) { $this->seance = $seance; }
	function getSeance() { return $this->seance; }
	function setDate($date) { $this->date = $date; }
	function getDate() { return $this->date; }
	function setAvancement($avancement) { $this->avancement = $avancement; }
	function getAvancement() { return $this->avancement; }
}