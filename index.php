<?php
session_start();
if(!empty($_SESSION['user_id']))
{
    header("Location: home.php");
}
include('includes/mylibrary.php');
include('config/setup.php');
$app = new User();
$login_error_message = '';
$register_error_message = '';
if (isset($_POST['btnlogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "") {
        $login_error_message = 'Username field is required!';
    } else if ($password == "") {
        $login_error_message = 'Password field is required!';
    } else {
        $user_id = $app->Login($username, $password,$pdo);
        if($user_id > 0)
        {
            $_SESSION['user_id'] = $user_id;
            header("Location: home.php"); 
        }
        else
        {
            $login_error_message = 'Invalid login details!';
        }
    }
}
if (isset($_POST['btnsignup'])) {
    if ($_POST['name'] == "") {
        $register_error_message = 'Name field is required!';
    } else if ($_POST['email'] == "") {
        $register_error_message = 'Email field is required!';
    } else if ($_POST['username'] == "") {
        $register_error_message = 'Username field is required!';
    } else if ($_POST['pwd'] == "") {
        $register_error_message = 'Password field is required!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $register_error_message = 'Invalid email address!';
    } else if ($app->isEmail($_POST['email'],$pdo)) {
        $register_error_message = 'Email is already in use!';
    } else if ($app->isUsername($_POST['username'],$pdo)) {
        $register_error_message = 'Username is already in use!';
    } else {
        $user_id = $app->Register($_POST['name'], $_POST['email'], $_POST['username'], $_POST['pwd'],$pdo);
        $_SESSION['user_id'] = $user_id;
        header("Location: home.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="topnav row z-depth-5">
        <div class="logo col-sm-6">
            <img src="img/instagram.svg" >
            <h4 >Camagru</h4>
        </div>
        <div class="login col-sm-6">
            <div class="row">
            <?php
            if ($login_error_message != "") {
                echo ' <div class="alert alert-danger">
                <strong>Error: </strong> ' . $login_error_message . ' </div> ';
            }
            ?>
                <form  action="index.php" method="post">
                    <div class="col-sm-4">
                        <input type="text" name="username" placeholder="Username" class="form-control">
                    </div>
                    <div class="password col-sm-4">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    <a>Forget Password?</a>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" name="btnlogin" class="btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div class="row signup_row">
    <div class="bg col-sm-4 col-sm-offset-4">
            <p class="txt_signup">
                <b>Sign up</b> to see photos <br>and videos from your friends
            </p>
            <?php
            if ($register_error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $register_error_message . '</div>';
            }
            ?>
            <form action="index.php" method="post">
                <input type="text" name="email" placeholder="Mobile Number or Email"  class="form-control"><br>
                <input type="text" name="name" placeholder="Full Name"  class="form-control"><br>
                <input type="text" name="username" placeholder="Username"  class="form-control"><br>
                <input type="password" name="pwd" placeholder="Password"  class="form-control"><br>
                <button type="submit" name="btnsignup" class="btn center-block">Sign up</button><br>
            </form>
    </div>
</div>
</body>
</html>