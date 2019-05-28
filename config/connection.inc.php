<?php
require('database.php');
try {
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>