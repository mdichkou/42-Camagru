<?php
session_start();
require("../config/connection.inc.php");
require('mylibrary.php');
$app = new User();
if(empty($_SESSION['id']))
{
    header("Location: ../home.php");
}
if (isset($_POST['btncomment']) && !empty(trim($_POST['subject'])))
{
    $app->save_comment($_POST['imageid'],$_POST['subject'],$_SESSION['id'],$pdo);
    $query = $pdo->prepare("SELECT * FROM images WHERE imageid = ?");
    $query->execute([$_POST['imageid']]);
    $res = $query->fetch();
    $user = $app->find_user($res['userid'],$pdo);
    if ($user['mailing'] == 1 && $user['username'] != $_SESSION['username'])
    {
        $destinataire = $user['email'];
        $sujet = "Commentaire";
        $entete = "From: mdichkou@camagru.com" ;
        $message = $_SESSION['username'] .'  commented your picture';
        mail($destinataire, $sujet, $message, $entete);
    }
    header("Location: ../home.php");
}
else
    header("Location: ../home.php");
if (isset($_POST['btnlike']))
{
    $app->save_like($_POST['imageid'],$_SESSION['id'],$pdo);
    $query = $pdo->prepare("SELECT * FROM images WHERE imageid = ?");
    $query->execute([$_POST['imageid']]);
    $res = $query->fetch();
    $user = $app->find_user($res['userid'],$pdo);
    if ($user['mailing'] == 1 && $user['username'] != $_SESSION['username'])
    {
        $destinataire = $user['email'];
        $sujet = "J'aime";
        $entete = "From: mdichkou@camagru.com" ;
        $message = $_SESSION['username'] .'  Liked your picture';
        mail($destinataire, $sujet, $message, $entete);
    }
    header("Location: ../home.php");
}
if (isset($_POST['btnunlike']))
{
    $app->delete_like($_POST['imageid'],$_SESSION['id'],$pdo);
    header("Location: ../home.php");
}
?>