<?php
require '../fonctions/fonction.php';
$profil = userProfil();
$date = date("d/m/Y");
$heure=date("H:i:s");
$id_user = $profil['id'];
ajoutHistorique($id_user, $date, $heure, "Déconnexion");
session_destroy();
header('Location:login.php');