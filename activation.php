<?php
require('config/connection.inc.php');
if (empty($_GET['log']) || empty($_GET['cle']))
  header("Location: index.php");
$login = $_GET['log'];
$cle = $_GET['cle'];
$stmt = $pdo->prepare("SELECT cle,actif FROM users WHERE username = ?");
if($stmt->execute([$login]) && $row = $stmt->fetch())
{
  $clebdd = $row['cle'];
  $actif = $row['actif'];
}
else
die("Erreur !");
if($cle != $clebdd)	
  die("Erreur !");
if($actif == '1')
{
  echo "Votre compte est déjà actif !";
}
else
  {	
    echo "Votre compte a bien été activé !";
    $stmt = $pdo->prepare("UPDATE users SET actif = 1 WHERE username = ?");
    $stmt->execute([$login]);
  }
  ?>