<?php
session_start();
require('config/setup.php');
$stmt = $pdo->prepare("SELECT actif FROM users WHERE id = ? ");
if($stmt->execute([$_SESSION['id']])  && $row = $stmt->fetch())
  {
   	$actif = $row['actif'];
  }
 
 
if($actif == '1')
  {
    header("Location: home.php");
  }
else 
  {
      echo "A verification email were sent to <b> Your email </b><br/> Please open your email inbox and click the given link so you can login";
  }
  ?>