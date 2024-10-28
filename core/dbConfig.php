<?php 

$host = "localhost";
$user = "root";
$password = "";
$SANTOS = "SANTOS"; 
$dsn = "mysql:host={$host};dbname={$SANTOS}";

try {
    $pdo = new PDO($dsn, $user, $password);
    $conn = new PDO($dsn, $user, $password);
    $conn->exec("SET time_zone = '+08:00';");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>