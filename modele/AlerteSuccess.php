<?php
class AlerteSuccess extends Alerte{
	
	public function show()
	{
		include_once ('../../alertes/vue/alerte_success.php');
	}
	
	public function show_racine()
	{
		include_once ('alertes/vue/alerte_success.php');
	}
}