<?php
require '../fonctions/fonction.php';

if(isset($_GET['code'])){
    $code=$_GET['code'];
    if(deleteNote($code)){
        echo "<script>alert('L\'Année universitaire a été supprimé avec succès.');</script>";
        header('Location:listNote.php');
    }else{
        echo "<script>alert('Une erreur s'est produite lors de la suppression de l'étudiant.');</script>";
    }
}
?>