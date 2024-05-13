<?php require '../fonctions/fonction.php'; 
 if(!isset($_SESSION['email'])){
    header('Location:login.php');
}?>

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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Modernize js -->
    <script src="../assets/js/modernizr-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../assets/css/table.css">
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <div class="dashboard-page-one">
            <div class="dashboard-content-one">                
                <div class="card height-auto">
                    <div class="card-body ">
                        <div class="card height-auto">
                            <div class="single-info-details">
                                <div class="item-content">
                                    <div class="header-inline item-header">
                                        <div class="header-elements">
                                            <ul>
                                                <li><a href="listEtudiant.php"><i class="fas fa-angle-left"></i></a></li>
                                                <li><a href="#" id="imprimer" onclick="imprimerEtudiant()"><i class="fas fa-print"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <script>
                            function imprimerEtudiant() {
                            window.print();
                            }
                        </script>
                        <div class="table-responsive">
                            <?php       
                                $pdo = database();
                                $sql= getEtudiants();
                                if(isset($_POST['btnSubEtudiant'])){
                                    $promotion = $_POST['promotion'];
                                    $annee = $_POST['annee'];
                                    $conditions = array(); // Tableau pour stocker les conditions
            
                                    if(!empty($promotion)){
                                        $conditions[] = "promotion = '$promotion'";
                                    }
            
                                    if(!empty($annee)){
                                        $conditions[] = "annee = '$annee'";
                                    }
            
                                    if(!empty($conditions)){
                                        // Si des conditions ont été ajoutées, les concaténer avec AND
                                        $sql .= " WHERE " . implode(" AND ", $conditions);
                                    } else {
                                        echo "Veuillez sélectionner un critère de recherche ! ";
                                    }
                                }
                                $etudiants=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

                                // if(isset($_GET['data'])) {
                                //     $tableData = json_decode(urldecode($_GET['data']), true);
                                //     foreach($tableData as $row) {          
                                //         foreach($row as $cell) {
                                //             echo "<td>$cell</td>";
                                //         }
                                //         echo "</tr>";
                                //     }
                                // }      
                                echo '<table>'; 
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th><h1 style="font-size:20px;">INSTITUT SUPERIEUR DE TECHNOLOGIE</h1>
                                <h1 style="font-size:15px;"> DE MAMOU</h1><h1 style="font-size:15px;">BP:63/Email:astourep@gmail.com</h1></th>';
                                echo '<th><img style="width: 80px; height: 80px" class="ist" src="../assets/images/logoist.jpg" alt=""></th>';
                                echo '<th colspan="3"><h1 style="font-size:20px;">DEPARTEMENT: GENIE INFORMATIQUE</h1><h1 style="font-size:15px;">PROMOTION: ' . '</h1><h1 style="font-size:15px;">ANNEE UNIVERSITAIRE: ' .'</h1></th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';                         
                            ?>       
                            <table >
                                <thead>
                                    <tr class="text-center">
                                        <th>N°</th>
                                        <th>MATRICULE</th>
                                        <th>NOM</th>
                                        <th>PRENOM</th>
                                        <th>GENRE</th>
                                        <th>DATE DE NAISSANCE</th>
                                        <th>TELEPHONE</th>
                                        <th>ADRESSE</th>
                                        <th>LICENCE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $nombre = 1;?>
                                    <?php foreach ($etudiants as $etudiant): ?>
                                    <tr class="text-center">
                                        <td>
                                            <?php echo  $nombre ++;  ?>
                                        </td>
                                        <td>
                                            <?php echo $etudiant['matricule']; ?>
                                        </td>
                                        <td>
                                            <?php echo $etudiant['nom']; ?>
                                        </td>
                                        <td>
                                            <?php echo $etudiant['prenom']; ?>
                                        </td>
                                        <td >
                                            <?php echo $etudiant['genre']; ?>
                                        </td>
                                        <td>
                                            <?php echo $etudiant['dateNaiss']; ?>
                                        </td>
                                        <td>
                                            <?php echo $etudiant['telephone']; ?>
                                        </td>
                                        <td>
                                            <?php echo $etudiant['adresse']; ?>
                                        </td>
                                        <!-- <td>
                                            <?php echo $etudiant['promotion']; ?>
                                        </td> -->
                                        <!-- <td>
                                            <?php echo $etudiant['licence']; ?>
                                        </td> -->
                                        <td>
                                            <?php echo $etudiant['annee']; ?>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>  
                <?php require '../config/boiteImprimerEtudiant.php'; ?>                  
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

</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/admit-form.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:48:42 GMT -->

</html>