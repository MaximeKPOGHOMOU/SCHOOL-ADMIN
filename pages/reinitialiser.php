<?php
require_once '../vendor/autoload.php';
require '../fonctions/fonction.php';

use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

// Vérifier si le formulaire a été soumis
if(isset($_POST['envoi'])){
    try {
        // Créer un transport SMTP vers localhost
        $transport = Transport::fromDsn('smtp://imap.gmail.com');
        $mailer = new Mailer($transport);


        // Récupérer l'e-mail saisi dans le formulaire
        $email = $_POST['email'];
        $password = genererPassWord();


        // Créer un nouvel e-mail
        $email = (new Email())
            ->from('hello@example.com')
            ->to($email)
            ->subject('Réinitialisation du mot de passe')
            ->text('Votre nouveau mot de passe est : ' . $password)
            ->html('<p>Votre nouveau mot de passe est : ' . $password . '</p>');

        // Envoyer l'e-mail
        $mailer->send($email);

        echo "L'e-mail a été envoyé avec succès !";
    } catch (TransportException $e) {
        echo "Erreur lors de l'envoi de l'e-mail : " . $e->getMessage();
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
                    <h3>REINITIALISATION DU MOT DE PASSE</h3>
                </div>
                <form action="" class="login-form" method="post">
                        <div class="form-group">
                            <input type="email" placeholder="Email " class="form-control" name="email">
                            
                        </div>
                    <?php if(isset($errors)) : ?>
						<span class="text-red"><?php echo $errors; ?></span>
                    <?php endif; ?>
                    <div class="form-group">
                        <button type="submit" name="envoi" class="login-btn">Envoyé</button>
                    </div>
                    <a href="login.php" class="forgot-btn">Login</a>
                </form>
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