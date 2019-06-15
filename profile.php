<?php
session_start();
if (empty($_SESSION['id']))
  header("Location: index.php");
require('config/connection.inc.php');
if (empty($_SESSION))
  header("Location: index.php");
$req = $pdo->prepare("SELECT * FROM `images` WHERE images.userid = ? ORDER BY `images`.`creating_date` ASC");
$req->execute([$_SESSION['id']]);
$res = $req->fetchall();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/camagru.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'header.php';?>
<main>
<div class="profile">
    <div class="profile-image">
        <img src="img/pdp.svg" alt="">
    </div>
<form method="post" action="edite_profile.php" >
<div class="profile-user-settings">
    <h1 class="profile-user-name"><?=htmlspecialchars($_SESSION['username'])?></h1>
    <button class="btn profile-edit-btn">Edit Profile</button>
</div>
</form>
    <div class="profile-bio">
        <p><span class="profile-real-name"><?=htmlspecialchars($_SESSION['name'])?></span>
    </div>
</div>
<div class="layout" >
    <div class="gallery">
        <?php foreach ($res as $elem): ?>
            <div class="gallery-item"><img width="300px" src="<?=htmlspecialchars($elem['img_name'])?>"/></div>
        <?php endforeach ?>
    </div>
</div>
</main>
<?php include 'footer.php';?>
</body>
</html>