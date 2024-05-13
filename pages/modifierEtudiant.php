<?php 
require '../fonctions/fonction.php';

extract($_POST);
    if(isset($_GET['matricule'])){
        $matricule=$_GET['matricule'];
        if(isset($btnModifier)){
            if(empty($nom)||empty($prenom)||empty($genre)||empty($dateNaiss)||empty($telephone)||empty($adresse)||empty($promotion)||empty($licence)||empty($annee)){
                $errors = "Tous les champs sont obligatoires";
            }else{
                $lastName = strtoupper($nom);
                $firsrtName = ucfirst($prenom);
                updateStudent($lastName, $firsrtName, $genre, $dateNaiss, $telephone, $adresse, $promotion, $licence, $annee, $matricule);
                header('Location:listEtudiant.php');
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
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="../assets/css/datepicker.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Modernize js -->
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
                        <?php if($infoUser['droit']=="Super Admin" || $infoUser['droit']=="Admin"): ?>
                            <li class="nav-item">
                                <a href="dashboard.php" class="nav-link"><i class="flaticon-dashboard"></i><span>Tableau de bord</span></a>
                            </li>
                            <li class="nav-item ">
                                <a href="listEtudiant.php" class="nav-link menu-active"><i class="flaticon-classmates"></i><span>Etudiants</span></a>
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
                    <h3>MODFIER UN ETUDIANT</h3>
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
                                            <li><a href="listEtudiant.php"><i class="fas fa-angle-left"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- recuperer les informations de l'etudiant -->
                        <?php 
                            $pdo = database(); 
                            $matricule=$_GET['matricule'];
                            $etudiants=$pdo->prepare(
                            "SELECT 
                                etudiant.matricule, 
                                etudiant.nom, 
                                etudiant.prenom, 
                                etudiant.genre, 
                                etudiant.dateNaiss, 
                                etudiant.telephone, 
                                etudiant.adresse, 
                                etudiant.promotion, 
                                etudiant.licence, 
                                etudiant.annee 
                            FROM 
                                etudiant  
                            WHERE matricule=?");
                            $etudiants->execute(array($matricule));
                            $resuslt=$etudiants->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <form class="new-added-form" method="post">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Nom *</label>
                                    <input type="text" placeholder="" class="form-control" name="nom"
                                        value="<?php echo $resuslt['nom']; ?>">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Prénom *</label>
                                    <input type="text" placeholder="" class="form-control" name="prenom"
                                        value="<?php echo $resuslt['prenom']; ?>">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Genre *</label>
                                    <select class="select2" name="genre">
                                        <?php 
                                        $genres = array("Homme", "Femme");
                                        foreach($genres as $genre){
                                            if($resuslt['genre']==$genre){
                                                echo '<option value="' . $genre .'" selected>'. $genre .'</option>'; 
                                            }else{
                                                echo '<option value="'.$genre.'">' .$genre.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Date de naissance *</label>
                                    <input type="text" placeholder="dd/mm/yyyy" name="dateNaiss"
                                        class="form-control air-datepicker" data-position='bottom right'
                                        value="<?php echo $resuslt['dateNaiss']; ?>">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Téléphone</label>
                                    <input type="text" placeholder="" name="telephone" class="form-control"
                                        value="<?php echo $resuslt['telephone']; ?>">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Adresse</label>
                                    <input type="text" placeholder="" name="adresse" class="form-control"
                                        value="<?php echo $resuslt['adresse']; ?>">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Promotion *</label>
                                    <select class="select2" name="promotion">
                                        <?php                  
                                            $pdo=database();
                                            $seletPromotion=$pdo->query('SELECT*FROM promotion')->fetchAll(PDO::FETCH_ASSOC);
                                            $promotions = $seletPromotion;  
                                            foreach($promotions as $promotion) {
                                                if($resuslt['promotion'] == $promotion['libele']) {
                                                    echo "<option value='".$promotion['code']."' selected>".$promotion['code']."</option>";
                                                } else {
                                                    echo "<option value='".$promotion['code']."'>".$promotion['code']."</option>";
                                                }
                                            }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Licence *</label>
                                    <select class="select2" name="licence">
                                    <option value="">Choisir une licence *</option>
                                    <?php 
                                        $licences = array("L1", "L2", "L3", "L4");
                                        foreach($licences as $licence){
                                            if($resuslt['licence']==$licence){
                                                echo '<option value="'.$licence.'" selected>'.$licence.'</option>';
                                            }else{
                                                echo '<option value="'.$licence.'">'.$licence.'</option>';
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Année Universitaire *</label>
                                    <select class="select2" name="annee">
                                        <?php 
                                        $pdo = database();
                                        $selectAnnee=$pdo->query("SELECT * FROM annee_univer")-> fetchAll(PDO::FETCH_ASSOC);
                                        foreach($selectAnnee as $annee){
                                            if($resuslt['annee']==$annee['code']){
                                                echo "<option value='".$annee['code']."' selected>".$annee['code']."</option>";
                                            }else{
                                                echo "<option value='".$annee['code']."'>".$annee['code']."</option>";
                                            }
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                                <?php if(isset($errors)) :?>
                                <span class="text-red">
                                    <?php echo $errors; ?>
                                </span>
                                <?php endif; ?>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" name="btnModifier"
                                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Modifier</button>
                                    <button type="reset" name=""
                                        class="btn-fill-lg bg-blue-dark btn-hover-yellow">Annuler</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Admit Form Area End Here -->
                <!-- debut Modal pour ajouter une promotion -->
                <div class="card height-auto">
                    <div class="ui-modal-box">
                        <div class="modal-box">
                            <!-- Sign Up Modal -->
                            <div class="modal sign-up-modal fade" id="promotion" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="close-btn">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="item-logo">
                                                <label for="">Ajouter une promotion</label>
                                            </div>
                                            <form class="login-form" method="POST" action="">
                                                <div class="row gutters-15">
                                                    <div class="form-group col-sm-6">
                                                        <input type="text" name="code" placeholder="Code"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <input type="text" name="libele" placeholder="Libelé"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <button type="submit" class="login-btn">Ajouter</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin Modal pour ajouter une promotion  -->
                <!-- debut Modal pour ajouter une année universitaire -->
                <div class="card height-auto">
                    <div class="ui-modal-box">
                        <div class="modal-box">
                            <!-- Sign Up Modal -->
                            <div class="modal sign-up-modal fade" id="annee" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="close-btn">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="item-logo">
                                                <label for="">Ajouter une année universitaire</label>
                                            </div>
                                            <form class="login-form" method="POST" action="">
                                                <div class="row gutters-15">
                                                    <div class="form-group col-sm-6">
                                                        <input type="text" name="code" placeholder="Code"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <input type="text" name="libele" placeholder="Libelé"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <button type="submit" class="login-btn">Ajouter</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin Modal pour ajouter une universitaire  -->
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
    <!-- Select 2 Js -->
    <script src="../assets/js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="../assets/js/datepicker.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="../assets/js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="../assets/js/main.js"></script>

</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/admit-form.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:48:42 GMT -->

</html>