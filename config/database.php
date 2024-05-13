<?php
session_start();
function database(){
    $server = "mysql:host=localhost; dbname=departement_genie_info";
    $username = "root";
    $password = "";
    
    try{
        $pdo = new PDO($server, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }catch(PDOException $e){
        echo "Erreur de connexion à la base de données : ".$e->getMessage();
    }
}
?>
