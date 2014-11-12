<?php
if(isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser']))
	include_once('../vue/cours.php');
else 
	include_once('../vue/introuvable.php');
?>