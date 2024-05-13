<?php 
require '../fonctions/fonction.php'; 
$infoUser = userProfil();
if(!isset($_SESSION['email'])){
    header('Location:login.php');
}
$matricule = $infoUser['email'];

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
                                <a href="listNote.php" class="nav-link menu-active"><i class="flaticon-script"></i><span>Notes</span></a>
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
                            <li class="nav-item "><a href="listNote.php" class="nav-link menu-active"><i class="flaticon-script"></i><span>Notes</span></a> </li>
                            <li class="nav-item "><a href="#" data-toggle="modal" data-target="#semestre" class="nav-link"><i class="flaticon-calendar"></i><span>Emploi du temps</span></a> </li>
                        <?php endif; ?> 
                    </ul>
                </div>
            </div>
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <?php if($infoUser['droit']=="User") :?>
                    <div class="breadcrumbs-area">
                        <h3>MES NOTES</h3>
                    </div>       
                <?php else: ?>
                    <div class="breadcrumbs-area">
                        <h3>LA LISTE DES NOTES</h3>
                    </div>  
                <?php endif; ?>
                <?php 
                    $pdo = database();
                    $sql= getNote();
                    if(isset($_POST['rechercher'])){
                        $etudiant = $_POST['etudiant'];
                        if(!empty($etudiant)){
                          $sql.=" where etudiant = '$etudiant'";
                        }else{
                          echo "Veillez selectionner un critère de recherche! ";
                        }
                      }
                    $notes=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="card height-auto">
                    <div class="card-body">
                        <?php if($infoUser['droit']=="Super Admin" || $infoUser['droit']=="Admin"): ?>
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Rehercher par:</h3>
                                </div>
                            </div>
                            <form class="mg-b-20" method="POST" action="">
                                <div class="row gutters-8">
                                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                        <select class="select2" id="fetudiant" name="etudiant">
                                            <option value="">Etudiant</option>
                                            <?php 
                                                $pdo = database();
                                                $sql= getEtudiants();      
                                                $etudiants=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ( $etudiants as $etudiant){
                                                    echo "<option value='".$etudiant['matricule']."'>".$etudiant['prenom'].' '.$etudiant['nom']. "</option>";
                                                }
                                                    
                                            ?>
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
                                                            <li><a href="ajoutNote.php" ><i class="fas fa-plus-circle"></i></a></li>
                                                            <li><a href="#" data-toggle="modal" data-target="#promotion"><i class="fas fa-eye"></i></a></li>
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
                                <table class="table display data-table text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ENSEIGNANT</th>
                                            <th>ETUDIANT</th>
                                            <th>MATIERE</th>
                                            <th>MOYENNE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>                              
                                        <?php foreach ($notes as $note): ?>
                                        <tr class="text-center">
                                            <td>
                                                <?php echo $note['nomEnseignant']; ?>
                                            </td>
                                            <td>
                                                <?php echo $note['nomEtudiant']; ?>
                                            </td>
                                            <td>
                                                <?php echo $note['nomMatiere']; ?>
                                            </td>
                                            <td>
                                                <?php echo $note['moyenne']; ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <span class="flaticon-more-button-of-three-dots"></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="supprimerNote.php?code=<?php echo $note['code']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet enregistrement?')"><i class="fas fa-times text-orange-red"></i> Supprimer</a>
                                                        <a class="dropdown-item" href="modifierNote.php?code=<?php echo $note['code']; ?>"><i class="fas fa-edit text-dark-pastel-green"></i> Modifier</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <?php 
                                $numero = 1;
                                $notes = noteIndividuelEtudiant($matricule);
                                $annees_universitaire = annee_scolaire($matricule);                                    
                                if(empty($annees_universitaire)){
                                    $annees_l1 =  $annees_universitaire[0] = '';
                                    $annees_l2 =  $annees_universitaire[1] = '';
                                    $annees_l3 =  $annees_universitaire[2] = '';
                                    $annees_l4 =  $annees_universitaire[3] = '';
                                }else{
                                    $annees_l1 = isset($annees_universitaire[0]) ? $annees_universitaire[0] : '';
                                    $annees_l2 = isset($annees_universitaire[1]) ? $annees_universitaire[1] : '';
                                    $annees_l3 = isset($annees_universitaire[2]) ? $annees_universitaire[2] : '';
                                    $annees_l4 = isset($annees_universitaire[3]) ? $annees_universitaire[3] : '';
                                }
                            ?>
                            <div class="col-12 form-group">
                                <button id="afficherNotes1" class="btn-fill-lg bg-blue-dark btn-hover-yellow btn-block">L1 Génie Info [ <?php echo $annees_l1; ?> ]</button>
                                <div id="infosContainer1" style="display: none;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th class="d-none d-sm-table-cell">Semestre</th>
                                                <th>Matière</th>
                                                <th>Moyenne</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $numero = 1;
                                            foreach ($notes as $note) {
                                                if ($note['semestre'] == 'S1' || $note['semestre'] == 'S2') { ?>
                                                    <tr class="note">                       
                                                        <td><?php echo $numero++; ?></td>
                                                        <td class="d-none d-sm-table-cell"><?php echo $note['semestre']; ?></td>
                                                        <td><?php echo $note['matiere']; ?></td>
                                                        <td><?php echo $note['moyenne']; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <button id="afficherNotes2" class="btn-fill-lg bg-blue-dark btn-hover-yellow btn-block">L2 Génie Info [ <?php  echo $annees_l2; ?> ]</button>
                                <div id="infosContainer2" style="display: none;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th class="d-none d-sm-table-cell">Semestre</th>
                                                <th>Matière</th>
                                                <th>Moyenne</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $numero = 1;
                                            foreach ($notes as $note) {
                                                if ($note['semestre'] == 'S3' || $note['semestre'] == 'S4') { ?>
                                                    <tr class="note">                       
                                                        <td><?php echo $numero++; ?></td>
                                                        <td class="d-none d-sm-table-cell"><?php echo $note['semestre']; ?></td>
                                                        <td><?php echo $note['matiere']; ?></td>
                                                        <td><?php echo $note['moyenne']; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <button id="afficherNotes3" class="btn-fill-lg bg-blue-dark btn-hover-yellow btn-block">L3 Génie Info [ <?php echo $annees_l3; ?> ]</button>
                                <div id="infosContainer3" style="display: none;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th class="d-none d-sm-table-cell">Semestre</th>
                                                <th>Matière</th>
                                                <th>Moyenne</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $numero = 1;
                                            foreach ($notes as $note) {
                                                if ($note['semestre'] == 'S5' || $note['semestre'] == 'S6') { ?>
                                                    <tr class="note">                       
                                                        <td><?php echo $numero++; ?></td>
                                                        <td class="d-none d-sm-table-cell"><?php echo $note['semestre']; ?></td>
                                                        <td><?php echo $note['matiere']; ?></td>
                                                        <td><?php echo $note['moyenne']; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>    
                            <div class="col-12 form-group">
                                <button id="afficherNotes4" class="btn-fill-lg bg-blue-dark btn-hover-yellow btn-block">L4 Génie Info [ <?php  echo $annees_l4; ?> ]</button>
                                <div id="infosContainer4" style="display: none;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th class="d-none d-sm-table-cell">Semestre</th>
                                                <th>Matière</th>
                                                <th>Moyenne</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $numero = 1;
                                            foreach ($notes as $note) {
                                                if ($note['semestre'] == 'S7' || $note['semestre'] == 'S8') { ?>
                                                    <tr class="note">                       
                                                        <td><?=  $numero++; ?></td>
                                                        <td class="d-none d-sm-table-cell"><?= $note['semestre']; ?></td>
                                                        <td><?= $note['matiere']; ?></td>
                                                        <td><?= $note['moyenne']; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>    
                        <?php endif;?> 
                    </div>
                </div>
                <?php 
                require '../config/boiteNote.php';
                require '../config/boiteAccueil.php'; 
                require '../config/footer.php';?>
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
    <script src="../assets/js/script.js"></script>
</body>



<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/admit-form.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:48:42 GMT -->

</html>