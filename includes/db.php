<?php
// includes/db.php
$host = 'localhost';
$db   = 'mini_blog_shop';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=localhost;dbname=mini_blog_shop;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    echo "Database connected successfully!";
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
