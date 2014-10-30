<?php
class DAOPokemon extends DAOStandard
{
  public function saveOrUpdate(Pokemon $pokemon)
  {
  	if ($this->exists($pokemon))
  		$this->update($pokemon);
  	else
  		$this->save($pokemon);
  }
  
  public function exists(Pokemon $pokemon)
  {
  		$result = $this->executeQuery('SELECT * FROM pokemon WHERE nom_pokemon = ' . $pokemon->getNom());
  		return $this->countRows($result) > 0;
  }
  
  public function save(Pokemon $pokemon)
  {
  	$result = $this->executeQuery('INSERT INTO pokemon SET nom = ' . $pokemon->getNom() . ', pokemon_base = "' . $pokemon->getBase() . '"');
  }
  
  public function update(Pokemon $pokemon)
  {
  	$result = $this->executeQuery('UPDATE pokemon SET nom = ' . $pokemon->getNom() . ', pokemon_base = "' . $pokemon->getBase() . '" WHERE id_pokemon = ' . $pokemon->getId());
  } 
  
  public function getAll()
  {
  	$result = $this->executeQuery('SELECT * FROM pokemon');
  	 
  	$listePokemon = array();
  	while ($pokemon = $this->fetchArray($result)) {
  		$listePokemon[] = new Pokemon(array(	
  				'id' => $pokemon['id_pokemon'],
  				'nom' => $pokemon['nom_pokemon'],
  				'base' => $pokemon['pokemon_base']
				));
  	}
  	return $listePokemon;
  }
  
  public function getByID($id)
  {
  	$result = $this->executeQuery('SELECT * FROM pokemon WHERE id_pokemon = ' . $id);
  
	return new Pokemon(array(
  				'id' => $pokemon['id_pokemon'],
  				'nom' => $pokemon['nom_pokemon'],
  				'base' => $pokemon['pokemon_base']
  				));
  }
}