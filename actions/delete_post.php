<?php
// actions/delete_post.php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Verify ownership before deleting
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$post_id, $user_id]);

header("Location: ../pages/dashboard.php");
?>
