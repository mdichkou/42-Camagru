<?php
session_start();
if (isset($_POST['btnlogout'])) {
    unset($_SESSION['user_id']);
    header("Location: ../index.php");
}
?>