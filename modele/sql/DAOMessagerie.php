<?php
class DAOMessagerie extends DAOStandard
{
	public function saveOrUpdate(Messagerie $messagerie)
	{
		if ($this->existsByPseudo($messagerie->getLogin()))
			$this->update($messagerie);
		else
			$this->send($messagerie);
	}
	
	public function send(Messagerie $messagerie)
	{
		$result = $this->executeQuery('INSERT INTO messages SET expediteur = "' . $messagerie->getExpediteur()->getId() . '", destinataire = "' . $messagerie->getDestinataire()->getId() . '", date_mess = "' . $messagerie->getDate() . '", heure_mess = "' . $messagerie->getHeure() . '", titre_mess = "' . $messagerie->getTitre() . '", texte_mess = "' . $messagerie->getTexte() . '", lu = 0');
	}
	
	public function update(Messagerie $etudiant)
	{
		$result = $this->executeQuery('UPDATE messages SET expediteur = ' . $messagerie->getExpediteur() . ', destinataire = "' . $messagerie->getDestinataire() . '", date_mess = "' . $messagerie->getDate() . '", heure_mess = "' . $messagerie->getHeure() . '", titre_mess = "' . $messagerie->getTitre() . '", texte_mess = "' . $messagerie->getTexte() . '", lu =' . $$messagerie->getLu());	}
	
	public function delete($id)
	{
		$this->executeQuery('DELETE FROM messages WHERE id_mess = ' . $id);
	}
	
	public function getAll()
	{
		$daoEtudiant = new DAOEtudiant($db);
		$result = $this->executeQuery('SELECT * FROM messages');
		 
		$listeMessage = array();
		while ($message = $this->fetchArray($result)) {
			$listeMessage[] = new Messagerie(array(	'id' => $message['id_mess'],
					'expediteur' => $daoEtudiant->getByID($message['expediteur']),
					'destinataire' => $daoEtudiant->getByID($message['destinataire']),
					'date' => $message['date_mess'],
					'heure' => $message['heure_mess'],
					'titre' => $message['titre_mess'],
					'texte' => $message['texte_mess'],
					'lu' => $message['lu']
			));
		}
		return $listeMessage;
	}
	
	public function getAllReceived($id)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$result = $this->executeQuery('SELECT * FROM messages WHERE destinataire = ' . $id . ' ORDER BY date_mess DESC');
			
		$listeMessage = array();
		while ($message = $this->fetchArray($result)) {
			$listeMessage[] = new Messagerie(array(	'id' => $message['id_mess'],
					'expediteur' => $daoEtudiant->getByID($message['expediteur']),
					'destinataire' => $daoEtudiant->getByID($message['destinataire']),
					'date' => $message['date_mess'],
					'heure' => $message['heure_mess'],
					'titre' => $message['titre_mess'],
					'texte' => $message['texte_mess'],
					'lu' => $message['lu']
			));
		}
		return $listeMessage;
	}
	
	public function getAllSent($id)
	{
		$daoEtudiant = new DAOEtudiant($db);
		$result = $this->executeQuery('SELECT * FROM messages WHERE expediteur = ' . $id . ' ORDER BY date_mess');
			
		$listeMessage = array();
		while ($message = $this->fetchArray($result)) {
			$listeMessage[] = new Messagerie(array(	'id' => $message['id_mess'],
					'expediteur' => $daoEtudiant->getByID($message['expediteur']),
					'destinataire' => $daoEtudiant->getByID($message['destinataire']),
					'date' => $message['date_mess'],
					'heure' => $message['heure_mess'],
					'titre' => $message['titre_mess'],
					'texte' => $message['texte_mess'],
					'lu' => $message['lu']
			));
		}
		return $listeMessage;
	}
}
