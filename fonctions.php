<?php

function verifierAdresseMail($adresse)
{
  //Adresse mail trop longue (254 octets max)
  if(strlen($adresse)>254)
  {
    return '<p>Votre adresse est trop longue.</p> ';
  }


  //CaractÃ¨res non-ASCII autorisÃ©s dans un nom de domaine .eu :

  $nonASCII='Ä�Ä‘Ä“Ä•Ä—Ä™Ä›Ä�ÄŸÄ¡Ä£Ä¥Ä§Ä©Ä«Ä­Ä¯Ä±ÄµÄ·ÄºÄ¼Ä¾Å€Å‚Å„Å†ÅˆÅ‰Å‹Å�Å�Å‘oeÅ•Å—Å™Å›Å�sÅ¥Å§';
  $nonASCII.='Ä�Ä‘Ä“Ä•Ä—Ä™Ä›Ä�ÄŸÄ¡Ä£Ä¥Ä§Ä©Ä«Ä­Ä¯Ä±ÄµÄ·ÄºÄ¼Ä¾Å€Å‚Å„Å†ÅˆÅ‰Å‹Å�Å�Å‘oeÅ•Å—Å™Å›Å�sÅ¥Å§';
  $nonASCII.='Å©Å«Å­Å¯Å±Å³ÅµÅ·ÅºÅ¼ztÈ™È›Î�Î¬Î­Î®Î¯Î°Î±Î²Î³Î´ÎµÎ¶Î·Î¸Î¹ÎºÎ»Î¼Î½Î¾Î¿Ï€Ï�Ï‚ÏƒÏ„Ï…Ï†';
  $nonASCII.='Ï‡ÏˆÏ‰ÏŠÏ‹ÏŒÏ�ÏŽÐ°Ð±Ð²Ð³Ð´ÐµÐ¶Ð·Ð¸Ð¹ÐºÐ»Ð¼Ð½Ð¾Ð¿Ñ€Ñ�Ñ‚ÑƒÑ„Ñ…Ñ†Ñ‡ÑˆÑ‰ÑŠÑ‹ÑŒÑ�ÑŽÑ�t';
  $nonASCII.='á¼€á¼�á¼‚á¼ƒá¼„á¼…á¼†á¼‡á¼�á¼‘á¼’á¼“á¼”á¼•á¼ á¼¡á¼¢á¼£á¼¤á¼¥á¼¦á¼§á¼°á¼±á¼²á¼³á¼´á¼µá¼¶á¼·á½€á½�á½‚á½ƒá½„á½…á½�á½‘á½’á½“á½”';
  $nonASCII.='á½•á½–á½—á½ á½¡á½¢á½£á½¤á½¥á½¦á½§á½°Î¬á½²Î­á½´Î®á½¶Î¯á½¸ÏŒá½ºÏ�á½¼ÏŽá¾€á¾�á¾‚á¾ƒá¾„á¾…á¾†á¾‡á¾�á¾‘á¾’á¾“á¾”á¾•á¾–á¾—';
  $nonASCII.='á¾ á¾¡á¾¢á¾£á¾¤á¾¥á¾¦á¾§á¾°á¾±á¾²á¾³á¾´á¾¶á¾·á¿‚á¿ƒá¿„á¿†á¿‡á¿�á¿‘á¿’Î�á¿–á¿—á¿ á¿¡á¿¢Î°á¿¤á¿¥á¿¦á¿§á¿²á¿³á¿´á¿¶á¿·';
  // note : 1 caractÃ¨te non-ASCII vos 2 octets en UTF-8


  $syntaxe="#^[[:alnum:][:punct:]]{1,64}@[[:alnum:]-.$nonASCII]{2,253}\.[[:alpha:].]{2,6}$#";

  return (preg_match($syntaxe,$adresse));

}

function transformerDate($date)
{
    $tmp = explode("-", $date);
    $date = $tmp[2]."-".$tmp[1]."-".$tmp[0];
    return $date;
}

function stripAccents($str)
{
    $charset='utf-8';
    $str = htmlentities($str, ENT_NOQUOTES, $charset);
    
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractÃ¨res
    
    return $str;
}

function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Retourne si START <= USER <= END
  //">= et <=" pour qu'ils puissent saisir encore le jour de la prochaine sÃ©ance
  return (($start_ts <= $user_ts) && ($user_ts <= $end_ts));
}

function reduireChaineCar($chaine, $nb_car, $delim='...') {
  $length = $nb_car;
  if($nb_car<strlen($chaine)){
  while (($chaine{$length} != " ") && ($length > 0)) {
   $length--;
  }
  if ($length == 0) return substr($chaine, 0, $nb_car) . $delim;
   else return substr($chaine, 0, $length) . $delim;
  }else return $chaine;
}

//Julien a enlevÃ© car les donnÃ©es brutes dans la BDD sont au bon format
//function formatterNoms($chaine)
//{
//    $chaine = strtolower($chaine);
//    $chaine = ucwords($chaine);
//    
//    return $chaine;
//}

function envoyerMessage($expediteur, $destinataire, $titre, $texte)
{
    $sql = 'INSERT INTO messages VALUES("", "'.$expediteur.'", "'.$destinataire.'", "'.date("Y-m-d H:i:s").'", "'.date("H:i:s").'", "'.mysql_real_escape_string($titre).'", "'.$texte.'", 0)';
    mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
}

function mailFree($to , $subject , $message , $additional_parameters=null) 
{
    $boundary = "-----=".md5(rand());
    $admin = 'My Study Companion <projetir@free.fr>';
    $additional_headers = "Cc: $admin\r\n";
    $additional_headers .= "From: $admin\r\n";
    $additional_headers .= "MIME-Version: 1.0\r\n";
    $additional_headers .= "Content-Type: text/html; charset=utf-8\r\n";
    // $additional_headers .="Reply-To: $admin\r\n";
    $additional_headers .="Return-Path: $admin\r\n";
    $start_time = time();
    $resultat=mail ( $to , $subject, $message, $additional_headers, $additional_parameters);
    $time= time()-$start_time;
    return $resultat & ($time>1);
}

function genererMDP ($longueur = 8){
    // initialiser la variable $mdp
    $mdp = "";
 
    // DÃ©finir tout les caractÃ¨res possibles dans le mot de passe, 
    // Il est possible de rajouter des voyelles ou bien des caractÃ¨res spÃ©ciaux
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
 
    // obtenir le nombre de caractÃ¨res dans la chaÃ®ne prÃ©cÃ©dente
    // cette valeur sera utilisÃ© plus tard
    $longueurMax = strlen($possible);
 
    if ($longueur > $longueurMax) {
        $longueur = $longueurMax;
    }
 
    // initialiser le compteur
    $i = 0;
 
    // ajouter un caractÃ¨re alÃ©atoire Ã  $mdp jusqu'Ã  ce que $longueur soit atteint
    while ($i < $longueur) {
        // prendre un caractÃ¨re alÃ©atoire
        $caractere = substr($possible, mt_rand(0, $longueurMax-1), 1);
 
        // vÃ©rifier si le caractÃ¨re est dÃ©jÃ  utilisÃ© dans $mdp
        if (!strstr($mdp, $caractere)) {
            // Si non, ajouter le caractÃ¨re Ã  $mdp et augmenter le compteur
            $mdp .= $caractere;
            $i++;
        }
    }
 
    // retourner le rÃ©sultat final
    return $mdp;
}

function exists($variable_name, $table, $field)
{
    if (isset($_GET[$variable_name]))
    {
        if (null == ($id = filter_input(INPUT_GET, $variable_name, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)))
            return false;
    }
    else
        return false;
    
    $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $field .' = ' . mysql_real_escape_string($id);
    $resQuery = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
    if (mysql_num_rows($resQuery) > 0)
        return $id;
    else
        return false;
}

function sqlQuery($sql)
{
    $req = mysql_query($sql) or die (mysql_error() . "<br/>SQL: " . $sql);   
    return $req;
}

function hasExercices($cours)
{
    if (mysql_num_rows(sqlQuery('SELECT * '
            . 'FROM exercice e, theme t, cours c '
            . 'WHERE e.id_theme = t.id_theme '
            . 'AND t.id_cours = c.id_cours '
            . 'AND c.id_cours = ' . $cours)) > 0)
        return true;
    else
        return false;
}

function rightCourse($seance, $cours)
{
    if (mysql_num_rows(sqlQuery('SELECT * '
            . 'FROM seance '
            . 'WHERE id_cours = ' . $cours . ' '
            . 'AND id_seance = ' . $seance)) > 0)
        return true;
    else
        return false;
}

function getStudent($id_etu)
{
    $resultat = mysql_fetch_array(sqlQuery('SELECT * ' 
                . 'FROM etudiant '
                . 'WHERE id_etu = ' . $id_etu
                            ));
    $nom = $resultat['nom_etu'];
    $prenom = $resultat['prenom_etu'];
    $mail = $resultat['mail_etu'];
    
            
    return array('nom' => $nom, 'prenom' => $prenom, 'mail' => $mail);
}

function getStudent_myCourses($id_etu,$id_prof)
{
    $resultat = mysql_fetch_array(sqlQuery('SELECT e.nom_etu, e.prenom_etu, e.mail_etu 
                                            FROM etudiant e, inscription i, cours c
                                            WHERE e.admin = 0
                                            AND e.id_etu = ' . $id_etu . '
                                            AND e.id_etu = i.id_etu
                                            AND i.id_cours = c.id_cours
                                            AND c.id_prof = ' . $id_prof));
    $nom = $resultat['nom_etu'];
    $prenom = $resultat['prenom_etu'];
    $mail = $resultat['mail_etu'];
    
            
    return array('nom' => $nom, 'prenom' => $prenom, 'mail' => $mail);
}

function getTheme($id_theme)
{
    $resultat = mysql_fetch_array(sqlQuery('SELECT * ' 
                . 'FROM theme '
                . 'WHERE id_theme = ' . $id_theme
                            ));
    $theme = $resultat['titre_theme'];
    
    return $theme;
}

function getCategorie($id_categorie)
{
    $resultat = mysql_fetch_array(sqlQuery('SELECT * ' 
                . 'FROM forum_categorie '
                . 'WHERE id_categorie = ' . $id_categorie
                            ));
    $categorie = $resultat['titre_categorie'];
    
    return $categorie;
}

function getTopic($id_topic)
{
    $resultat = mysql_fetch_array(sqlQuery('SELECT * ' 
                . 'FROM forum_sujets '
                . 'WHERE id_sujet = ' . $id_topic
                            ));
    $titre = $resultat['titre'];
        
    return $titre;
}

function getCourse($id_cours)
{
    $resultat = mysql_fetch_array(sqlQuery('SELECT * ' 
                . 'FROM cours '
                . 'WHERE id_cours = ' . $id_cours
                            ));
    $cours = $resultat['libelle_cours'];
    
    return $cours;
}

function getExercice($id_exo)
{
    $resultat = mysql_fetch_array(sqlQuery('SELECT * ' 
                . 'FROM exercice '
                . 'WHERE id_exo = ' . $id_exo
                            ));
    $exercice = $resultat['titre_exo'];
    
    return $exercice;
}

function getFilArianne($class, $array_fil) 
{
;
}

function progressionEtudiant($id_etu, $id_cours, $id_exo) 
{
    if ($id_etu != -1)
        $sqlEtudiant = ' AND id_etu = ' . $id_etu . ' ';
    else
        $sqlEtudiant = "";
    
    if ($id_exo != -1)
        $sqlExo = ' AND e.id_exo = ' . $id_exo . ' ';
    else
        $sqlExo = "";

    $sql = '    SELECT e.id_exo '
            . ' FROM exercice e, theme t '
            . ' WHERE t.id_theme = e.id_theme '
            . ' AND id_cours = ' . $id_cours
            . ' ' . $sqlExo;
    $req_total = mysql_query($sql) or die (mysql_error());
    $total = mysql_num_rows($req_total);

    $sql = 'SELECT e.id_etu FROM etudiant e';
    $req_total_etudiant = mysql_query($sql) or die (mysql_error());
    $totalEtudiant = mysql_num_rows($req_total_etudiant);

    if ($id_etu == -1)
        $total = $total * $totalEtudiant * 100;
    else
        $total = $total * 100;
    
    $sql = 'SELECT SUM( assimile + compris + fait ) AS progression
            FROM avancement a, theme t, exercice e 
            WHERE a.id_exo = e.id_exo 
            AND t.id_theme = e.id_theme 
            AND id_cours = ' . $id_cours . $sqlEtudiant . $sqlExo;

    $req_progression = mysql_query($sql) or die (mysql_error());
    $donnees = mysql_fetch_array($req_progression);
    return array('progression' => $donnees['progression'], 'total' => $total);
}

function deletePost($id_post)
{
    sqlQuery('DELETE FROM forum_reponses WHERE id_reponse = ' . $id_post);
}

function deleteSujet($id_sujet)
{
    sqlQuery('DELETE FROM forum_reponses WHERE correspondance_sujet = ' . $id_sujet);
    sqlQuery('DELETE FROM forum_sujets WHERE id_sujet = ' . $id_sujet);
}

function deleteCategorie($id_categorie)
{
    sqlQuery('DELETE FROM forum_categorie WHERE id_categorie = ' . $id_categorie);
    $reqSujets = sqlQuery('SELECT * FROM forum_sujets WHERE id_categorie = ' . $id_categorie);
    while($sujet = mysql_fetch_array($reqSujets))
    {
        sqlQuery('DELETE FROM forum_reponses WHERE correspondance_sujet = ' . $sujet['id']);
    }
    sqlQuery('DELETE FROM forum_sujets WHERE id_categorie = ' . $id_categorie); 
}

function deleteCategorieFromCours($id_cours)
{
    $resCategorie = sqlQuery("SELECT * FROM forum_categorie WHERE id_cours = " . $id_cours);
    $categorie = mysql_fetch_array($resCategorie);
    
    deleteCategorie($categorie['id_categorie']);
}

function deleteCategorieFromTheme($id_theme)
{
    $resCategorie = sqlQuery("SELECT * FROM forum_categorie WHERE id_categorie_parent = " . $id_theme);
    $categorie = mysql_fetch_array($resCategorie);
    
    deleteCategorie($categorie['id_categorie']);
}

function deleteBonus($id_bonus)
{
    sqlQuery("DELETE FROM bonus WHERE id_bonus = " . $id_bonus);
    sqlQuery("DELETE FROM avancement_bonus WHERE id_bonus = " . $id_bonus);
}

function formatURL($message)
{
    return eregi_replace("([[:alnum:]]+)://([^[:space:]]*)([[:alnum:]#?/&=])",
"<A HREF=\"\\1://\\2\\3\" TARGET=\"_blank\">\\1://\\2\\3</A>",$message);
}



function strtoupperFr($string) {

   $string = strtoupper($string);

   $string = str_replace(

      array('Ã©', 'Ã¨', 'Ãª', 'Ã«', 'Ã ', 'Ã¢', 'Ã®', 'Ã¯', 'Ã´', 'Ã¹', 'Ã»'),

      array('Ã‰', 'Ãˆ', 'ÃŠ', 'Ã‹', 'Ã€', 'Ã‚', 'ÃŽ', 'Ã�', 'Ã”', 'Ã™', 'Ã›'),

      $string

   );

   return $string;

}

function est_inscrit_mes_cours($id_etu, $id_prof){
    
     if (mysql_num_rows(sqlQuery('SELECT * 
                        FROM inscription i, cours c
                        WHERE i.id_etu = ' . $id_etu . '
                        AND i.id_cours = c.id_cours
                        AND c.id_prof = ' . $id_prof)) > 0)
        return true;
    else
        return false;
}
?>

