<?php 
require '../fonctions/fonction.php';
$getStudentHomme= getStudentsHomme();
$getStudentFemme= getStudentsFemme();
$numberOfStudents= getNumberOfStudents();
$numberOfPromotion= getNumberOfPromotion();
$numberOfEnseignant= getNumberOfEnseignant();
$numberOfUser = getNumberUser();
$infoUser = userProfil();
$inscrit = getNumberInscrit($infoUser['email']);
$pourcentage = pourcentage($infoUser['email']);

if(!isset($_SESSION['email'])){
    header('Location:login.php');
}

$numberNote = note_etudiant($infoUser['email']);

?>
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
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="../assets/css/fullcalendar.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/select2.min.css">
    <link rel="stylesheet" href="../assets/css/datepicker.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/modernizr-3.6.0.min.js"></script>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require '../config/nav.php' ;?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
                <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="dashboard.php"><img style=" width:120px" src="../assets/images/log.png" alt="logo"></a>
                    </div>
               </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link menu-active"><i class="flaticon-dashboard"></i><span>Tableau de bord</span></a>
                        </li>
                        <?php if($infoUser['droit']=="Super Admin" || $infoUser['droit']=="Admin"): ?>
                            <li class="nav-item ">
                                <a href="listEtudiant.php" class="nav-link"><i class="flaticon-classmates"></i><span>Etudiants</span></a>
                            </li>
                            <li class="nav-item ">
                                <a href="listEtudiantInscript.php" class="nav-link"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Réinscriptions</span></a>
                            </li>
                            <li class="nav-item ">
                                <a href="listEnseignant.php" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>Enseignants</span></a>
                            </li>
                            <li class="nav-item ">
                                <a href="listMatiere.php" class="nav-link"><i class="flaticon-books"></i><span>Matières</span></a>
                            </li>
                            <li class="nav-item ">
                                <a href="listNote.php" class="nav-link"><i class="flaticon-script"></i><span>Notes</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="listEmploie.php" class="nav-link"><i class="flaticon-calendar"></i><span>Emploie
                                        du temps</span></a>
                            </li>
                            <li class="nav-item ">
                                <a href="listPromotion.php" class="nav-link"><i class="flaticon-menu-1"></i><span>Promotions</span></a>
                            </li>
                            <?php if($infoUser['droit']=="Super Admin"): ?>
                                <li class="nav-item ">
                                    <a href="listUtilisateur.php" class="nav-link"><i class="flaticon-shopping-list"></i><span>Utilisateurs</span></a>
                                </li>
                            <?php endif; ?> 
                        <?php endif;?>
                        <?php if($infoUser['droit']=="User"): ?>
                            <li class="nav-item "><a href="listNote.php" class="nav-link"><i class="flaticon-script"></i><span>Notes</span></a> </li>
                            <li class="nav-item "><a href="#" data-toggle="modal" data-target="#semestre" class="nav-link"><i class="flaticon-calendar"></i><span>Emploi du temps</span></a> </li>
                        <?php endif; ?> 

                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>TABLEAU DE BORD</h3>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                <?php if($infoUser['droit']=="Super Admin" || $infoUser['droit']=="Admin"): ?>
                    <div class="row gutters-20">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-green ">
                                            <i class="flaticon-classmates text-green"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Etudiants</div>
                                            <div class="item-number"><span class="counter" data-num="<?php echo $numberOfStudents; ?>">2,250</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-blue">
                                            <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Enseignants</div>
                                            <div class="item-number"><span class="counter" data-num="<?php echo $numberOfEnseignant; ?>">2,250</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-yellow">
                                            <i class="flaticon-couple text-orange"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Utilisateurs</div>
                                            <div class="item-number"><span class="counter" data-num="<?php echo $numberOfUser; ?>">5,690</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-red">
                                            <i class="flaticon-money text-red"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Promotions</div>
                                            <div class="item-number"><span class="counter" data-num="<?php echo $numberOfPromotion; ?>">5,690</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?> 
                    <div class="row gutters-20">
                        <!-- Summery Area Start Here -->
                        <div class="col-lg-4">
                            <div class="dashboard-summery-one">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-magenta">
                                            <i class="flaticon-shopping-list text-magenta"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Notes</div>
                                            <div class="item-number"><span class="counter" data-num="<?php echo $numberNote; ?>">12</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="dashboard-summery-one">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-blue">
                                            <i class="flaticon-calendar text-blue"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Inscription</div>
                                            <div class="item-number"><span class="counter" data-num="<?php echo $inscrit; ?>">06</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="dashboard-summery-one">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-yellow">
                                            <i class="flaticon-percentage-discount text-orange"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Performance</div>
                                            <div class="item-number"><span class="counter" data-num="<?php echo intval($pourcentage) ; ?>">94</span><span>%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                <?php endif; ?> 
                <div class="row gutters-20">
                    <div class="col-12 col-xl-6 col-3-xxxl">
                        <div class="card dashboard-card-three pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Etudiants</h3>
                                    </div>
                                </div>
                                <div class="doughnut-chart-wrap" style="max-width: 250px; margin: 0 auto;">
                                    <canvas id="student-doughnut-charte" width="100" height="300"></canvas>
                                </div>
                                <div class="student-report">
                                    <div class="student-count pseudo-bg-blue">
                                        <h4 class="item-title">Femmes</h4>
                                        <div class="item-number"><span class="counter" data-num="<?php echo $getStudentFemme; ?>"></span></div>
                                    </div>
                                    <div class="student-count pseudo-bg-yellow">
                                        <h4 class="item-title">Hommes</h4>
                                        <div class="item-number"><span class="counter" data-num="<?php echo $getStudentHomme; ?>"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 col-4-xxxl">
                        <div class="card dashboard-card-four pd-b-20">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Evenements</h3>
                                    </div>
                                </div>
                                <div class="calender-wrap">
                                    <div id="fc-calender" class="fc-calender"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Ajoutez cette ligne pour inclure la bibliothèque Chart.js -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    var getStudentHomme = <?php echo $getStudentHomme; ?>;
                    var getStudentFemme = <?php echo $getStudentFemme; ?>;
                    
                    var ctx = document.getElementById('student-doughnut-charte').getContext('2d');
                    var new_chart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            // labels: ['Hommes', 'Femmes'],
                            datasets: [{
                                label: 'Nombre d\'étudiants par genre',
                                data: [getStudentHomme ,getStudentFemme],
                                backgroundColor: ['#ff9d01','#5867dd'],
                                               
                            }]
                        },
                        options:{
                            tooltips:{
                                callbacks:{
                                    label: function(tooltipItem, data){
                                        var label = data.labels.label[tooltipItem.index] || '';
                                        if(label){
                                            label +=':';
                                        }
                                        label += data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                        return label;
                                    }
                                }
                            }
                        }
                    });

                </script>
                
                <?php
                    require '../config/boiteAccueil.php';
                    require '../config/footer.php';
                   
                ?>
                <!-- Footer Area End Here -->
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
    <!-- Counterup Js -->
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <!-- Moment Js -->
    <script src="../assets/js/moment.min.js"></script>
    <!-- Waypoints Js -->
    <script src="../assets/js/jquery.waypoints.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="../assets/js/jquery.scrollUp.min.js"></script>
    <!-- Full Calender Js -->
    <script src="../assets/js/fullcalendar.min.js"></script>
    <script src="../assets/js/select2.min.js"></script>
    <script src="../assets/js/main.js"></script>
    
</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:47:53 GMT -->

</html>