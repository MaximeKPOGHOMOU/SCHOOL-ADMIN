<?php
require '../fonctions/fonction.php';
if(isset($_GET['matricule'])){
    $matricule=$_GET['matricule'];
    if(deleteEtudiant($matricule)){
        echo "<script>alert('L\'étudiant a été supprimé avec succès.');</script>";
        header('Location:listEtudiant.php');
    }else{
        echo "<script>alert('Une erreur s'est produite lors de la suppression de l'étudiant.');</script>";
    }
}
?>