<?php
if(isset($_SESSION['cours']) && !empty($_SESSION['cours']))
	include_once('../Vue/evolution.php');
else 
	include_once('../Vue/introuvable.php');

?>