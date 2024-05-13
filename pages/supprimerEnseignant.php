<?php
require '../fonctions/fonction.php';
if(isset($_GET['matricule'])){
    $matricule=$_GET['matricule'];
    if(deleteEnseignant($matricule)){
        echo "<script>alert('L\'étudiant a été supprimé avec succès.');</script>";
        header('Location:listEnseignant.php');
    }else{
        echo "<script>alert('Une erreur s'est produite lors de la suppression de l'étudiant.');</script>";
    }
}
?>