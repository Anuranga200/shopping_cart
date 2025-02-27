<?php
include '../includes/header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ensure an ID is provided
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$post_id = $_GET['id'];

// Fetch the post
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    echo "Post not found.";
    exit;
}

// Verify that the logged-in user owns the post
if ($_SESSION['user_id'] != $post['user_id']) {
    echo "You do not have permission to edit this post.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Post</h2>
        <form action="../actions/update_post_action.php" method="POST">
            <!-- Hidden field to carry the post ID -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">
            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Content</label>
                <textarea name="content" required class="w-full p-2 border rounded"><?= htmlspecialchars($post['content']) ?></textarea>
            </div>
            <button type="submit" class="bg-green-500 text-white p-2 rounded">Update Post</button>
        </form>
        <a href="dashboard.php" class="bg-gray-500 text-white p-2 rounded inline-block mt-4">Back to Dashboard</a>
    </div>
</body>
</html>
