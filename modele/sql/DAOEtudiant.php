<?php
class DAOEtudiant extends DAOMysqli
{
  
  public function add(Etudiant $etudiant)
  {
  	$result = $this->_db->query('INSERT INTO etudiant SET nom_etu = "' . $etudiant->getNom() . '", prenom_etu = "' . $etudiant->getPrenom() . '", mail_etu = "' . $etudiant->getMail() . '", pseudo_etu = "' . $etudiant->getLogin() . '", pass_etu = "' . $etudiant->getPass() . '"');
  }
  
  public function getAll()
  {
	  	$result = $this->_db->query('SELECT * FROM etudiant');
	 	
	  	$listeEtudiants = array();
	  	while ($etudiant = $result->fetch_assoc()) {
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
  	$q = $this->_db->prepare('SELECT id_etu, nom_etu, prenom_etu, mail_etu, pseudo_etu, pass_etu, admin  FROM etudiant WHERE id_etu = ' . $id);
  	$q->execute();
  	if (!$q)
  	{
  		printf("Message d'erreur : %s\n", $q->error);
  	}
  	$q->bind_result($id, $nom, $prenom, $mail, $pseudo, $pass, $admin);
  	$q->fetch();
  	return new Etudiant(array(	'id' => $id, 
  								'nom' => $nom, 
  								'prenom' => $prenom, 
  								'mail' => $mail, 
  								'login' => $pseudo,
  								'pass' => $pass,
  								'admin' => $admin));
  }
}