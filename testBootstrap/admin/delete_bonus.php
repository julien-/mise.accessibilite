<?php
session_start();
if ($_SESSION['admin'])
{
    include_once('../fonctions.php');
    include_once('../sql/connexion_mysql.php');
    $bonus = exists('b', 'bonus', 'id_bonus');

    if ($bonus != false)
    {
        deleteBonus($bonus);
    }

    header('Location: ' . $_SESSION['referrer'] . '&d=true');
}



