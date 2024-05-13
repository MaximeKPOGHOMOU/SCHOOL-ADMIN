<?php 
require '../fonctions/fonction.php'; 
if(!isset($_SESSION['email'])){
    header('Location:login.php');
}
$infoUser = userProfil();
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
                    <h3>LA LISTE DES ENSEIGNANTS</h3>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <?php 
                    $pdo = database();
                    $sql= getEnseignant();
                    if(isset($_POST['rechercher'])){
                      $status = $_POST['status'];
                      $diplome = $_POST['diplome'];
                      if(!empty($status)){
                        $sql.=" where status_en = '$status'";
                      }elseif(!empty($diplome)){
                        $sql.=" where diplome = '$diplome'";
                      }{
                        echo "Veillez selectionner un critère de recherche! ";
                      }
                    }
                    $enseignants=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Rehercher par:</h3>
                            </div>
                        </div>
                        <form class="mg-b-20" method="POST" action="">
                            <div class="row gutters-8">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <select class="select2" id="fdiplome" name="diplome">
                                        <option value="">Diplome *</option>
                                        <option value="Licence">Licence</option>
                                        <option value="Master">Master</option>
                                        <option value="Doctorat">Doctorat</option>
                                        <option value="Profesorat">Profesorat</option>
                                        <option value="Profesorat">Autres</option>
                                    </select>
                                </div>
                                <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                    <select class="select2" id="fstatus" name="status">
                                        <option value="">Status *</option>
                                        <option value="Titulaire">Titulaire</option>
                                        <option value="Contratuel">Contratuel</option>
                                        <option value="Autres">Autres</option>
                                    </select>
                                </div>
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group ">
                                    <button type="submit" name="rechercher"
                                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Rechercher</button>
                                </div>
                                <!-- Student Details Area Start Here -->
                                <div class="card height-auto mx-2">
                                    <div class="single-info-details">
                                        <div class="item-img">
                                        </div>
                                        <div class="item-content">
                                            <div class="header-inline item-header">
                                                <div class="header-elements mx-5 my-2">
                                                    <ul>
                                                        <li><a href="ajoutEnseignant.php"><i class="fas fa-plus-circle"></i></a></li>
                                                        <li><a href="#" data-toggle="modal" data-target = "#imprimerEnseignant"><i class="fas fa-print"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>                       
                        <!-- Afficher les résultats dans la table -->
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap" id="tableEnseignant" >
                                <thead>
                                    <tr class="text-center">
                                        <th>DETAIL</th>
                                        <th>MATRICULE</th>
                                        <th>NOM</th>
                                        <th>PRENOM</th>
                                        <th>GENRE</th>
                                        <th>TELEPHONE</th>
                                        <th>ADRESSE</th>
                                        <th>MATIERE</th>              
                                        <th>DIPLOME</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($enseignants as $enseignant): ?>
                                    <tr class="text-center">
                                        <td>
                                            <li style="list-style: none;"><a href="detailEnseignant.php?matricule=<?php echo $enseignant['matricule']; ?>" class="dropdown"><i class="fas fa-eye"></i></a></li>
                                        </td>
                                        <td>
                                            <?php echo $enseignant['matricule']; ?>
                                        </td>
                                        <td>
                                            <?php echo $enseignant['nom']; ?>
                                        </td>
                                        <td>
                                            <?php echo $enseignant['prenom']; ?>
                                        </td>
                                        <td>
                                            <?php echo $enseignant['genre']; ?>
                                        </td>
                                        <td>
                                            <?php echo $enseignant['telephone']; ?>
                                        </td>
                                        <td>
                                            <?php echo $enseignant['adresse']; ?>
                                        </td>
                                        <td>
                                            <?php echo $enseignant['matiere']; ?>
                                        </td>
                                        <td>
                                            <?php echo $enseignant['diplome']; ?>
                                        </td>
                                        <td>
                                            <?php echo $enseignant['status_en']; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <span class="flaticon-more-button-of-three-dots"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="supprimerEnseignant.php?matricule=<?php echo $enseignant['matricule']; ?>"
                                                        onclick="return confirm('Voulez-vous supprimer enseignant <?php echo '[ '.$enseignant['prenom'].' '.$enseignant['nom'].' ]'; ?> ?')">
                                                        <i class="fas fa-times text-orange-red"></i> Supprimer</a>
                                                    <a class="dropdown-item"
                                                        href="modifierEnseignant.php?matricule=<?php echo $enseignant['matricule']; ?>"><i
                                                            class="fas fa-edit text-dark-pastel-green"></i> Modifier</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- Footer Area Start Here -->
                <?php 
                require '../config/footer.php';
                require '../config/boiteImprimerEnseignant.php';
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
    <script src="../assets/js/impression.js"></script>                                   


</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/admit-form.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:48:42 GMT -->

</html>