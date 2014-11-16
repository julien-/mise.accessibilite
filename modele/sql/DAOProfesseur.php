<?php
class DAOProfesseur extends DAOEtudiant
{		
	public function add(Etudiant $professeur)
	{
		parent::add($professeur);
		$this->executeQuery('INSERT INTO professeur SET id_prof = ' . $this->lastInsertedID());
	}
	
	public function saveOrUpdate(Etudiant $professeur)
	{
		$this->add($professeur);
	}
	
	public function delete($id)
	{
		parent::delete($id);
		$this->executeQuery('DELETE FROM professeur WHERE id_prof = ' . $id);
	}
	
	  public function getCours(Etudiant $prof)
	  {
	  	$result = $this->executeQuery('SELECT * FROM cours WHERE id_prof = ' . $prof->getId());
	 
	  	return $result;
	  }
	  
	  public function getByID($id)
	  {
	  	$result = $this->executeQuery('SELECT * FROM etudiant WHERE id_etu = ' . $id);
	  	
	  	$professeur = $this->fetchArray($result);
	
	  	if ($professeur == null)
	  		return false;
	  	
	  	return new Professeur(array('id' => $professeur['id_etu'], 
  								'nom' => $professeur['nom_etu'], 
  								'prenom' => $professeur['prenom_etu'], 
  								'mail' => $professeur['mail_etu'], 
  								'login' => $professeur['pseudo_etu'],
  								'pass' => $professeur['pass_etu'],
  								'admin' => $professeur['admin'],
	  							'avatar' => $professeur['avatar']));
	  }
}