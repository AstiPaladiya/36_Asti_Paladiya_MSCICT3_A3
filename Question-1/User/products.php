<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "shoppingcart");

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: user_login.php");
    exit();
}

$cat = $_GET['cat'] ?? 1;
$page = $_GET['page'] ?? 1;
$limit = 5;
$offset = ($page-1)*$limit;

$products = $conn->query("SELECT * FROM products WHERE category_id=$cat LIMIT $limit OFFSET $offset");
$total = $conn->query("SELECT COUNT(*) as cnt FROM products WHERE category_id=$cat")->fetch_assoc()['cnt'];
$pages = ceil($total/$limit);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="mb-3">🛒 Products</h2>
    <div class="row">
        <?php while($p = $products->fetch_assoc()): ?>
            <div class="col-md-3 mb-3">
                <div class="card shadow">
                    <img src="../admin/uploads/<?= $p['image'] ?>" class="card-img-top" style="height:200px;object-fit:cover;">
                    <div class="card-body">
                        <h6><?= htmlspecialchars($p['name']) ?></h6>
                        <p>₹ <?= $p['price'] ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <nav>
        <ul class="pagination">
            <?php for($i=1;$i<=$pages;$i++): ?>
                <li class="page-item <?= ($i==$page)?'active':'' ?>">
                    <a class="page-link" href="products.php?cat=<?= $cat ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</body>
</html>
