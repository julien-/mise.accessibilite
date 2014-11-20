<?php
class AlerteDanger extends Alerte{
	
	public function show()
	{
		include_once ('../../alertes/vue/alerte_danger.php');
	}
	
	public function show_racine()
	{
		include_once ('alertes/vue/alerte_danger.php');
	}
}