<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

$cart_id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
$stmt->execute([$cart_id, $_SESSION['user_id']]);

header("Location: ../pages/cart.php");
?>
