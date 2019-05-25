<?php
session_start();
require('../config/setup.php');
require('mylibrary.php');
$app = new User();
if(empty($_SESSION['user_id']))
{
    header("Location: ../index.php");
}
if (isset($_POST['btncomment']) && !empty($_POST['subject']))
{
    $app->save_comment($_POST['imageid'],$_POST['subject'],$_SESSION['id'],$pdo);
    header("Location: ../home.php");
}
if (isset($_POST['btnlike']))
{
    $app->save_like($_POST['imageid'],$_SESSION['id'],$pdo);
    header("Location: ../home.php");
}
if (isset($_POST['btnunlike']))
{
    $app->delete_like($_POST['imageid'],$_SESSION['id'],$pdo);
    header("Location: ../home.php");
}
?>