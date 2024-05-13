<?php
require '../fonctions/fonction.php';

if(isset($_GET['id'])){
    $code=$_GET['id'];
    if(deleteInscription($code)){
        echo "<script>alert('L\'Suppression effectuée avec succès.');</script>";
        header('Location:listEtudiantInscript.php');
    }else{
        echo "<script>alert('Une erreur s'est produite lors de la suppression de l'étudiant.');</script>";
    }
}
?>