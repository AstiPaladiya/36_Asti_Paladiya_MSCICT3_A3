<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "shoppingcart");
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    $img = $_FILES['image']['name'];
    $target = "uploads/".basename($img);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $conn->query("INSERT INTO products(category_id, name, price, image) 
                  VALUES('$category','$name','$price','$img')");
}

$categories = $conn->query("SELECT * FROM categories");
$products = $conn->query("SELECT p.*, c.name as category FROM products p JOIN categories c ON p.category_id=c.id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="mb-3">📦 Add Product</h2>
    <form method="post" enctype="multipart/form-data" class="card p-3 shadow mb-4">
        <div class="mb-3">
            <select name="category" class="form-control">
                <?php while($c = $categories->fetch_assoc()): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Product Name">
        </div>
        <div class="mb-3">
            <input type="number" name="price" step="0.01" class="form-control" placeholder="Price">
        </div>
        <div class="mb-3">
            <input type="file" name="image" class="form-control">
        </div>
        <button name="add" class="btn btn-success">Add Product</button>
    </form>

    <h2>📋 Product List</h2>
    <table class="table table-bordered table-striped shadow">
        <thead class="table-dark">
            <tr><th>Image</th><th>Name</th><th>Price</th><th>Category</th></tr>
        </thead>
        <tbody>
        <?php while($p = $products->fetch_assoc()): ?>
        <tr>
            <td><img src="uploads/<?= $p['image'] ?>" width="50" class="img-thumbnail"></td>
            <td><?= $p['name'] ?></td>
            <td>₹<?= $p['price'] ?></td>
            <td><?= $p['category'] ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>