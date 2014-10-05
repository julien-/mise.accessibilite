<?php
    $nbPokemonLigne = 0;
    $sql =  'SELECT id_exo '
            . 'FROM exercice e, theme t, cours c '
            . 'WHERE e.id_theme = t.id_theme '
            . 'AND t.id_cours = c.id_cours '
            . 'AND c.id_cours = ' . $id_cours;
                
    $reqExos = mysql_query($sql) or die(mysql_error());

?>
<table class="pokemon_tab">
<?php

echo "<tr>";
    while ($exo = mysql_fetch_assoc($reqExos))
    {
        if ($nbPokemonLigne == 5)
        {
            echo "</tr><tr>";
            $nbPokemonLigne = 0;
        }
        echo "<td>";
        $sql = "SELECT nom_pokemon FROM assignations_pokemon a, pokemon p WHERE a.id_pokemon = p.id_pokemon AND id_etu = ".$etudiant . " AND poke_courant = 1 AND id_exo = ".$exo['id_exo'];
        $req = mysql_query($sql) or die(mysql_error());
        $pokemonExo = mysql_fetch_assoc($req);    
        
        if (mysql_num_rows($req) > 0)
            echo "<img src=\"../images/pokemon/" . stripAccents($pokemonExo['nom_pokemon']) .".gif\" title=\"".$pokemonExo['nom_pokemon']."\" />";
        else
            echo "<img src=\"../images/pokemon/oeuf.gif\" title=\"Fais un exercice pour faire éclore cet oeuf !\"/>";
    
        echo "</td>";
        $nbPokemonLigne++;
    }
    ?>
</table>
 