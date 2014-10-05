<?php
include_once('../sql/connexion_mysql.php');
function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
    //Test1: fichier correctement uploadé
    if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
    //Test2: taille limite
    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
    //Test3: extension
    $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
    if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
    
    // verifie que le fichier existe pas deja sous ce nom
    $fileExt = pathinfo($_FILES[$index]['name'], PATHINFO_EXTENSION);
    $fileName = substr(basename($_FILES[$index]['name'], $ext), 0, -1);
    $count = 1;
    $tmpDest = $destination;
    while (file_exists($tmpDest)) 
    {
        $tmpDest = $destination.$fileName.' ('.$count.') .'.$fileExt;
        $count++;
    }
    $destination = $tmpDest;
    //Déplacement
    if (!move_uploaded_file($_FILES[$index]['tmp_name'],$destination))
        return false;

    return $destination;
}
 
//EXEMPLES
$destination = upload('userfile','../upload/',FALSE, FALSE);
  
$sql = "INSERT INTO fichiers VALUES('', 1, '" . $destination . "', '" . $_FILES['userfile']['name'] . "', '" . $_POST['commentaires'] ."', '" . md5($destination) . "')";

mysql_query($sql) or die (mysql_error() . $sql)
  
  
?>