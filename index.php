<?php
session_start();
if(!empty($_SESSION))
{
    header("Location: home.php");
}
require('includes/mylibrary.php');
require('config/connection.inc.php');
$app = new User();
$register_error_message = '';
if (isset($_POST['btnsignup'])) { 
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $register_error_message = 'Invalid email address!';
    } else if ($app->isEmail($_POST['email'],$pdo)) {
        $register_error_message = 'Email is already in use!';
    } else if ($app->isUsername($_POST['username'],$pdo)) {
        $register_error_message = 'Username is already in use!';
    } else {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $verificationCode = str_shuffle($permitted_chars);
            $destinataire = $_POST['email'];
            $sujet = "Activer votre compte" ;
            $entete = "From: mdichkou@camagru.com" ;

            $message = 'Bienvenue sur Camagru,
             
            Pour activer votre compte, veuillez cliquer sur le lien ci dessous
            ou copier/coller dans votre navigateur internet.
             
            http://localhost:8001/42-Camagru/activation.php?log='.urlencode($_POST['username']).'&cle='.urlencode($verificationCode).'
             
             
            ---------------
            Ceci est un mail automatique, Merci de ne pas y répondre.';
            if(mail($destinataire, $sujet, $message, $entete))
            {
                $userid = $app->Registre($_POST['username'], $_POST['pwd'], $_POST['email'], $_POST['name'], $verificationCode,$pdo);
                $_SESSION = $app->find_user($userid,$pdo);
                header("Location: includes/login.inc.php");
        }
        else{
            echo 'false';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/camagru.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'includes/header.inc.php';?>
<div class="row signup_row">
    <div class="bg col-sm-4 col-sm-offset-4">
            <p class="txt_signup">
                <b>Sign up</b> to see photos <br> from your friends
            </p>
            <?php
            if ($register_error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $register_error_message . '</div>';
            }
            ?>
            <form action="index.php" method="post">
                <input type="text" name="email" placeholder=" Email" required  class="btn_max form-control"><br>
                <input type="text" name="name" placeholder="Full Name" required class="btn_max form-control"><br>
                <input type="text" name="username" placeholder="Username" required class="btn_max form-control"><br>
                <input type="password" name="pwd" placeholder="Password" class="btn_max form-control"><br>
                <button type="submit" name="btnsignup" class="btn center-block">Sign up</button><br>
            </form>
    </div>
</div>
</body>
</html>