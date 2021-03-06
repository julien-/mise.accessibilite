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
  	if($etudiant->getCode_lien() != false)
  		$result = $this->executeQuery('INSERT INTO etudiant SET admin = ' . $etudiant->getAdmin() . ', nom_etu = "' . $etudiant->getNom() . '", prenom_etu = "' . $etudiant->getPrenom() . '", mail_etu = "' . $etudiant->getMail() . '", pseudo_etu = "' . $etudiant->getLogin() . '", pass_etu = "' . $etudiant->getPass() . '", chemin_avatar = "' . $etudiant->getCode_lien() . '", code_lien = MD5("' . $etudiant->getCode_lien() . '")');
  	else 
  		$result = $this->executeQuery('INSERT INTO etudiant SET admin = ' . $etudiant->getAdmin() . ', nom_etu = "' . $etudiant->getNom() . '", prenom_etu = "' . $etudiant->getPrenom() . '", mail_etu = "' . $etudiant->getMail() . '", pseudo_etu = "' . $etudiant->getLogin() . '", pass_etu = "' . $etudiant->getPass() . '"');
  }
  
  public function update(Etudiant $etudiant)
  {
  	$result = $this->executeQuery('UPDATE etudiant SET admin = ' . $etudiant->getAdmin() . ',nom_etu = "' . $etudiant->getNom() . '", prenom_etu = "' . $etudiant->getPrenom() . '", mail_etu = "' . $etudiant->getMail() . '", pseudo_etu = "' . $etudiant->getLogin() . '", pass_etu = "' . $etudiant->getPass() . '", chemin_avatar = "' . $etudiant->getCode_lien() . '", code_lien = MD5("' . $etudiant->getCode_lien() . '") WHERE pseudo_etu = "' . $etudiant->getLogin() . '"');
  }
  
  public function AddAvatar($idEtu, $chemin, $chemin_md5)
  {
  	$result = $this->executeQuery('UPDATE etudiant SET chemin_avatar = "' . $chemin . '", code_lien = "' . $chemin_md5 . '" WHERE id_etu = ' . $idEtu . '');
  }
  
  public function updateNomPrenomMailLoginByEtudiant($nom, $prenom, $mail, $login, $idEtu)
  {
  	$result = $this->executeQuery('UPDATE etudiant
  									SET nom_etu = "' . $nom . '",
  									prenom_etu = "' . $prenom . '",
  									mail_etu = "' . $mail . '",
  									pseudo_etu = "' . $login . '"
  									WHERE id_etu = ' . $idEtu);
  }
  
  public function updatePasswordByEtudiant($password, $idEtu)
  {
  	$result = $this->executeQuery('UPDATE etudiant
  									SET pass_etu = "' . md5($password) . '"
  									WHERE id_etu = ' . $idEtu);
  }
  
  public function getLastInsertEtudiant() {
  	$result = $this->executeQuery("SELECT LAST_INSERT_ID() AS id_etu FROM etudiant");
  	$id_etu = $this->fetchArray ( $result );
  	return $id_etu['id_etu'];
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
  								'admin' => $etudiant['admin'],
	  							'code_lien' => $etudiant['code_lien']));
	  	}
	  	return $listeEtudiants;
  }
  
  public function getByID($id)
  {
  	$result = $this->executeQuery('SELECT * FROM etudiant WHERE id_etu = ' . $id);

  	$etudiant = $this->fetchArray($result);
  	return new Etudiant(array(	'id' => $etudiant['id_etu'], 
  								'nom' => $etudiant['nom_etu'], 
  								'prenom' => $etudiant['prenom_etu'], 
  								'mail' => $etudiant['mail_etu'], 
  								'login' => $etudiant['pseudo_etu'],
  								'pass' => $etudiant['pass_etu'],
  								'admin' => $etudiant['admin'],
	  							'code_lien' => $etudiant['code_lien']));
  }
  
  public function getByPseudo($pseudo)
  {
  	$result = $this->executeQuery('SELECT * FROM etudiant WHERE pseudo_etu = "' . $pseudo .'"');
  
  	$etudiant = $this->fetchArray($result);  	
  	
  	return new Etudiant(array(	'id' => $etudiant['id_etu'],
  			'nom' => $etudiant['nom_etu'],
  			'prenom' => $etudiant['prenom_etu'],
  			'mail' => $etudiant['mail_etu'],
  			'login' => $etudiant['pseudo_etu'],
  			'pass' => $etudiant['pass_etu'],
  			'admin' => $etudiant['admin'],
  			'code_lien' => $etudiant['code_lien']));
  }
  
  public function existsByPseudo($pseudo)
  {
  	$result = $this->executeQuery('SELECT * FROM etudiant WHERE pseudo_etu = "' . $pseudo .'"');
	
  	return $this->countRows($result) > 0;
  }
  
  public function existsByMail($mail)
  {
  	$result = $this->executeQuery('SELECT * FROM etudiant WHERE mail_etu = "' . $mail .'"');
  
  	return $this->countRows($result) > 0;
  }
  
  public function existsByPseudoAndPassword($pseudo, $pass)
  {
  	$result = $this->executeQuery('SELECT * FROM etudiant WHERE pseudo_etu = "' . $pseudo .'" AND pass_etu = "' . md5($pass) . '"');
  
  	return $this->countRows($result) > 0;
  }
  
  public function existsByPseudoAndMail($pseudo, $mail)
  {
  	$result = $this->executeQuery('SELECT * FROM etudiant WHERE pseudo_etu = "' . $pseudo .'" AND mail_etu = "' . $mail . '"');
  
  	return $this->countRows($result) > 0;
  }
  
  public function count()
  {
  	$result = $this->executeQuery('SELECT *	FROM etudiant');
  	return $this->countRows($result);
  }
  
  public function getCheminByCodeLienAndEtu($code,$idEtu)
  {
  	$daoExercice = new DAOExercice($db);
  	$result = $this->executeQuery('SELECT chemin_avatar FROM etudiant WHERE id_etu = '.$idEtu .' AND code_lien = "' . $code . '"');
  		
  	if ($result == null)
  		return false;
  	else 
  	{
  		$chemin = $this->fetchArray($result);
  		return $chemin["chemin_avatar"];
  		
  	}  
  }
  
}