<?php
session_start();
 
if(empty($_SESSION['user_id']))
{
    header("Location: index.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="topnav row">
        <div class="logo col-sm-4">
            <img src="img/instagram.svg" >
            <h4 >Camagru</h4>
        </div>
        <div class="login col-sm-4 col-sm-offset-6">
                <form  action="includes/logout.inc.php" method="post" class="icons">
                        <a href="camera.php" target="main"><img src="img/camera.svg"alt=""></a>
                        <a href=""><img src="img/user.svg" alt=""></a>
                        <button type="submit" name="btnlogout" class="btn">Logout</button>
                </form>
        </div>
    </div>
      <iframe src="galerie.php" class="ifra" width="100%" height="800" name="main"></iframe>
</body>
</html>