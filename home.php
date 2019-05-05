<?php
session_start();
 
if(empty($_SESSION['user_id']))
{
    header("Location: index.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'header.php';?>
<div class="layout" >
  <?php
  include("config/setup.php");
  $req = $pdo->prepare("SELECT * FROM `images` ORDER BY `images`.`creating_date` ASC");
  $req->execute();
  $i = 0;
  while ($i < $req->rowCount())
  {
    $res = $req->fetch();
    $name = $res['img_name'];
    echo '<p><img src="'.$name.'"/></p>';
    $i++;
  }
  ?>
  </div>
</body>
</html>