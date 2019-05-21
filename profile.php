<?php
session_start();
include("config/setup.php");
$req = $pdo->prepare("SELECT * FROM `images` , users WHERE images.userid = ? AND users.id = ? ORDER BY `images`.`creating_date` ASC");
$req->execute([$_SESSION['user_id'],$_SESSION['user_id']]);
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
<div class="profile">
<div class="profile-image">
				<img src="img/pdp.svg" alt="">
			</div>
<div class="profile-user-settings">
    <h1 class="profile-user-name"><?=$res[0]['username']?></h1>
    <button class="btn profile-edit-btn">Edit Profile</button>
</div>
<div class="profile-bio">

				<p><span class="profile-real-name"><?=$res[0]['name']?></span>
			</div>
</div>
<div class="layout" >
    <div class="gallery">
        <?php foreach ($res as $elem): ?>
            <div class="gallery-item"><img width="300px" src="<?=$elem['img_name']?>"/></div>
        <?php endforeach ?>
    </div>
</div>
</body>
</html>