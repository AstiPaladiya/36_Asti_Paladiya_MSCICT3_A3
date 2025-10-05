<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 18px rgba(0,0,0,0.15);
        }
        footer {
            margin-top: 40px;
            background: #343a40;
            color: #fff;
            padding: 15px 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark shadow-sm px-3">
    <a class="navbar-brand fw-bold" href="#">🛒 Admin Panel</a>
    <div>
        <span class="text-white me-3">Welcome, Admin</span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<!-- Dashboard Content -->
<div class="container mt-5">
    <h2 class="mb-4 text-center">Dashboard</h2>
    <div class="row g-4">
        <!-- Manage Categories -->
        <div class="col-md-6">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-tags-fill display-4 text-primary mb-3"></i>
                    <h5 class="card-title">Manage Categories</h5>
                    <p class="card-text text-muted">Add, update or remove product categories.</p>
                    <a href="category.php" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>

        <!-- Manage Products -->
        <div class="col-md-6">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-box-seam display-4 text-success mb-3"></i>
                    <h5 class="card-title">Manage Products</h5>
                    <p class="card-text text-muted">View and maintain all products.</p>
                    <a href="product.php" class="btn btn-success">Go</a>
                </div>
            </div>
        </div>

        <!-- Future Section: Orders -->
        <!-- <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-cart-check-fill display-4 text-warning mb-3"></i>
                    <h5 class="card-title">Manage Orders</h5>
                    <p class="card-text text-muted">Track and update customer orders.</p>
                    <a href="orders.php" class="btn btn-warning text-white">Go</a>
                </div>
            </div>
        </div> -->
    </div>
</div>

<!-- Footer -->
<footer class="text-center">
    <p class="mb-0">© <?= date("Y") ?> ShoppingCart Admin Panel. All Rights Reserved.</p>
</footer>

</body>
</html>