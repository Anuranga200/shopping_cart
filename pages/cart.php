<!-- pages/cart.php -->
<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT cart.id as cart_id, products.*, cart.quantity 
    FROM cart 
    JOIN products ON cart.product_id = products.id 
    WHERE cart.user_id = ?
");
$stmt->execute([$user_id]);
$cartItems = $stmt->fetchAll();

$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Your Shopping Cart</h2>
        <?php if (empty($cartItems)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table class="w-full bg-white shadow rounded">
                <thead>
                    <tr>
                        <th class="p-2 border">Product</th>
                        <th class="p-2 border">Price</th>
                        <th class="p-2 border">Quantity</th>
                        <th class="p-2 border">Subtotal</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td class="p-2 border"><?= htmlspecialchars($item['name']) ?></td>
                            <td class="p-2 border">$<?= htmlspecialchars($item['price']) ?></td>
                            <td class="p-2 border"><?= htmlspecialchars($item['quantity']) ?></td>
                            <td class="p-2 border">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                            <td class="p-2 border">
                                <a href="../actions/remove_from_cart.php?id=<?= $item['cart_id'] ?>" class="text-red-500">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="mt-4">
                <strong>Total: $<?= number_format($total, 2) ?></strong>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
