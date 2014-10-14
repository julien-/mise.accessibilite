<?php
class DAOMessage extends DAOStandard
{
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
				AND s.id_categorie = f.id_categorie");
		
		
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
}
