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
<div class="row signup_row">
    <div class="bg col-sm-4 col-sm-offset-4">
            <p class="txt_signup">
                <b>Sign up</b> to see photos <br>and videos from your friends
            </p>
            <form action="index.php" method="post">
                <input type="text" name="email" placeholder="Mobile Number or Email" required  class="form-control"><br>
                <input type="text" name="name" placeholder="Full Name" required class="form-control"><br>
                <input type="text" name="username" placeholder="Username" required class="form-control"><br>
                <input type="password" name="pwd" placeholder="Password" required class="form-control"><br>
                <button type="submit" name="btnsignup" class="btn center-block">Sign up</button><br>
            </form>
    </div>
</div>
</body>
</html>