<?php
class Avancement {
	protected 
	$etudiant,
	$bonus,
	$fait,
	$suivi,
	$note,
	$remarque;
	
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
	function setBonus($bonus) { $this->bonus = $bonus; }
	function getBonus() { return $this->bonus; }
	function setFait($fait) { $this->fait = $fait; }
	function getFait() { return $this->fait; }
	function setSuivi($suivi) { $this->suivi = $suivi; }
	function getSuivi() { return $this->suivi; }
	function setNote($note) { $this->note = $note; }
	function getNote() { return $this->note; }
	function setRemarque($remarque) { $this->remarque = $remarque; }
	function getRemarque() { return $this->remarque; }
}