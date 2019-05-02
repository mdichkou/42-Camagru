<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="layout">
  
  <div class="row">
    <div class="cell">
      <video id="player" autoplay></video>
    </div>
    <div class="cell"></div>
      <canvas id="canvas" width="320px" height="240px"></canvas>
    </div>
  </div>
  <div class="center">
    <button class="btn btn-primary" id="capture-btn">Capture</button>
  </div>
  <div id="pick-image">
    <label>Video is not supported. Pick an Image instead</label>
    <input type="file" accept="image/*" id="image-picker">
  </div>
</div>
<script src="js/camera.js"></script>
</body>
</html>