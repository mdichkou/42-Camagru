<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'header.php';?>
<?php
include("config/setup.php");
$req = $pdo->prepare("SELECT * FROM `users` WHERE id = ?");
$req->execute([$_SESSION['user_id']]);
$res = $req->fetch();
echo '<div class="profile">
<div class="profile-image">
				<img src="img/pdp.svg" alt="">
			</div>
<div class="profile-user-settings">
    <h1 class="profile-user-name">'.$res['username'].'</h1>
    <button class="btn profile-edit-btn">Edit Profile</button>
    <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>
</div>
<div class="profile-bio">

				<p><span class="profile-real-name">'.$res['name'].'</span>
			</div>
</div>';
?>
<div class="layout" >
    <div class="gallery">
  <?php
  include("config/setup.php");
  $req = $pdo->prepare("SELECT * FROM `images` WHERE userid = ? ORDER BY `images`.`creating_date` ASC");
  $req->execute([$_SESSION['user_id']]);
  $i = 0;
  while ($i < $req->rowCount())
  {
    $res = $req->fetch();
    $name = $res['img_name'];
    echo '<div class="gallery-item"><img width="300px" src="'.$name.'"/></div>';
    $i++;
  }
  ?>
  </div>
  </div>
</body>
</html>