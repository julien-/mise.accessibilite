<?php 
	class Remarque{
		
		protected 
		$seance,
		$etudiant,
		$remarque;
		
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
		
		public function getSeance() {
			return $this->seance;
		}
		
		public function setSeance($seance) {
			$this->seance = $seance;
			return $this;
		}
		
		public function getEtudiant() {
			return $this->etudiant;
		}
		
		public function setEtudiant($etudiant) {
			$this->etudiant = $etudiant;
			return $this;
		}
		
		public function getRemarque() {
			return $this->remarque;
		}
		
		public function setRemarque($remarque) {
			$this->remarque = $remarque;
			return $this;
		}
	}
?>