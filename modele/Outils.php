<?php
class Outils
{
	public static $UPLOAD_FOLDER = '/upload/';
	
	
	public static function upload($index, $chemin, $dossier, $maxsize = FALSE, $extensions = FALSE) {
		
		$cheminComplet = $chemin.$dossier;
		//Test1: fichier correctement uploadé
		if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0)
			return FALSE;
		//Test2: taille limite
		if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize)
			return FALSE;
		//Test3: extension
		$ext = substr(strrchr($_FILES[$index]['name'], '.'), 1);
		if ($extensions !== FALSE AND !in_array($ext, $extensions))
			return FALSE;
	
		// verifie que le fichier existe pas deja sous ce nom
		$name = pathinfo($_FILES[$index]['name'], PATHINFO_FILENAME);
		$extension = pathinfo($_FILES[$index]['name'], PATHINFO_EXTENSION);
	
		$increment = ''; 
	
		while(file_exists($cheminComplet . $name . $increment . '.' . $extension)) {
			$increment++;
		}
	
		$basename = $name . $increment . '.' . $extension;
	
		//Déplacement
		if (!move_uploaded_file($_FILES[$index]['tmp_name'], $cheminComplet . $basename))
			return false;
	
		echo $cheminComplet . $basename;
		return $basename;
	}
	
	public static function dateToTimestamp($date)
	{
		return strtotime($date);
	}
	
	public static function getServerURL()
	{
		return 'http://' . $_SERVER['SERVER_NAME'];
	}
	
	public static function currentPageURL()
	{
		$page_url   = 'http';
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
			$page_url .= 's';
		}
		return $page_url.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	}
	
	public static function formatterNom($str)
	{
		$total=strlen($str);
		if ($total > 0)
		{
			$str = strtolower($str);
			$str[0] = strtoupper($str[0]); 
			for ($i=1 ; $i < $total-1; $i++) { 
			    if (($str[$i] == " ") || ($str[$i] == "-")) { 
			        $str[$i+1] = strtoupper($str[$i+1]); 
			        $i++;
			    }
			}
		}
		return $str;
	}
	
	public static function determineDate($date)
	{
		$current = strtotime(date("Y-m-d"));
		$date    = strtotime($date);
		
		$datediff = $date - $current;
		$differance = floor($datediff/(60*60*24));
		if($differance==0)
		{
			return 'aujourd\'hui';
		}
		else if($differance > 1)
		{
			return 'dans ' . $differance . ' jours';
		}
		else if($differance > 0)
		{
			return 'demain';
		}
		else if($differance < -1)
		{
			return 'il y a ' . $differance * -1 . ' jours';
		}
		else
		{
			return 'hier';
		}
		
	}
	
	
	public static function dateToFr($date)
	{
		return strftime('%d/%m/%Y',strtotime($date));
	}
	
	public static function dateToUS($datefr)
	{
		$dateus=$datefr{6}.$datefr{7}.$datefr{8}.$datefr{9}."-".$datefr{3}.$datefr{4}."-".$datefr{0}.$datefr{1};
		return $dateus;
	}
	
	
	public static function toUpper($string) 
	{
	   $string = strtoupper($string);
	
	   $string = str_replace(
	
	      array('Ã©', 'Ã¨', 'Ãª', 'Ã«', 'Ã ', 'Ã¢', 'Ã®', 'Ã¯', 'Ã´', 'Ã¹', 'Ã»'),
	
	      array('Ã‰', 'Ãˆ', 'ÃŠ', 'Ã‹', 'Ã€', 'Ã‚', 'ÃŽ', 'Ã�', 'Ã”', 'Ã™', 'Ã›'),
	
	      $string
	
	   );
	   
		$string = mb_strtoupper($string, 'UTF-8'); 
	
	   return $string;
	}
	
	public static function colorChart($valeur)
	{
		if ((int)$valeur<= 25)
			$color = '#FF6633';
		else if ((int)$valeur > 25 && (int)$valeur <= 75)
			$color = '#FFCC33';
		else
			$color = '#99FF33';
		
		return $color;
	}
	
	public static function daysToFr($day)
	{
		switch($day)
		{
			case 'Mon': return "Lundi";
			case 'Tue': return "Mardi";
			case 'Wed': return "Mercredi";
			case 'Thu': return "Jeudi";
			case 'Fri': return "Vendredi";
			case 'Sat': return "Samedi";
			case 'Sun': return "Dimanche";
		}
	}
	
	public static function sqlDateTimeToFr($date)
	{
		sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
		
		return $jour . '-' . $mois . '-' . $annee . ' à ' . $heure . ':' . $minute;
	}
	
	public static function raccourcirChaine($chaine, $tailleMax)
	{
		// Variable locale
		$positionDernierEspace = 0;
		if( strlen($chaine) >= $tailleMax )
		{
			$chaine = substr($chaine,0,$tailleMax);
			$positionDernierEspace = strrpos($chaine,' ');
			$chaine = substr($chaine,0,$positionDernierEspace).'...';
		}
		return $chaine;
	}
}