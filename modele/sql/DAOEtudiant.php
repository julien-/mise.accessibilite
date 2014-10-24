<?php
class DAOEtudiant extends DAOStandard
{
  public function saveOrUpdate(Etudiant $etudiant)
  {
  	if ($this->existsByPseudo($etudiant->getLogin()))
  		$this->update($etudiant);
  	else
  		$this->add($etudiant);
  }
  
  public function add(Etudiant $etudiant)
  {
  	$result = $this->executeQuery('INSERT INTO etudiant SET admin = ' . $etudiant->getAdmin() . ', nom_etu = "' . $etudiant->getNom() . '", prenom_etu = "' . $etudiant->getPrenom() . '", mail_etu = "' . $etudiant->getMail() . '", pseudo_etu = "' . $etudiant->getLogin() . '", pass_etu = "' . $etudiant->getPass() . '"');
  }
  
  public function update(Etudiant $etudiant)
  {
  	$result = $this->executeQuery('UPDATE etudiant SET admin = ' . $etudiant->getAdmin() . ',nom_etu = "' . $etudiant->getNom() . '", prenom_etu = "' . $etudiant->getPrenom() . '", mail_etu = "' . $etudiant->getMail() . '", pseudo_etu = "' . $etudiant->getLogin() . '", pass_etu = "' . $etudiant->getPass() . '" WHERE pseudo_etu = "' . $etudiant->getLogin() . '"');
  }
  
  public function delete($id)
  {
  	$daoAvancement = new DAOAvancement(null);

  	$this->executeQuery('DELETE FROM etudiant WHERE id_etu = ' . $id);
  	$daoAvancement->deleteByEtudiant($id);
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
  
  public function getByPseudo($pseudo)
  {
  	$result = $this->executeQuery('SELECT id_etu, nom_etu, prenom_etu, mail_etu, pseudo_etu, pass_etu, admin  FROM etudiant WHERE pseudo_etu = "' . $pseudo .'"');
  
  	$etudiant = $this->fetchArray($result);  	
  	
  	return new Etudiant(array(	'id' => $etudiant['id_etu'],
  			'nom' => $etudiant['nom_etu'],
  			'prenom' => $etudiant['prenom_etu'],
  			'mail' => $etudiant['mail_etu'],
  			'login' => $etudiant['pseudo_etu'],
  			'pass' => $etudiant['pass_etu'],
  			'admin' => $etudiant['admin']));
  }
  
  public function existsByPseudo($pseudo)
  {
  	$result = $this->executeQuery('SELECT id_etu, nom_etu, prenom_etu, mail_etu, pseudo_etu, pass_etu, admin  FROM etudiant WHERE pseudo_etu = "' . $pseudo .'"');
	
  	return $this->countRows($result) > 0;
  }
  
  public function existsByMail($mail)
  {
  	$result = $this->executeQuery('SELECT id_etu, nom_etu, prenom_etu, mail_etu, pseudo_etu, pass_etu, admin  FROM etudiant WHERE mail_etu = "' . $mail .'"');
  
  	return $this->countRows($result) > 0;
  }
  
  public function existsByPseudoAndPassword($pseudo, $pass)
  {
  	$result = $this->executeQuery('SELECT id_etu, nom_etu, prenom_etu, mail_etu, pseudo_etu, pass_etu, admin  FROM etudiant WHERE pseudo_etu = "' . $pseudo .'" AND pass_etu = "' . md5($pass) . '"');
  
  	return $this->countRows($result) > 0;
  }
  
}