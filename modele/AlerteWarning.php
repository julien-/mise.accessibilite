<?php
class AlerteWarning extends Alerte{
	
	public function show()
	{
		include_once ('../../alertes/vue/alerte_warning.php');
	}
	
	public function show_racine()
	{
		include_once ('alertes/vue/alerte_warning.php');
	}
}