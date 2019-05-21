<?php
session_start();
if(empty($_SESSION['user_id']))
{
    header("Location: ../index.php");
}

if (isset($_POST['btncomment']) && !empty($_POST['subject']))
{
    include('../config/setup.php');
    include('mylibrary.php');
    $app = new User();
    $app->save_comment($_POST['imageid'],$_POST['subject'],$_SESSION['user_id'],$pdo);
    header("Location: ../home.php");
}
?>