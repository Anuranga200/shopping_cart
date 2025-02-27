<?php
include '../includes/header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../includes/db.php';

$stmt = $pdo->query("SELECT posts.*, users.name AS author FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
$posts = $stmt->fetchAll();
?>
<?php include '../includes/head.php'; ?>
<body>
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h1>
    <h2 class="text-5xl font-semibold mb-2">Recent Posts</h2>
    <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post p-6 bg-white shadow-md rounded-lg mb-4">
                <h3 class="font-bold text-lg"><?= htmlspecialchars($post['title']) ?></h3>
                <p class="text-gray-700"><?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...</p>
                <p class="text-sm text-gray-500">By <?= htmlspecialchars($post['author']) ?> on <?= $post['created_at'] ?></p>
                <a href="view_post.php?id=<?= $post['id'] ?>" class="text-blue-500 font-semibold">Read more</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-gray-500">No posts available.</p>
    <?php endif; ?>
    <a href="logout.php" class="text-red-500 mb-4 inline-block">Logout</a>
</div>

</body>
</html>

