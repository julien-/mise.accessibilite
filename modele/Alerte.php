<?php
abstract class Alerte {
	protected
	$texte;
	
	public function __construct($texte) {
		$this->setTexte($texte);
	}
	
	public function getTexte() {
		return $this->texte;
	}
	
	public function setTexte($texte) {
		$this->texte = $texte;
		return $this;
	}
	
	public abstract function show();	
}