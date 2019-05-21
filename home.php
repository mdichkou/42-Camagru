<?php
session_start();
 
if(empty($_SESSION['user_id']))
{
    header("Location: index.php");
}
include("config/setup.php");
$req = $pdo->prepare("SELECT * FROM `images` i , users u WHERE i.userid = u.id  ORDER BY i.creating_date DESC");
$req->execute();
$res = $req->fetchall();
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
<div class="layout" >
  <?php
  ?>
  <?php foreach ($res as $elem): ?>
    <div class="card">
    <div class="card-header">
    <div class="profile-info">
        <div class="name"><?=htmlspecialchars($elem['username'])?></div>
    </div>
    <div class="time">
    <?=htmlspecialchars($elem['creating_date'])?>
    </div>
    </div>
    <div class="content">
        <img src="<?=htmlspecialchars($elem['img_name'])?>" class="content" />
    </div>
    <form id="comment-form">
        <input type="text" id="comment-input" class="comment-input" placeholder="Comment">
        <input type="submit" value="Post" class="comment-btn">
      </form>
    </div>
    <ul id="comment-stream" class="comment-stream">
        </ul>
    </div>
    <?php endforeach ?>
  </div>
</body>
</html>