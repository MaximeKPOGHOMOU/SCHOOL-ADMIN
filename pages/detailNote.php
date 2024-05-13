<?php require '../fonctions/fonction.php';
if(!isset($_SESSION['email'])){
    header('Location:login.php');
} ?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SCHOOL MANAGEMENT</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="../assets/fonts/flaticon.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="../assets/css/select2.min.css">
    <!-- Modernize js -->
    <script src="../assets/js/modernizr-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/datepicker.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    

</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <div class="dashboard-content-one">                
                <div class="card height-auto">
                    <div class="card-body ">
                        <div class="card height-auto">
                            <div class="single-info-details">
                                <div class="item-content">
                                    <div class="header-inline item-header">
                                        <div class="header-elements">
                                            <ul class="print-hidden">
                                                <li><a class="max" href="listNote.php"><i class="fas fa-angle-left"></i></a></li>
                                                <li><a  href="#" id="imprimer" onclick="imprimerNote()"><i class="fas fa-print"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                             function imprimerNote(){
                                window.print();
                             }
                            //  window.onload = function() {
                            //     window.print();
                            // };
                        </script>
                        <div class="table-responsive">
                            <?php
                                if(isset($_POST['btnSubPro'])){
                                    $promotion = $_POST['promotion'];
                                    $semestre = $_POST['semestre'];
                                    $niveau ="";
                                    $promo ="";
                                    $semest ="";
                                    $annee ="";
                                    
                                    $etudiants = getNoteSemestrielle($promotion, $semestre);
                                    foreach($etudiants as $etudiant){
                                        $promo = $etudiant['promotion'];
                                        $semest = $etudiant['semestre'];
                                        $annee = $etudiant['annee'];
                                    }
                                    echo '<table>';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th><h1 style="font-size:20px;">INSTITUT SUPERIEUR DE TECHNOLOGIE</h1>
                                    <h1 style="font-size:15px;"> DE MAMOU</h1><h1 style="font-size:15px;">BP:63/Email:astourep@gmail.com</h1></th>';
                                    echo '<th><img style="width: 80px; height: 80px" class="ist" src="../assets/images/logoist.jpg" alt=""></th>';
                                    echo '<th colspan="3"><h1 style="font-size:20px;">DEPARTEMENT: GENIE INFORMATIQUE</h1><h1 style="font-size:15px;">PROMOTION: '.$promo.'</h1><h1 style="font-size:15px;">SEMESTRE: '.$semest.'</h1><h1 style="font-size:15px;">ANNEE UNIVERSITAIRE: '.$annee.'</h1></th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    if($etudiants){
                                        $matieres = array();
                                        $moyenne_generales = array();
                                        foreach($etudiants as $etudiant){
                                            $matieres[] = $etudiant['matiere'];
                                        }
                                        $matieres = array_unique($matieres);
                                        $etudiants_groupes = array();
                                        // =======grouper les etudiants par matricule=======
                                        foreach($etudiants as $etudiant){
                                            $matricule = $etudiant['matricule'];
                                            if(!isset($etudiants_groupes[$matricule])){
                                                $etudiants_groupes[$matricule] = array(
                                                    'prenom' => $etudiant['prenom'],
                                                    'nom' => $etudiant['nom'],
                                                    'moyennes' => array()
                                                );
                                            }
                                            // =======les moyenne par matieres pour chaque etudiants par matricule=======
                                            $etudiants_groupes[$matricule]['moyennes'][] = array(
                                                'matiere' => $etudiant['matiere'],
                                                'moyenne' => $etudiant['moyenne']
                                            );
                                        }
                                        // =========Affichage des données regroupées dans la table=========
                                        echo '<table class="table display data-table text-nowrap">  ';
                                        echo '<thead>';
                                        echo '<tr class="text-center">';
                                        echo '<th>N°</th>';
                                        echo '<th>MATRICULE</th>';
                                        echo '<th> NOM</th>';
                                        echo '<th>PRENOM </th>';
                                        foreach($matieres as $matiere){
                                            echo '<th>'. $matiere .'</th>'; 
                                        }
                                        echo '<th>MOYENNE</th>';
                                        echo '<th>MENTION</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        
                                        $nombre_enregistrement = 1;
                                        foreach($etudiants_groupes as $matricule => $infos){
                                            echo '<tr class="text-center">';
                                            echo '<td>' . $nombre_enregistrement++ . '</td>';
                                            echo '<td>' . $matricule . '</td>';
                                            echo '<td>' . $infos['nom'] . '</td>';
                                            echo '<td>' . $infos['prenom'] . '</td>';
                                            
                                            $moyenne_generales_par_matiere = 0;
                                            foreach($matieres as $matiere){ 
                                                $note = '0.00';
                                                foreach($infos['moyennes'] as $moyenne){
                                                    if($moyenne['matiere'] == $matiere){
                                                        $note = $moyenne['moyenne'];
                                                        if($note != '0.00'){
                                                            $moyenne_generales_par_matiere += $note;
                                                        }
                                                        break;
                                                    }
                                                }
                                                echo '<td>' . $note . '</td>';
                                            }
                                            // =========Calcul de la moyenne générale et de la mention=========
                                            $moyenne_generales = $moyenne_generales_par_matiere / 5;
                                            $mention = '';
                                            if($moyenne_generales != '0.00'){
                                                if($moyenne_generales <= 6){
                                                    $mention = "Passable";
                                                }elseif($moyenne_generales <= 7){
                                                    $mention = "Assez bien";
                                                }elseif($moyenne_generales <= 8){
                                                    $mention = "Bien";
                                                }else{
                                                    $mention = "Très bien";
                                                }
                                            }
                                            echo '<td>' . $moyenne_generales . '</td>';
                                            echo '<td>' . $mention . '</td>';
                                        }
                                        
                                    }else{
                                        echo "Auncun enregistrement ne correspond à ce critère selectionner";
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                }        
                            ?>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="../assets/js/plugins.js"></script>
    <!-- Popper js -->
    <script src="../assets/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="../assets/js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="../assets/js/main.js"></script>
    <!-- Select 2 Js -->
    <script src="../assets/js/select2.min.js"></script>
    <script src="../assets/js/impression.js"></script>                                   


</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/admit-form.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:48:42 GMT -->

</html>