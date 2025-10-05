<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "shoppingcart");
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
// Add Category
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $conn->query("INSERT INTO categories(name) VALUES('$name')");
}

// Update Category
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $conn->query("UPDATE categories SET name='$name' WHERE id=$id");
}

// Delete Category
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM categories WHERE id=$id");
}

$result = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="mb-3">📂 Categories</h2>
    
    <!-- Add Category Form -->
    <form method="post" class="d-flex mb-3">
        <input type="text" name="name" class="form-control me-2" placeholder="New Category" required>
        <button name="add" class="btn btn-success">Add</button>
    </form>

    <!-- Categories Table -->
    <table class="table table-bordered table-striped shadow">
        <thead class="table-dark">
            <tr><th>ID</th><th>Name</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()):
            $cnt=1 ?>
            <tr>
                <td><?= $cnt  ?></td>
                <td><?= $row['name'] ?></td>
                <td>
                    <!-- Edit Button (Modal Trigger) -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</button>
                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this category?')">Delete</a>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="post">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" name="id" value="<?= $row['id'] ?>">
                          <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>" required>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="update" class="btn btn-primary">Save</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>

        <?php
        $cnt++;
    endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
