<?php 
foreach ($listeAvancement as $avancement)
{
	echo "Titre theme : ".$avancement['exercice']['theme']['titre'].'  //  ';
	echo "Titre exercice : ".$avancement['exercice']['titre'].'  //  ';
	echo "Fait : ".$avancement['fait'].'  //  ';
	echo "Compris : ".$avancement['compris'].'  //  ';
	echo "Assimile: ".$avancement['assimile'];
	echo "<br/>";
}
?>