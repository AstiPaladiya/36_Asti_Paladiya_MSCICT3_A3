<?php
session_start();
$conn = new mysqli("localhost","root","root","shoppingcart");

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: user_login.php");
    exit();
}

$categories = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shop Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">🛍️ Shopping</a>
    <span class="text-white">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
    <a href="user_logout.php" class="btn btn-danger btn-sm ms-3">Logout</a>
</nav>
<div class="container mt-4">
    <h2 class="mb-3">📂 Categories</h2>
    <ul class="list-group">
        <?php while ($row = $categories->fetch_assoc()): ?>
            <li class="list-group-item">
                <a href="products.php?cat=<?= $row['id'] ?>" class="text-decoration-none">
                    <?= htmlspecialchars($row['name']) ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
</body>
</html>
