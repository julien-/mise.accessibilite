<?php
class DAOMessage extends DAOStandard
{
	public function save(Message $message)
	{
		$this->executeQuery('INSERT INTO forum_reponses SET auteur_reponse = ' . $message->getAuteur() . ', message = "' . $message->getMessage() . '", date_reponse = now(), correspondance_sujet = ' . $message->getSujet());	
	}
	
	public function delete($id)
	{
		$this->executeQuery('DELETE FROM forum_reponses WHERE id_reponse = ' . $id);	
	}
	
	public function deleteBySujet($id)
	{
		$this->executeQuery('DELETE FROM forum_reponses WHERE correspondance_sujet = ' . $id);
	}
	
	public function countBySujet($id)
	{
		$ressource = $this->executeQuery('SELECT * FROM forum_reponses WHERE correspondance_sujet = ' . $id);
		
		return $this->countRows($ressource);
	}
	
	public function countByEtudiantCours($idEtu, $idCours)
	{
		$sql = 'SELECT * FROM forum_reponses r, forum_sujets s, forum_categorie c WHERE r.correspondance_sujet = s.id_sujet AND s.id_categorie = c.id_categorie AND auteur_reponse = ' . $idEtu . ' AND id_cours =' . $idCours;
		$ressource = $this->executeQuery($sql);
	
		return $this->countRows($ressource);
	}
	
	public function getByID($id)
	{
		$daoSujet = new DAOSujet($db);
		$ressource = $this->executeQuery("SELECT * 
				FROM forum_categorie f, cours c, cle, etudiant e, forum_sujets s, forum_reponses r 
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle
				AND s.auteur = e.id_etu
				AND r.correspondance_sujet = s.id_sujet
				AND s.id_categorie = f.id_categorie
				AND id_reponse =" . $id);
		
		
		$message = $this->fetchArray($ressource);
			return new Message(array('id' => $message['id_reponse'],
					'auteur' => new Etudiant(array(	'id' => $message['id_etu'], 
  								'nom' => $message['nom_etu'], 
  								'prenom' => $message['prenom_etu'], 
  								'mail' => $message['mail_etu'], 
  								'login' => $message['pseudo_etu'],
  								'pass' => $message['pass_etu'],
  								'admin' => $message['admin'])),
					'message' => $message['message'],
					'dateReponse' => $message['date_reponse'],
						'sujet'=> 	$daoSujet->getByID($message['correspondance_sujet'])					
			));
	}
	
	public function getAllBySujet($idSujet)
	{
		$ressource = $this->executeQuery("SELECT *
				FROM forum_categorie f, cours c, cle, etudiant e, forum_sujets s, forum_reponses r
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle
				AND s.auteur = e.id_etu
				AND r.correspondance_sujet = s.id_sujet
				AND s.id_categorie = f.id_categorie
				AND s.id_sujet = " . $idSujet);

		$listeMessages = array();
		
		while($message = $this->fetchArray($ressource))
		{
			$listeMessages[] = new Message(array(
								'id' => $message['id_reponse'],
								'auteur' => new Etudiant(array(	'id' => $message['id_etu'],
										'nom' => $message['nom_etu'],
										'prenom' => $message['prenom_etu'],
										'mail' => $message['mail_etu'],
										'login' => $message['pseudo_etu'],
										'pass' => $message['pass_etu'],
										'admin' => $message['admin'])),
								'message' => $message['message'],
								'dateReponse' => $message['date_reponse'],
								'sujet'=> $message['correspondance_sujet']
			));
		}
		
		return $listeMessages;
	}
	
	public function getLastTenBySujet($idSujet)
	{
		$ressource = $this->executeQuery("SELECT *
				FROM forum_categorie f, cours c, cle, etudiant e, forum_sujets s, forum_reponses r
				WHERE f.id_cours = c.id_cours
				AND e.id_etu = c.id_prof
				AND c.id_cle = cle.id_cle
				AND s.auteur = e.id_etu
				AND r.correspondance_sujet = s.id_sujet
				AND s.id_categorie = f.id_categorie
				AND s.id_sujet = " . $idSujet .'
				ORDER BY id_reponse
				LIMIT 10');
	
		$listeMessages = array();
	
		while($message = $this->fetchArray($ressource))
		{
			$listeMessages[] = new Message(array(
					'id' => $message['id_reponse'],
					'auteur' => new Etudiant(array(	'id' => $message['id_etu'],
							'nom' => $message['nom_etu'],
							'prenom' => $message['prenom_etu'],
							'mail' => $message['mail_etu'],
							'login' => $message['pseudo_etu'],
							'pass' => $message['pass_etu'],
							'admin' => $message['admin'])),
					'message' => $message['message'],
					'dateReponse' => $message['date_reponse'],
					'sujet'=> $message['correspondance_sujet']
			));
		}
	
		return $listeMessages;
	}
	
	public function countNbNonLu($id_etu)
	{
		$result = $this->executeQuery('SELECT * 
										FROM messages 
										WHERE destinataire = ' . $id_etu .'
										AND lu = 0');
		
		return $this->countRows($result);
	}
	
}
