<?php
class Outils
{
	public static function dateToFr($date)
	{
		return strftime('%d/%m/%Y',strtotime($date));
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