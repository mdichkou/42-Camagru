<?php
session_start();
if (empty($_SESSION['id']))
  header("Location: index.php");
require("includes/mylibrary.php");
require('config/connection.inc.php');
if (empty($_SESSION))
  header("Location: index.php");
$app = new User();
$save_message = "";
if (isset($_POST['btnsave']))
{
    if (isset($_POST['mail'])) {
        $mailing = "good";
    } else {
        $mailing = "";
    }
    if (!$app->checkpassword($_POST['newpwd']) && !empty($_POST['newpwd']))
    {
        $save_message = "your password are weak ,  <= 8 charachter , at leaste one number , at least one lettre";
    } else if ($app->Update_profile($_POST['username'],$_POST['pwd'],$_POST['newpwd'],$_POST['email'],$mailing,$pdo))
    {
        $save_message = "";
    }
    else
    {
        $save_message = 'Invalid Password!';
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/home.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/camagru.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'header.php';?>
<main>
<div class="row signup_row">
    <div class="bg col-sm-4 col-sm-offset-4">
            <p class="txt_signup">
                <b>Edite</b> Your profile <br>Here
            </p>
            <?php
            if ($save_message != "") {
                echo ' <div class="alert alert-danger">
                <strong>Error: </strong> ' . $save_message . ' </div> ';
            }
            ?>
            <form action="edite_profile.php" method="post">
                <input type="text" name="email" placeholder="Email" required  value="<?=$_SESSION['email']?>" class="form-control"><br>
                <input type="text" name="username" placeholder="Username" value="<?=$_SESSION['username']?>" required class="form-control"><br>
                <input type="password" name="pwd" placeholder="Password is required"  class="form-control"><br>
                <input type="password" name="newpwd" placeholder="New Password" class="form-control"><br>
                <label class="switch">
                <?php echo ($_SESSION['mailing'] == 0) ? '<input type="checkbox" name="mail" value="good">' 
                : '<input type="checkbox" name="mail" value="good" checked>'; ?>
                    <span class="slider round"></span>
                </label>
                <button type="submit" name="btnsave" class="btn center-block">Save</button><br>
            </form>
    </div>
</div>
</main>
<?php include 'footer.php';?>
</body>
</html>