<?php
include '../includes/header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db.php';

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>
<?php include '../includes/head.php'; ?>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Products</h2>
        <div class="grid grid-cols-3 gap-4">
            <?php foreach ($products as $product): ?>
                <div class="bg-white p-4 rounded shadow">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="mb-2">
                    <h3 class="font-bold"><?= htmlspecialchars($product['name']) ?></h3>
                    <p>LKR<?= htmlspecialchars($product['price']) ?></p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="../actions/add_to_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit" class="mt-2 bg-blue-500 text-white p-1 rounded">Add to Cart</button>
                        </form>
                    <?php else: ?>
                        <p><a href="login.php" class="text-blue-500">Log in</a> to add to cart</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

