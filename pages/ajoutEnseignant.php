<?php
    require '../fonctions/fonction.php';
    // =========Ajouter dans la table etudiant==================
    extract($_POST);
    if(isset($valider)){
        $nom = securite($nom);
        $prenom = securite($prenom);
        $telephone = securite($telephone);
        $adresse = securite($adresse);
        if(empty($nom)||empty($prenom)||empty($genre)||empty($telephone)||empty($adresse)||empty($matiere)||empty($diplome)||empty($status)){
            $errors="Tous les champs sont obligatoires";
        }else{
            $lastName = strtoupper($nom);
            $firsrtName = ucfirst($prenom);
            $matricule = generateMatriculeEnseignant($nom, $prenom);
            if(telExisteEnseignant($telephone)){
                $errors = "Ce numéro de téléphone existe déjà";  
            }else{
                ajoutEnseignant($matricule, $lastName, $firsrtName, $genre,$telephone, $adresse, $matiere, $diplome, $status);
                header('Location:listEnseignant.php');
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
        <div class="dashboard-page-one">
            <!-- Page Area Start Here -->
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
                                <a href="listEtudiantInscript.php" class="nav-link"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Réinscriptions</span></a>
                            </li>
                            <li class="nav-item ">
                                <a href="listEnseignant.php" class="nav-link menu-active"><i class="flaticon-multiple-users-silhouette"></i><span>Enseignants</span></a>
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
                    <h3>AJOUTER UN ENSEIGNANT</h3>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <?php 
                    $pdo = database();
                    $matiere = getMatiere();
                    $result = $pdo->query($matiere)->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="card height-auto ">
                            <div class="single-info-details">
                                <div class="item-content">
                                    <div class="header-inline item-header">
                                        <div class="header-elements my-2">
                                            <ul>
                                                <li><a href="listEnseignant.php"><i class="fas fa-angle-left"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="new-added-form" method="POST" action="">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="fnom">Nom *</label>
                                    <input type="text" placeholder="" class="form-control" id="fnom" name="nom">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="fprenom">Prénom *</label>
                                    <input type="text" placeholder="" class="form-control" id="fprenom" name="prenom">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="fgenre">Genre *</label>
                                    <select class="select2" id="fgenre" name="genre">
                                        <option value="">Choisir un genre *</option>
                                        <option value="Homme">Homme</option>
                                        <option value="Femme">Femme</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="fmatiere">Matiere *</label>
                                    <select class="select2" id="fmatiere" name="matiere">
                                        <option value="">Choisir une matiere *</option>
                                        <?php 
                                            foreach ($result as $matiere)
                                                echo "<option value='".$matiere['code']."'>".$matiere['libele']."</option>"; 
                                        ?>
                                    </select>
                                </div>  
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="ftelephone">Téléphone</label>
                                    <input type="text" placeholder="" class="form-control" id="ftelephone"
                                        name="telephone">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="fAdresse">Adresse</label>
                                    <input type="text" placeholder="" class="form-control" id="fAdresse" name="adresse">
                                </div>          
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="fdiplome">Diplome</label>
                                    <select class="select2" id="fdiplome" name="diplome">
                                        <option value="">Choisir un diplome *</option>
                                        <option value="Licence">Licence</option>
                                        <option value="Master">Master</option>
                                        <option value="Doctorat">Doctorat</option>
                                        <option value="Profesorat">Profesorat</option>
                                        <option value="Profesorat">Autres</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label for="fstatus">Status</label>
                                    <select class="select2" id="fstatus" name="status">
                                        <option value="">Choisir un status *</option>
                                        <option value="Titulaire">Titulaire</option>
                                        <option value="Contratuel">Contratuel</option>
                                        <option value="Autres">Autres</option>
                                    </select>
                                </div>
                                
                                <?php if(isset($errors)) : ?>

                                <span class="text-red mx-4">
                                    <?php echo $errors; ?>
                                </span>

                                <?php endif; ?>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" name="valider"
                                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Ajouter</button>
                                    <button type="reset" name="annuler"
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
                                                            class="form-control" >
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <button type="submit" name="btnSubPro" class="login-btn">Ajouter</button>
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
                                                        <input type="text" name="codeScolaire" placeholder="Code"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <input type="text" name="libeleScolaire" placeholder="Libele"
                                                            class="form-control">
                                                    </div>
                                                    <?php if(isset($errors)) : ?>

                                                        <span class="text-red mx-4">
                                                            <?php echo $errors; ?>
                                                        </span>

                                                    <?php endif; ?>
                                                    <div class="form-group col-12">
                                                        <button type="submit" name="btnSubAnne" class="login-btn">Ajouter</button>
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