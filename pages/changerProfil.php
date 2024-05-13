<?php 
    require '../fonctions/fonction.php';
    extract($_POST);
if(isset($_GET['id'])){
    $id=$_GET['id'];
    if(isset($btnAjouter)){

        // Vérifier si des champs sont vides
        if(empty($nom) || empty($prenom) || empty($telephone) || empty($email)) {
            $errors = "Tous les champs sont obligatoires";
        } else {
            // Mettre à jour le profil de l'utilisateur
            updateUserProfil($nom, $prenom, $telephone, $email, $id);      
            header('Location: listUtilisateur.php');
            exit();
        }
    }
}
    $infoUser = userProfil();
    if(!isset($_SESSION['email'])){
        header('Location:login.php');
    }
?>


<!doctype html>
<html class="no-js" lang="">

<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/admit-form.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:48:20 GMT -->

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
                        <?php if($infoUser['droit']=="Super Admin" || $infoUser['droit']=="Admin"): ?>
                            <li class="nav-item">
                                <a href="dashboard.php" class="nav-link menu-active"><i class="flaticon-dashboard"></i><span>Tableau de bord</span></a>
                            </li>
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
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->

            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>CHANGER DE PROFIL </h3>
                </div>
                <!-- Breadcubs Area End Here -->
                <?php 
                    $pdo = database(); 
                    $id=$_GET['id'];
                    $user = $pdo->prepare("SELECT * FROM user WHERE id = ?");
                    $user->execute(array($id));
                    $resuslt=$user->fetch(PDO::FETCH_ASSOC);
                ?>  
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="single-info-details">
                            <div class="item-content">
                                <div class="header-inline item-header">
                                    <div class="header-elements my-2">
                                        <ul>
                                            <!-- <li><a href="profil.php"><i class="fas fa-angle-left"></i></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="new-added-form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>Nom *</label>
                                    <input type="text" placeholder="" class="form-control" id="fname" name="nom" value="<?php echo $resuslt['nom']; ?>">
                                </div>
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>Prenom *</label>
                                    <input type="text" placeholder="" class="form-control" id="fname" name="prenom" value="<?php echo $resuslt['prenom']; ?>">
                                </div>
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>Telephone *</label>
                                    <input type="text" placeholder="" class="form-control" id="ftelephone" name="telephone" value="<?php echo $resuslt['telephone']; ?>">
                                </div>
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>email *</label>
                                    <input type="text" placeholder="" class="form-control" id="femail" name="email" value="<?php echo $resuslt['email']; ?>">
                                </div>
                                
                                <?php if(isset($errors)) : ?>

                                <span class="text-red mx-4">
                                    <?php echo $errors; ?>
                                </span>

                                <?php endif; ?>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" name="btnAjouter" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Modifier</button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Annuler</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Footer Area Start Here -->
                <?php require '../config/footer.php';?>
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
    <!-- Scroll Up Js -->
    <script src="../assets/js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="../assets/js/main.js"></script>
    <!-- Select 2 Js -->
    <script src="../assets/js/select2.min.js"></script>



</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/admit-form.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:48:42 GMT -->

</html>