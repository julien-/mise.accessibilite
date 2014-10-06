<?php
class Etudiant {
	protected $erreurs = array (), $id, $nom, $prenom, $login, $pass, $mail, $admin;
	
	
	public function __construct($valeurs = array()) {
		if (! empty ( $valeurs )) // Si on a spécifié des valeurs, alors on hydrate l'objet.
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
	public function setErreurs($value) {
		$this->erreurs = $value;
	}
	public function setId($value) {
		$this->id = $value;
	}
	public function setNom($value) {
		$this->nom = $value;
	}
	public function setPrenom($value) {
		$this->prenom = $value;
	}
	public function setLogin($value) {
		$this->login = $value;
	}
	public function setPass($value) {
		$this->pass = $value;
	}
	public function setMail($value) {
		$this->mail = $value;
	}
	public function setAdmin($value) {
		$this->admin = $value;
	}
	public function getErreurs() {
		return $this->erreurs;
	}
	public function getId() {
		return $this->id;
	}
	public function getNom() {
		return $this->nom;
	}
	public function getPrenom() {
		return $this->prenom;
	}
	public function getLogin() {
		return $this->login;
	}
	public function getPass() {
		return $this->pass;
	}
	public function getMail() {
		return $this->mail;
	}
	public function getAdmin() {
		return $this->admin;
	}
}