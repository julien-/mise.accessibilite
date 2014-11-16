<?php
class Etudiant {
	protected $id, $nom, $prenom, $login, $pass, $mail, $avatar, $admin;
	
	
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
	public function getId() {
		return $this->id;
	}
	public function getNom() {
		return Outils::formatterNom($this->nom);
	}
	public function getPrenom() {
		return Outils::formatterNom($this->prenom);
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
	public function getPrenomNom() {
		return $this->getPrenom() . ' ' . $this->getNom();
	}
	public function setAvatar($avatar) {
		$this->avatar = $avatar;
	}
	public function getAvatar() {
		return $this->avatar;
	}
}