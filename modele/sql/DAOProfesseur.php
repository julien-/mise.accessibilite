<?php
class DAOProfesseur extends DAOEtudiant
{
	
	protected $_db;
	
	public function __construct(MySQLi $db)
	{
		$this->_db = $db;
	}
	
	
	public function add(Professeur $professeur)
	{
		parent::add($professeur);
		$this->_db->query('INSERT INTO professeur SET id_prof = ' . $this->_db->insert_id);
	}
	
	  public function getCours(Professeur $prof)
	  {
	  	$result = $this->_db->query('SELECT id_cours, libelle_cours FROM cours WHERE id_prof = ' . $prof->getId());
	 
	  	return $result;
	  }
	  
	  public function getByID($id)
	  {
	  	$result = $this->_db->query('SELECT id_etu, nom_etu, prenom_etu, mail_etu, pseudo_etu, pass_etu, admin  FROM etudiant WHERE id_etu = ' . $id);
	  	$professeur = $result->fetch_assoc();
	
	  	return new Professeur(array('id' => $professeur['id_etu'], 
  								'nom' => $professeur['nom_etu'], 
  								'prenom' => $professeur['prenom_etu'], 
  								'mail' => $professeur['mail_etu'], 
  								'login' => $professeur['pseudo_etu'],
  								'pass' => $professeur['pass_etu'],
  								'admin' => $professeur['admin']));
	  }
}