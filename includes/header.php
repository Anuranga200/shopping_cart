<?php
// includes/header.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Mini Blog & Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold"><a href="/pages/dashboard.php">My Mini Blog & Shop</a></h1>
            <nav>
                <ul class="flex space-x-4">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li><a href="/pages/dashboard.php" class="text-blue-500">Dashboard</a></li>
                        <li><a href="/pages/my_posts.php" class="text-blue-500">My Posts</a></li>
                        <li><a href="/pages/create_post.php" class="text-blue-500">Create Post</a></li>
                        <li><a href="/pages/products.php" class="text-blue-500">Products</a></li>
                        <li><a href="/pages/cart.php" class="text-blue-500">Cart</a></li>
                        <li><a href="/pages/logout.php" class="text-blue-500">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/pages/login.php" class="text-blue-500">Login</a></li>
                        <li><a href="/pages/register.php" class="text-blue-500">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
