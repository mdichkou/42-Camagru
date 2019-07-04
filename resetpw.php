<?php
session_start();
require('config/connection.inc.php');
require('includes/mylibrary.php');
$app = new User();
if (empty($_GET['log']) || empty($_GET['cle']))
    header("Location: index.php");
if (!empty($_GET['log']))
{
    $_SESSION['log'] = $_GET['log'];
    $_SESSION['cle'] = $_GET['cle'];
}

$login_error_pw = "";
$stmt = $pdo->prepare("SELECT cle FROM users WHERE username = ?");
if($stmt->execute([$_SESSION['log']]) && $row = $stmt->fetch())
  {
    $clebdd = $row['cle'];
  }
if($_SESSION['cle'] != $clebdd)
    header("Location: index.php");
if (isset($_POST['btnchange']))
{
    if($_SESSION['cle'] == $clebdd) {
        if ($app->checkpassword($_POST['newpw']))
        {
                $pwdhash = password_hash($_POST['newpw'], PASSWORD_BCRYPT);
                  $stmt = $pdo->prepare("UPDATE users SET passowrd = ? WHERE username = ?");
                  $stmt->execute([$pwdhash,$_SESSION['log']]);
                  session_destroy();
                  header("Location: signin.php");
        }
        else
            $login_error_pw = "your password are weak ,  <= 8 charachter , at leaste one number , at least one lettre";
        }
        else
            $login_error_pw = "Erreur ! Votre pasword ne peut être change...";
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
<main>
<div class="row signup_row">
    <div class="bg col-sm-4 col-sm-offset-4">
            <p class="txt_signup">
                <b>Reset Password</b>
            </p>
            <?php
            if ($login_error_pw != "") {
                echo ' <div class="alert alert-danger">
                <strong>Error: </strong> ' . $login_error_pw . ' </div> ';
            }
            ?>
             <form  action="resetpw.php" method="post">
                <input type="password" name="newpw" placeholder="New password" required class="btn_max form-control"><br>
                <button type="submit" name="btnchange" class="btn center-block">Change</button><br>
            </form>
    </div>
</div>
</main>
<?php include 'footer.php';?>
<body>
</html>