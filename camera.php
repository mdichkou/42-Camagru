<?php
session_start();
if (empty($_SESSION))
  header("Location: index.php");
require('config/connection.inc.php');
require("includes/mylibrary.php");
$app = new User();
$req = $pdo->prepare("SELECT * FROM `images` , users WHERE images.userid = ? AND users.id = ? ORDER BY `images`.`creating_date` DESC");
$req->execute([$_SESSION['id'],$_SESSION['id']]);
$res = $req->fetchall();
if (isset($_POST['btndelete'])) {
    $app->delete_image($_POST['imageid'],$pdo);
    header("Location: camera.php");
}
if (isset($_POST['save']) || isset($_POST['upload'])) {
   header("Location: camera.php");
}
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
<div class="col-sm-4 col-sm-offset-4" style="margin-top: 20px;">
<form action="camera.php" method="post">
<table>
<tr><td width="490px" height="390px"><canvas id="canvas" width="490px" height="390px"></canvas>
<img class="image2" id="mask" src="" style="visibility: hidden;" width="200px" height="200px"/>
      <video id="player" class="" autoplay ></video></td></tr>
      <tr><td><select class="btn-primary center-block" id="effect" disabled>
      <option value="off">Select your mask</option>
      <option value="batman">Batman</option>
      <option value="joker">Joker</option>
      <option value="iron">Iron Man</option>
    </select></td></tr>
    <tr><td><input type="submit" class="btn center-block" name="save" disabled id="save-btn" value="Capture"/>
    </td></tr>
    <tr><td><input type="submit" class="btn center-block" name="upload" disabled id="upload-btn"value="Upload"/></td></tr>
    <tr><td><input  type="file" id="inp"></td></tr>
</table>
</form>
</div>
<div class="col-sm-4" style="margin-top: 20px; overflow-y: scroll; max-height: 390px;">
<table>
<?php foreach ($res as $elem): ?>
<tr><td><img width="300px" height="200px"src="<?=htmlspecialchars($elem['img_name'])?>"/>
<form action="camera.php" method="post">
    <input type="text" name="imageid" hidden value="<?=htmlspecialchars($elem['imageid'])?>">
    <input type="submit" class="btn delete-btn center-block" name="btndelete" value="Delete"/>
    </form></td></tr>
<?php endforeach ?>
</table>
</div>
<script src="js/camera.js"></script>
<?php include 'footer.php';?>
</body>
</html>
