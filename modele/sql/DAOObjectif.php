<?php
class DAOObjectif extends DAOStandard
{
  public function saveOrUpdate(Objectif $objectif)
  {
  	if ($this->exists($objectif))
  		$this->update($objectif);
  	else
  		$this->save($objectif);
  }
  
  public function save(Objectif $objectif)
  {
  	$result = $this->executeQuery('INSERT INTO objectif SET id_objectif = ' . $objectif->getId() . ', objectif = "' . $objectif->getObjectif() . '", description = "' . $objectif->getDescription() . '", points = ' . $objectif->getPoints() .'');
  }
  
  public function update(Objectif $objectif)
  {
  	$result = $this->executeQuery('UPDATE objectif SET id_objectif = ' . $objectif->getId() . ', objectif = "' . $objectif->getObjectif() . '", description = "' . $objectif->getDescription() . '", points = ' . $objectif->getPoints() .'');
  } 
  
  public function getAll()
  {
  	$result = $this->executeQuery('SELECT * FROM objectif');
  	 
  	$listeObjectif = array();
  	while ($objectif = $this->fetchArray($result)) {
  		$listeObjectif[] = new Objectif(array(	
  				'id' => $objectif['id_objectif'],
  				'objectif' => $objectif['objectif'],
  				'description' => $objectif['description'],
  				'points' => $objectif['points']
				));
  	}
  	return $listeObjectif;
  }
  
  public function getByID($id)
  {
  	$result = $this->executeQuery('SELECT * FROM objectif WHERE id_objectif = ' . $id);
  	$objectif = $this->fetchArray($result);
	return new Objectif(array(
  				'id' => $objectif['id_objectif'],
  				'objectif' => $objectif['objectif'],
				'description' => $objectif['description'],
  				'points' => $objectif['points']
  				));
  }
}