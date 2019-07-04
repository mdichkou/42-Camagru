<?php
session_start();
if(!empty($_SESSION['id']))
{
    header("Location: home.php");
}
require('includes/mylibrary.php');
require('config/connection.inc.php');
$app = new User();
$login_error_message = '';
if (isset($_POST['btnlogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = $app->Login($username, $password,$pdo);
    if(!empty($user))
    {
        $_SESSION = $user;
        header("Location: includes/login.inc.php");
    }
    else
    {
        $login_error_message = 'Invalid login details!';
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/camagru.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'includes/header.inc.php';?>
<main class="container">
<div class="row signup_row">
    <div class="bg col-sm-4 col-sm-offset-4">
            <p class="txt_signup">
                <b>Log in</b>
            </p>
            <?php
            if ($login_error_message != "") {
                echo ' <div class="alert alert-danger">
                <strong>Error: </strong> ' . $login_error_message . ' </div> ';
            }
            ?>
             <form  action="signin.php" method="post">
                <input type="text" name="username" placeholder="Username" required class="btn_max form-control"><br>
                <input type="password" name="password" placeholder="Password" required class="btn_max form-control"><br>
                <button type="submit" name="btnlogin" class="btn center-block">Sign in</button><br>
                <a class="center-block" href="forgotpw.php">Forgot password?</a>
            </form>
    </div>
</div>
</main>
<?php include 'footer.php';?>
<body>
</html>