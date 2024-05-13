<?php 
require '../fonctions/fonction.php';
extract($_POST);
if(isset($connexion)){
    if(empty($email) || empty($password)){
        $errors = "Tous les champs sont obligatoires";
    }else{
        if(connexion($email, $password)){
            $_SESSION['email']=$email;
            $profil = userProfil();
            $date = date("d/m/Y");
            $heure=date("H:i:s");
            $id_user = $profil['id'];
            ajoutHistorique($id_user, $date, $heure, "Connexion");
                header('Location:dashboard.php');
        }else{
            $errors = "Email ou mot passe incorrect!";
        }
    }
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
    <!-- <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png"> -->
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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Modernize js -->
    <script src="../assets/js/modernizr-3.6.0.min.js"></script>
</head>
<style>
    /* body{
        background: url('../assets/images/figure/login-bg.jpg');
    } */
</style>
<body class="login">
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo">
                    <!-- <img src="../assets/images/logo2.png" alt="logo"> -->
                    <h3>AUTHENTIFICATION </h3>
                </div>
                <form action="" class="login-form" method="post">
                    <div class="form-group">
                        <!-- <i class="far fa-envelope mb-5"></i> -->
                        <!-- <input type="text" placeholder="Login " class="form-control" name="email"> -->
                        <input type="text" placeholder="Login" class="form-control" id="fnom" name="email">
                        
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" class="form-control" name="password">
                        <!-- <i class="fas fa-lock"></i> -->
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between">
                        <a href="reinitialiser.php" class="forgot-btn">Mot de passe oublié?</a>
                    </div>
                    <?php if(isset($errors)) : ?>
					<div class="alert bg-danger">
						<span class="text-white"><?php echo $errors; ?></span>
					</div>
                    <?php endif; ?>
                    <div class="form-group">
                        <button type="submit" name="connexion" class="login-btn">Connexion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    <!-- Full Calender Js -->    <!-- Custom Js -->
    <script src="../assets/js/main.js"></script>

</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 10:47:53 GMT -->
</html>