<?php
class AlerteInfo extends Alerte{
	
	public function show()
	{
		include_once ('../../alertes/vue/alerte_info.php');
	}
	
	public function show_racine()
	{
		include_once ('alertes/vue/alerte_info.php');
	}
}