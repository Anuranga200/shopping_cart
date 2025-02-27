<?php
include '../includes/header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<?php include '../includes/head.php'; ?>

<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Create a New Post</h2>
        <form action="../actions/create_post_action.php" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" required class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Content</label>
                <textarea name="content" required class="w-full p-2 border rounded"></textarea>
            </div>
            <button type="submit" class="bg-green-500 text-white p-2 rounded">Publish</button>
        </form>
    </div>
</body>
</html>
