<?php
class Outils
{
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
}