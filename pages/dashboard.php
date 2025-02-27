<?php
// pages/dashboard.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../includes/db.php';

// Example query to fetch posts with author information.
$stmt = $pdo->query("SELECT posts.*, users.name AS author FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
$posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
    <a href="logout.php">Logout</a>
    
    <h2>Recent Posts</h2>
    <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post p-4 border rounded mb-4">
                <h3 class="font-bold"><?= htmlspecialchars($post['title']) ?></h3>
                <p><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
                <p class="text-sm text-gray-600">By <?= htmlspecialchars($post['author']) ?> on <?= $post['created_at'] ?></p>
                <a href="view_post.php?id=<?= $post['id'] ?>" class="text-blue-500">Read more</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts available.</p>
    <?php endif; ?>
</body>
</html>
