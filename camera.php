<?php
session_start();
require("config/setup.php");
$req = $pdo->prepare("SELECT * FROM `images` , users WHERE images.userid = ? AND users.id = ? ORDER BY `images`.`creating_date` DESC");
$req->execute([$_SESSION['id'],$_SESSION['id']]);
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
<div class="col-sm-4 col-sm-offset-4" style="margin-top: 20px;">
<table>
<tr><td width="490px" height="390px"><canvas id="canvas" hidden width="490px" height="390px"></canvas>
<img class="image2" id="mask" src="" style="visibility: hidden;" width="200px" height="200px"/>
      <video id="player" class="" autoplay ></video></td></tr>
      <tr><td><select class="btn-primary center-block" id="effect" >
      <option value="off">Select your mask</option>
      <option value="batman">Batman</option>
      <option value="joker">Joker</option>
      <option value="iron">Iron Man</option>
    </select></td></tr>
    <tr><td><button class="btn center-block" name="save" id="save-btn">Capture</button></td></tr>
    <tr><td><button class="btn center-block" name="upload" id="upload-btn">Upload</button></td></tr>
    <tr><td><input  type="file" id="inp"></td></tr>
    <tr><td><canvas id="canvas2" width="490px" height="390px"></canvas></td></tr>
    </table>
</div>
<div class="col-sm-4" style="overflow-y: scroll; max-height: 390px;">
<table  >
<?php foreach ($res as $elem): ?>
<tr><td><img width="300px" height="200px"src="<?=htmlspecialchars($elem['img_name'])?>"/></td></tr>
<?php endforeach ?>
</table>
</div>
<script src="js/camera.js"></script>
</body>
</html>