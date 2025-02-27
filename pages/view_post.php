<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/db.php';
include '../includes/header.php';
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Post ID is missing.");
}

$post_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT posts.*, users.name as author FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    echo "Post not found.";
    exit;
}
?>
<?php include '../includes/head.php'; ?>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($post['title']) ?></h2>
        <p class="text-gray-600 mb-4">
            By <?= htmlspecialchars($post['author']) ?> on <?= htmlspecialchars($post['created_at']) ?>
        </p>
        <div class="mb-4">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </div>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
            <a href="edit_post.php?id=<?= $post['id'] ?>" class="bg-blue-500 text-white p-2 rounded">Edit Post</a>
        <?php endif; ?>
        <a href="dashboard.php" class="bg-gray-500 text-white p-2 rounded inline-block mt-4">Back to Dashboard</a>
    </div>
</body>
</html>
