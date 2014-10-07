<?php
class CoursManager extends DAOMysqli
{
  
  public function add(Cours $cours)
  {
  	$q = $this->_db->prepare('INSERT INTO cours SET libelle_cours = ?, couleur_calendar = ?, id_prof = ?, id_cle = ?');
  	$q->bind_param('ssss', $cours->getLibelle(), $cours->getCouleurCalendar(), $cours->getIdProf(), $cours->getIdCle());
  
  	$q->execute();
  }
  
  public function getAll()
  {
	  	$result = $this->_db->query('SELECT * FROM cours');
	 	
	  	$listeCours = array();
	  	while ($cours = $result->fetch_assoc()) {
	  		$listeCours[] = new Cours(array(	'id' => $cours['id_cours'], 
  								'libelle' => $cours['libelle_cours'], 
  								'couleurCalendar' => $cours['couleur_calendar'], 
  								'idProf' => $cours['id_prof'], 
  								'idCle' => $cours['id_cle']));
	  	}
	  	return $listeCours;
  }
  
  public function getByID($id)
  {
	$result = $this->_db->query('SELECT * FROM cours WHERE id_cours = ' . $id);
	$cours = $result->fetch_assoc();
  	return new Cours(array(	'id' => $cours['id_cours'], 
  								'libelle' => $cours['libelle_cours'], 
  								'couleurCalendar' => $cours['couleur_calendar'], 
  								'idProf' => $cours['id_prof'], 
  								'idCle' => $cours['id_cle']));
  }
}