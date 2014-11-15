<?php
abstract class Alerte {
	protected
	$classe,
	$texte;
	
	public function __construct($texte) {
		$this->setTexte($texte);
		$this->setClasse('');
	}
	
	public function getTexte() {
		return $this->texte;
	}
	
	public function setTexte($texte) {
		$this->texte = $texte;
		return $this;
	}
	
	public function getClasse() {
		return $this->classe;
	}
	
	public function setClasse($classe) {
		$this->classe = $classe;
		return $this;
	}
	
	public abstract function show();	
}