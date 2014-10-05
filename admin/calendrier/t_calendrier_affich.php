<?php

//----------
//CALENDRIER
//----------
// recuperation du jour, mois, et année actuel
$jour_actuel = date("j", time());
$mois_actuel = date("m", time());
$an_actuel = date("Y", time());
$jour = $jour_actuel;

// si la variable mois n'existe pas, mois et année correspondent au mois et à l'année courante
if (!isset($_GET["mois"])) {
    $mois = $mois_actuel;
} else {
    $mois = $_GET["mois"];
}


if (!isset($_GET["an"])) {
    $an = $an_actuel;
} else {
    $an = $_GET["an"];
}



//defini le mois suivant
$mois_suivant = $mois + 1;
$an_suivant = $an;
if ($mois_suivant == 13) {
    $mois_suivant = 1;
    $an_suivant = $an + 1;
}

//defini le mois précédent
$mois_prec = $mois - 1;
$an_prec = $an;
if ($mois_prec == 0) {
    $mois_prec = 12;
    $an_prec = $an - 1;
}

//affichage du mois et de l'année en francais
$mois_de_annee = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
$mois_en_clair = $mois_de_annee[$mois - 1];

// initialisation du tableau tab_jours à 31 entrées (1 pour chaques jours) et on dit qu'aucun jour n'est reservé
for ($j = 1; $j < 32; $j++) {
//    $tab_jours[$j] = (bool) false;
    $tab_jours[$j]["couleurs"] = [];    //tableau vide
    $tab_jours[$j]["nb_seances"] = 0;
}

// requete pour l'affichage de la couleur de la seance sur le calendrier
$sql = "SELECT cours.id_cours, date_seance, couleur_calendar " .
        "FROM " . $tb_seance . " " .
        "LEFT JOIN " . $tb_cours . " ON (cours.id_cours = seance.id_cours)
        WHERE YEAR(date_seance) = " . $an . " AND MONTH(date_seance) = " . $mois . " " .
        "AND id_prof = " . $_SESSION["id"];
$requete = mysql_query($sql);

while ($ma_seance_calendar = mysql_fetch_assoc($requete)) {
    // recupartion du jour ou il y a la reservation
    $jour = $ma_seance_calendar["date_seance"];
    // transforme aaaa/mm/jj en jj
    $jour_concert = (int) substr($jour, 8, 2);
    // insertion des jours reservé dans le tableau
    array_push($tab_jours[$jour_concert]["couleurs"], $ma_seance_calendar["couleur_calendar"]);
    $tab_jours[$jour_concert]["nb_seances"]++;
}

//Détection du 1er et dernier jour du moiS
$nombre_date = mktime(0, 0, 0, $mois, 1, $an);
$premier_jour = date('w', $nombre_date);
$dernier_jour = 28;

//Gestion des couleurs
while (checkdate($mois, $dernier_jour + 1, $an)) {
    $dernier_jour++;
}



?>