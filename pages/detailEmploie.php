<?php require '../fonctions/fonction.php'; 
 if(!isset($_SESSION['email'])){
    header('Location:login.php');
}?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EMPLOIS DE TEMPS</title>
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
                    <div class="card-body">
                        <div class="card height-auto">
                            <div class="single-info-details">
                                
                                <div class="item-content">
                                    <div class="header-inline item-header">
                                        <div class="header-elements">
                                            <ul>
                                                <li><a href="listEmploie.php"><i class="fas fa-angle-left"></i></a></li>
                                                <li><a href="#" id="imprimer" onclick="imprimerNote()"><i class="fas fa-print"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function imprimerNote() {
                            window.print();
                            }
                        </script> 
                                       
                        <div class="table-responsive">
                            <?php
                                if(isset($_POST['btnSubEmplois'])){
                                    $promotion = $_POST['promotion'];
                                    $semestre = $_POST['semestre'];
                                    $licence = $_POST['licence'];
                                    $niveau ="";
                                    $promo ="";
                                    $semest ="";
                                    $annee = "";
                                    $emplois = getEmploiSemestrielle($promotion, $semestre, $licence);
                                    // if(empty($emplois)){
                                    //     $emploi = reset($emplois);
                                    //     $annee = $emploi['annee'];
                                    //     $promo = $emploi['promotion'];
                                    //     $niveau = $emploi['licence'];
                                    //     $semest = $emploi['semestre']; 
                                    // }
                                    foreach($emplois as $emploi){
                                        $promo = $emploi['promotion'];
                                        $niveau = $emploi['niveau'];
                                        $semest = $emploi['semestre'];
                                        // $annee = $emploi['annee'];
                                    }
                                    // Affichage de l'en-tête de la table
                                    echo '<table>';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th><h1 style="font-size:20px;">INSTITUT SUPERIEUR DE TECHNOLOGIE</h1>
                                    <h1 style="font-size:15px;"> DE MAMOU</h1><h1 style="font-size:15px;">BP:63/Email:astourep@gmail.com</h1></th>';
                                    echo '<th><img style="width: 80px; height: 80px" class="ist" src="../assets/images/logoist.jpg" alt=""></th>';
                                    echo '<th colspan="3"><h1 style="font-size:20px;">DEPARTEMENT: GENIE INFORMATIQUE</h1><h1 style="font-size:15px;">PROMOTION: '.$promo.'</h1><h1 style="font-size:15px;">SEMESTRE: '.$semest.'</h1><h1 style="font-size:15px;">LICENCE: '.$niveau.'</h1></th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    
                                    if($emplois){
                                        // Affichage de la table des emplois du temps
                                        echo '<table>';
                                        echo '<thead>';
                                        echo '<tr class="text-center">';
                                        echo '<th>JOURS</th>';
                                        echo '<th>HORAIRES</th>';
                                        echo '<th>ENSEIGNANT</th>';
                                        echo '<th>MATIERE</th>';
                                        echo '<th>SALLE</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                    
                                        $joursSemaine = array("LUNDI", "MARDI", "MERCREDI", "JEUDI", "VENDREDI", "SAMEDI");
                                        $joursEmploi = [];
                                        foreach($emplois as $info){
                                            $joursEmploi[] = $info['jour'];
                                        }     
                                        // $joursManquants = array_diff($joursSemaine, $joursEmploi);
                                        foreach($joursSemaine as $jour){
                                            if(in_array($jour , $joursEmploi)){
                                                foreach($emplois as $info){
                                                    if($info['jour']==$jour){
                                                        echo '<tr class="text-center">';
                                                        echo '<td>'.$info['jour'].'</td>';
                                                        echo '<td>'.$info['heur'].'</td>';
                                                        echo '<td>'.$info['nomEnseignant'].'</td>';
                                                        echo '<td>'.$info['matiere'].'</td>';
                                                        echo '<td>'.$info['salle'].'</td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                            }else{
                                                echo '<tr class="text-center">';
                                                echo '<td>'.$jour.'</td>';
                                                echo '<td colspan="4">Repos</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    
                                    } else {
                                        echo "<tr><td colspan='5'>Emploi du temps non planifié !</td></tr>";
                                    }
                                    
                                    echo '</tbody>';
                                    echo '</table>';
                                }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Mamou, le<?php $date = date("d/m/Y"); 
                                echo $date;?></h3>
                            </div> 
                            <div class="col-md-6" style="text-align: right; " >
                            <div class="mb-5">
                                <h4>Le chef de departement</h4>
                            </div>
                            <div class="mt-5">
                                <h3>Mr.Ibrahima TOURE</h3>
                            </div>
                            </div>
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