<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'header.php';?>
<div class="layout">
  <div class="row">
    <div class="cell">
      <video id="player" autoplay></video>
    </div>
    <div class="cell"></div>
      <canvas id="canvas" width="490px" height="390px"></canvas>
    </div>
  </div>
  <div class="center">
    <button class="btn btn-primary" name="capture" id="capture-btn">Capture</button>
    <button class="btn btn-primary" name="save" id="save-btn">Save</button>
  </div>
</div>
<script src="js/camera.js"></script>
</body>
</html>