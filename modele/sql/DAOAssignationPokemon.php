<?php
class DAOAssignationPokemon extends DAOStandard
{
  public function saveOrUpdate(AssignationPokemon $assignation)
  {
  	if ($this->exists($assignation))
  		$this->update($assignation);
  	else
  		$this->save($assignation);
  }
  
  public function save(AssignationPokemon $assignation)
  {
  	$result = $this->executeQuery('INSERT INTO assignation_pokemon SET id_etu = ' . $assignation->getEtudiant() . ', id_pokemon = "' . $assignation->getPokemon() . '", id_exo = "' . $assignation->getExercice() . '", poke_courant = "' . $assignation->getCourant());
  }
  
  public function update(AssignationPokemon $assignation)
  {
  	$result = $this->executeQuery('UPDATE assignation_pokemon SET id_etu = ' . $assignation->getEtudiant() . ', id_pokemon = "' . $assignation->getPokemon() . '", id_exo = "' . $assignation->getExercice() . '", poke_courant = "' . $assignation->getCourant() . ' WHERE id_etu = "' . $assignation->getEtudiant() . ' AND id_pokemon = "' . $assignation->getPokemon() . '"');
  } 
  
  public function exists(AssignationPokemon $assignation)
  {
  		$result = $this->executeQuery('SELECT * FROM assignation_pokemon WHERE id_etu = ' . $assignation->getEtudiant() . ' AND id_pokemon = ' . $assignation->getPokemon());
  		return $this->countRows($result) > 0;
  }
}