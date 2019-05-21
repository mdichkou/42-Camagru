<?php
include('config/setup.php');
$login = $_GET['log'];
$cle = $_GET['cle'];
$stmt = $pdo->prepare("SELECT cle,actif FROM users WHERE username = ?");
if($stmt->execute([$login]) && $row = $stmt->fetch())
  {
    $clebdd = $row['cle'];
    $actif = $row['actif']; 
  }
if($actif == '1') 
  {
     echo "Votre compte est déjà actif !";
  }
else
  {
     if($cle == $clebdd)	
       {	
          echo "Votre compte a bien été activé !";
          $stmt = $pdo->prepare("UPDATE users SET actif = 1 WHERE username = ?");
          $stmt->execute([$login]);
       }
     else 
       {
          echo "Erreur ! Votre compte ne peut être activé...";
       }
  }
  ?>