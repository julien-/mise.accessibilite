<script type="text/javascript" src="../js/compte.js"></script>
<?php
if (isset($_SESSION['compteModified']))
{
	unset($_SESSION['compteModified']);
	$compteModified = true;
}
else
{
	$compteModified  = false;
}

if (isset($_SESSION['passwordModified']))
{
	unset($_SESSION['passwordModified']);
	$passwordModified = true;
}
else
{
	$passwordModified  = false;
}
include_once('../../compte/vue/compte.php');
?>