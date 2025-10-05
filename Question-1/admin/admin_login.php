<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "shoppingcart");

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND role='admin'");
    $row = $result->fetch_assoc();

    if($row && password_verify($password, $row['password'])){
        $_SESSION['admin'] = $row['id'];
        header("Location: admin_dashboard.php");
    } else {
        echo "Invalid login!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height:100vh;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Admin Login</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Admin Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button name="login" class="btn btn-dark w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

