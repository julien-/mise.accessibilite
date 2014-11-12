<?php
if((isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser'])) && (isset($_SESSION['cours']) && !empty($_SESSION['cours'])))
	include_once('../vue/progression.php');
else 
	include_once('../vue/introuvable.php');
	
?>