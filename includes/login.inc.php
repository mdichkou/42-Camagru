<?php
session_start();
require("../config/connection.inc.php");
$stmt = $pdo->prepare("SELECT actif FROM users WHERE id = ? ");
if (empty($_SESSION['id']))
  header("Location: ../index.php");
if($stmt->execute([$_SESSION['id']])  && $row = $stmt->fetch())
{
  $actif = $row['actif'];
}
else
  header("Location: ../index.php");
if($actif == '1')
  {
    header("Location: ../home.php");
  }
else if ($actif == '0')
  {
      echo "Activate Your Email ! A verification email were sent to <b> Email </b><br/> Please open your email inbox and click the given link so you can login";
      session_destroy();
  }
  ?>