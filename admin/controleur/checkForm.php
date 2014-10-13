<?php 
include_once('../../lib/autoload.inc.php');
include_once "../../sql/connexion_mysql.php";
$isAvailable = true;
$daoEtudiant = new DAOEtudiant($db);

switch ($_POST['type']) {
    case 'pseudo':
        $pseudo = $_POST['pseudo'];
        $daoEtudiant->existsByPseudo($pseudo);
        $isAvailable = !$daoEtudiant->existsByPseudo($pseudo);
        break;

}

// Finally, return a JSON
echo json_encode(array(
    'valid' => $isAvailable,
));
?>