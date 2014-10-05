<?php
/* $server = the IP address or network name of the server
 * $userName = the user to log into the database with
 * $password = the database account password
 * $databaseName = the name of the database to pull data from
 * table structure - colum1 is cas: has text/description - column2 is data has the value
 */

include_once('../../etudiant/connexion_mysql.php');

// write your SQL query here (you may use parameters from $_GET or $_POST if you need them)
$sql = ('SELECT titre_exo, (fait+compris+assimile) as progression
FROM avancement a, theme t, exercice e
WHERE id_etu = ' . $_GET['user'] .'
AND a.id_exo = e.id_exo
AND t.id_theme = e.id_theme
AND t.id_theme = ' . $_GET['theme']) or die (mysql_error());


        $req_progression = mysql_query($sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        
        $progTotale = 0;
        while($donnees_progression = mysql_fetch_assoc($req_progression))
        {
            $progTotale = $donnees_progression['progression'] + $progTotale;
        }

        $pasFaits = ((100 * mysql_num_rows($req_progression)) - $progTotale);
        
        if ($progTotale + $pasFaits <= 0)
        {
            $progTotale = 1;
            $pasFaits = 0;
        }
$table = array();
$table['cols'] = array(
	/* define your DataTable columns here
	 * each column gets its own array
	 * syntax of the arrays is:
	 * label => column label
	 * type => data type of column (string, number, date, datetime, boolean)
	 */
	// I assumed your first column is a "string" type
	// and your second column is a "number" type
	// but you can change them if they are not
    array('label' => 'faitpasfait', 'type' => 'string'),
	array('label' => 'nombre', 'type' => 'number')
);

$rows = array();

    $temp = array();
	// each column needs to have data inserted via the $temp array
	$temp[] = array('v' => 'Faits');
	$temp[] = array('v' => (int)$progTotale); 
        $rows[] = array('c' => $temp);
        $temp = array();
        $temp[] = array('v' => 'Restants');
	$temp[] = array('v' => (int)$pasFaits); 

        

	
	// insert the temp array into $rows
        $rows[] = array('c' => $temp);


// populate the table with rows of data
$table['rows'] = $rows;

// encode the table as JSON
$jsonTable = json_encode($table);

// set up header; first two prevent IE from caching queries
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

// return the JSON data
echo $jsonTable;
?>