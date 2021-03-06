<?php
session_start();
require('config/connection.inc.php');
require('includes/mylibrary.php');
$app = new User();
$limit = 5;

$req = $pdo->prepare("SELECT * FROM `images` i");
$req->execute();
$total_results = $req->rowCount();
$total_pages = ceil($total_results/$limit);
if (isset($_GET['page']) && $total_pages >= $_GET['page'] && $_GET['page'] > 0) {
    $page = $_GET['page'];
} else{
    $page = 1;
}
$starting_limit = ($page-1)*$limit;
$req = $pdo->prepare("SELECT * FROM `images` i , users u WHERE i.userid = u.id  ORDER BY i.creating_date DESC LIMIT :v1 , :v2");
$req->bindValue(':v1', $starting_limit, PDO::PARAM_INT);
$req->bindValue(':v2', $limit, PDO::PARAM_INT);
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
<?php 
if (empty($_SESSION['id']))
    include 'includes/header.inc.php';
else
    include 'header.php';
?>
<main>
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
        <img src="<?=htmlspecialchars($elem['img_name'])?>" class="content img-fluid" />
    </div>
    <form id="comment-form" action="includes/comments.inc.php" method="post">
    <?php
        $reql = $pdo->prepare("SELECT COUNT(*) as nb FROM likes where picture_id = ?");
        $reql->execute([$elem['imageid']]);
        $like = $reql->fetch();
    ?>
    <?php 
    if (!empty($_SESSION['id']))
        echo ($app->isLiked($_SESSION['id'],$elem['imageid'],$pdo) == 1) ? '<input type="submit" name="btnunlike" class="button-unlike" value="UnLike">' 
    : '<input type="submit" name="btnlike" class="button-like" value="Like">';
    else
        echo '<input type="submit" name="btnlike" class="button-like" disabled value="Like">';
     ?>
    <span><?=$like['nb']?> Likes</span>
        <input type="text"  name="subject" class="comment-input" placeholder="Comment">
        <input type="text" name="imageid" hidden value="<?=htmlspecialchars($elem['imageid'])?>">
        <?php echo (empty($_SESSION['id'])) ? '<input type="submit" name="btncomment" value="Post" class="comment-btn" disabled>' : '<input type="submit" name="btncomment" value="Post" class="comment-btn">' ?>
      </form>
      <ul id="comment-stream" class="comment-stream" style="overflow-y: scroll; max-height: 105px;">
        <?php
            $reqt = $pdo->prepare("SELECT * FROM comment WHERE imageid = ? ORDER BY creating_date DESC");
            $reqt->execute([$elem['imageid']]);
            $cmt = $reqt->fetchall();
        ?>
        <?php foreach ($cmt as $elemnt): ?>
                <li><?php
                $reqt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
                $reqt->execute([$elemnt['userid']]);
                $name = $reqt->fetch();
                echo htmlspecialchars($name['username']) . ":   " . htmlspecialchars($elemnt['comment']);?></li>
        <?php endforeach ?>
    </ul>
    </div>
    <?php endforeach ?>
    <div>
    <?php for ($page=1; $page <= $total_pages ; $page++):?>
        <a href='<?php echo "?page=$page"; ?>' class="links"><?php  echo $page; ?></a>
    <?php endfor; ?>
    </div>
</main>
<?php include 'footer.php';?>
</body>
</html>