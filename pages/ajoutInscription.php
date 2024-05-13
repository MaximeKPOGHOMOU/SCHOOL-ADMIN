<?php 
    require '../fonctions/fonction.php';
    extract($_POST);
    $errorsEtudiant = $errorsAnnee = $errorsDate = $errorsLicence = "";
    $isSuccess = true;
    if(isset($btnSubAnne)){
        $date = securite($date);
        $isSuccess = true;
        if(empty($etudiant)){
            $errorsEtudiant = "Veillez choisir un etudiant";
            $isSuccess = false;
        }if(empty($annee)){
            $errorsAnnee = "année universitaire est obligatoire";
            $isSuccess = false;
        }if(empty($licence)){
            $errorsLicence = "La licence est obligatoire";
            $isSuccess = false;
        }if(empty($date)){
            $errorsDate = "La date est obligatoire";
            $isSuccess = false;     
        }if($isSuccess){
            if(verifyLicenceExiste($etudiant,$licence)){
                $errors = "Cet etudiant est déjà inscrit pour la cette licence";
            }else{
                ajoutInscription($etudiant, $annee, $licence, $date);
                header('location:listEtudiantInscript');
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
                                <a href="dashboard.php" class="nav-link"><i class="flaticon-dashboard"></i><span>Tableau de bord</span></a>
                            </li>
                            <li class="nav-item ">
                                <a href="listEtudiant.php" class="nav-link"><i class="flaticon-classmates"></i><span>Etudiants</span></a>
                            </li>
                            <li class="nav-item ">
                                <a href="listEtudiantInscript.php" class="nav-link menu-active"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Réinscriptions</span></a>
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
                    <h3>INSCRIRE UN ETUDIANT</h3>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="single-info-details">
                            <div class="item-content">
                                <div class="header-inline item-header">
                                    <div class="header-elements my-2">
                                        <ul>
                                            <li><a href="listEtudiantInscript.php"><i class="fas fa-angle-left"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="new-added-form" method="post">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="etudiant">Etudiant *</label>
                                    <select class="select2" id="etudiant" name="etudiant">
                                        <option value="">Choisir un etudiant </option>
                                        <?php 
                                            $pdo = database();
                                            $sql= getEtudiants();      
                                            $etudiants=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ( $etudiants as $etudiant){
                                                echo "<option value='".$etudiant['matricule']."'>".$etudiant['prenom'].' '.$etudiant['nom']. "</option>";
                                            }      
                                        ?>
                                    </select>
                                    <?php if(isset($errorsEtudiant)) : ?><span class="text-red mx-4"><?php echo $errorsEtudiant; ?></span> <?php endif; ?>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="annee">Année Universitaire *</label>
                                    <select class="select2" id="annee" name="annee">
                                        <option value="">Choisir une année Universitaire </option>
                                        <?php 
                                            foreach (getAnneScolaire() as $annee){
                                                echo "<option value='".$annee['code']."'>".$annee['code']."</option>";
                                            }
                                                
                                        ?>
                                    </select>
                                    <?php if(isset($errorsAnnee)) : ?><span class="text-red mx-4"><?php echo $errorsAnnee; ?></span> <?php endif; ?>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="licence">Licence *</label>
                                    <select class="select2" id="licence" name="licence">
                                        <option value="">Choisir une licence *</option>
                                        <option value="L1">L1</option>
                                        <option value="L2">L2</option>
                                        <option value="L3">L3</option>
                                        <option value="L4">L4</option>
                                    </select>
                                    <?php if(isset($errorsLicence)) : ?><span class="text-red mx-4"><?php echo $errorsLicence; ?></span> <?php endif; ?>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="fdate">Date *</label>
                                    <input type="text" placeholder="dd/mm/yyyy" class="form-control air-datepicker"
                                        data-position='bottom right' id="fdate" name="date">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php if(isset($errorsDate)) : ?><span class="text-red mx-4"><?php echo $errorsDate; ?></span> <?php endif; ?>
                                </div>                       
                                <?php if(isset($errors)) : ?><span class="text-red mx-4"><?php echo $errors; ?></span> <?php endif; ?>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" name="btnSubAnne" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Ajouter</button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Annuler</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php require '../config/footer.php';?>
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