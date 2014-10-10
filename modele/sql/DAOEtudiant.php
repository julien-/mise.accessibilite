<?php
class DAOEtudiant extends DAOMysqli
{
  
  public function add(Etudiant $etudiant)
  {
  	$result = $this->executeQuery('INSERT INTO etudiant SET nom_etu = "' . $etudiant->getNom() . '", prenom_etu = "' . $etudiant->getPrenom() . '", mail_etu = "' . $etudiant->getMail() . '", pseudo_etu = "' . $etudiant->getLogin() . '", pass_etu = "' . $etudiant->getPass() . '"');
  }
  
  public function getAll()
  {
	  	$result = $this->executeQuery('SELECT * FROM etudiant');
	 	
	  	$listeEtudiants = array();
	  	while ($etudiant = $this->fetchArray($result)) {
	  		$listeEtudiants[] = new Etudiant(array(	'id' => $etudiant['id_etu'], 
  								'nom' => $etudiant['nom_etu'], 
  								'prenom' => $etudiant['prenom_etu'], 
  								'mail' => $etudiant['mail_etu'], 
  								'login' => $etudiant['pseudo_etu'],
  								'pass' => $etudiant['pass_etu'],
  								'admin' => $etudiant['admin']));
	  	}
	  	return $listeEtudiants;
  }
  
  public function getByID($id)
  {
  	$result = $this->executeQuery('SELECT id_etu, nom_etu, prenom_etu, mail_etu, pseudo_etu, pass_etu, admin  FROM etudiant WHERE id_etu = ' . $id);

  	$etudiant = $this->fetchArray($result);
  	return new Etudiant(array(	'id' => $etudiant['id_etu'], 
  								'nom' => $etudiant['nom_etu'], 
  								'prenom' => $etudiant['prenom_etu'], 
  								'mail' => $etudiant['mail_etu'], 
  								'login' => $etudiant['pseudo_etu'],
  								'pass' => $etudiant['pass_etu'],
  								'admin' => $etudiant['admin']));
  }
  
}