<?php
if(isset($_SESSION['cours']) && !empty($_SESSION['cours']))
	include_once('../vue/mes_bonus.php');
else
	include_once('../vue/introuvable.php');
?>