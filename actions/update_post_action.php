<?php
session_start();
require_once '../includes/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Retrieve the post to verify ownership
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();

    if (!$post) {
        echo "Post not found.";
        exit;
    }

    // Ensure the logged-in user is the owner
    if ($_SESSION['user_id'] != $post['user_id']) {
        echo "You do not have permission to edit this post.";
        exit;
    }

    // Update the post using a prepared statement
    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $post_id]);

    // Redirect to view the updated post
    header("Location: ../pages/view_post.php?id=" . $post_id);
}
?>
