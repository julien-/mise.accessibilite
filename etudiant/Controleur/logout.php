<?php
if(isset($_SESSION["currentUser"]))
	unset($_SESSION["currentUser"]);
if(isset($_SESSION["cours"]))
	unset($_SESSION["cours"]);
?>
<script language="Javascript">
	document.location.replace("index.php");
</script>
