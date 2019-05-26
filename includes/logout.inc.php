<?php
session_start();
if (isset($_POST['btnlogout'])) {
    session_destroy();
    header("Location: ../index.php");
}
?>