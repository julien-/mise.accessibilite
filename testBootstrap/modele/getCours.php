<?php
function getCours ($proprietaire = -1)
{
    if ($proprietaire != -1)
    {
        $sqlProprio = " WHERE id_prof = " . $proprietaire;
    }
    else
    {
        $sqlProprio = '';
    }
    
    return sqlQuery("SELECT * FROM cours" . $sqlProprio);
}
?>