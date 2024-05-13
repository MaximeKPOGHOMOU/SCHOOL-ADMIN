<?php
require '../fonctions/fonction.php';

if(isset($_GET['id'])){
    $code=$_GET['id'];
    if(deleteUser($code)){
        echo "<script>alert('L\'Année universitaire a été supprimé avec succès.');</script>";
        header('Location:listUtilisateur.php');
    }else{
        echo "<script>alert('Une erreur s'est produite lors de la suppression de l'étudiant.');</script>";
    }
}
?>