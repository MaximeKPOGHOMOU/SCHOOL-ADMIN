<?php 
    require '../fonctions/fonction.php'; 
    $pdo = database();
    $id = $_GET['id'];
    $resuslt = userProfilEtudiant();

   if(isset($_POST['modifierPhoto'])){
      $nom_image = $_FILES['photo']['name'];
      $nom_temporaire = $_FILES['photo']['tmp_name'];
      $destination = "../assets/images/figure/" . $nom_image; 

      if(move_uploaded_file($nom_temporaire, $destination)) {
          $pdo = database();
          $update = $pdo->prepare("UPDATE user SET photo = '$nom_image' WHERE  id = ?");
          $update->execute([$id]);
      } else {
          echo "Une erreur s'est produite lors du téléchargement de l'image.";
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
    <script src="../assets/js/filtrage.js"></script>

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
                    <div class="header-logo" >
                    <a href="dashboard.php"><img  src="../assets/images/log.png" alt="logo"></a>
                    </div>
                </div>
                <div class="sidebar-menu-content">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link"><i class="flaticon-dashboard"></i><span>Tableau de bord</span></a>
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
                            <li class="nav-item "><a href="dashboard.php" class="nav-link"><i class="flaticon-script"></i><span>Notes</span></a> </li>
                            <li class="nav-item "><a href="#" data-toggle="modal" data-target="#semestre" class="nav-link"><i class="flaticon-calendar"></i><span>Emploi du temps</span></a> </li>
                        <?php endif; ?> 
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>PROFIL</h3>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <?php if($infoUser['droit']=="Super Admin" || $infoUser['droit']=="Admin"): ?>
                    <div class="card height-auto">
                        <div class="card-body">
                            <div class="single-info-details">
                                <div class="item-content">
                                    <div class="header-inline item-header">
                                        <div class="header-elements my-2">
                                            <ul>
                                                <li><a href="listUtilisateur.php"><i class="fas fa-angle-left"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="id">IDENTIFICATION</h3>
                            <h5 class="st">Information personnelles</h5>
                            <!-- Afficher les résultats dans la table -->
                            <div class="single-info-details">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="card account-settings-box">
                                        <div class="user-details-box">
                                            <div class="item-img">
                                                <img style=" width: 250px; height:250px;" src="../assets/images/figure/<?php echo $infoUser['photo']; ?>" alt="User image">    
                                            </div>
                                            <div class="col-12 form-group">
                                            <label class="text-dark-medium">Photo *</label>
                                            <input type="file" class="form-control-file" name="photo" >
                                            <button type="submit" name="modifierPhoto" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark my-3">Modifier</button>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                                <div class="item-content">
                                    <div class="header-inline item-header">
                                        <h3 class="entete">PROFIL UTILISATEUR </h3>
                                        <div class="header-elements">
                                            <ul>
                                                <li><a href="ChangerProfil.php?id=<?php echo $infoUser['id']; ?>"><i class="fas fa-edit"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info-table table-responsive">
                                        <table class="table text-nowrap">
                                            <tbody>
                                                <tr>
                                                    <td>NOM:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $infoUser['nom']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>PRENOM:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $infoUser['prenom']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>TELEPHONE:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $infoUser['telephone']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>LOGIN:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $infoUser['email']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>DROIT:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $infoUser['droit']; ?> </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <?php if($infoUser['droit']=="User"): ?>
                    <div class="card height-auto">
                        <div class="card-body">
                            <h3 class="id">IDENTIFICATION</h3>
                            <h5 class="st">Information personnelles</h5>
                            <!-- Afficher les résultats dans la table -->
                            <div class="single-info-details">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="card account-settings-box">
                                        <div class="user-details-box">
                                            <div class="item-img">
                                                <img style=" width: 250px; height:250px;" src="../assets/images/figure/<?php echo $profils['photo']; ?>" alt="User image">    
                                            </div>
                                            <div class="col-12 form-group">
                                            <label class="text-dark-medium">Photo *</label>
                                            <input type="file" class="form-control-file" name="photo" >
                                            <button type="submit" name="modifierPhoto" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark my-3">Modifier</button>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                                <div class="item-content">
                                    <div class="info-table table-responsive">
                                        <table class="table text-nowrap">
                                            <tbody>
                                                <tr>
                                                    <td>MATRICULE:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['matricule']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>NOM:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['nom']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>PRENOM:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['prenom']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>GENRE:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['genre']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>DATE DE NAISSANCE:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['dateNaiss']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>TELEPHONE:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['telephone']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>ADRESSE:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['adresse']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>PROMOTION:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['promotion']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>LICENCE:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['licence']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>ANNEE UNIVERSITAIRE:</td>
                                                    <td class="font-medium text-dark-medium"> <?php echo $resuslt['annee']; ?> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <!-- Footer Area Start Here -->
                <?php 
                    require '../config/footer.php';
                    require '../config/boiteAccueil.php';
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
    <!-- Scroll Up Js -->
    <script src="../assets/js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="../assets/js/main.js"></script>
    <!-- Select 2 Js -->
    <script src="../assets/js/select2.min.js"></script>



</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/admit-form.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:48:42 GMT -->

</html>