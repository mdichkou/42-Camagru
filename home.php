<?php
session_start();
require("config/setup.php");
require('includes/mylibrary.php');
$app = new User();
$req = $pdo->prepare("SELECT * FROM `images` i , users u WHERE i.userid = u.id  ORDER BY i.creating_date DESC");
$req->execute();
$res = $req->fetchall();
$reqt = $pdo->prepare("SELECT * FROM comment ORDER BY creating_date DESC");
$reqt->execute();
$cmt = $reqt->fetchall();
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
  <?php
  ?>
  <?php foreach ($res as $elem):?>
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
    <form id="comment-form" action="includes/comments.inc.php" method="post">
    <?php
        $reql = $pdo->prepare("SELECT COUNT(*) as nb FROM likes where picture_id = ?");
        $reql->execute([$elem['imageid']]);
        $like = $reql->fetch();
    ?>
    <?php echo ($app->isLiked($_SESSION['id'],$elem['imageid'],$pdo) == 1) ? '<button name="btnunlike" class="button-unlike">UnLike</button>' 
    : '<button name="btnlike" class="button-like">Like</button>'; ?>
    <span><?=$like['nb']?> Likes</span>
        <input type="text"  name="subject" class="comment-input" placeholder="Comment">
        <input type="text" name="imageid" class="comment-input" hidden value="<?=htmlspecialchars($elem['imageid'])?>">
        <input type="submit" name="btncomment" value="Post" class="comment-btn">
      </form>
    </div>
    <ul id="comment-stream" class="comment-stream">
        <?php foreach ($cmt as $elemnt): ?>
            <?php if ($elem['imageid'] == $elemnt['imageid']): ?>
                <li><?=$elemnt['comment']?></li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
    </div>
    <?php endforeach ?>
</body>
</html>