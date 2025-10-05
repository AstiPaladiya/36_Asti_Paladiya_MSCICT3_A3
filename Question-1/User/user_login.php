<?php
session_start();
$conn = new mysqli("localhost","root","root","shoppingcart");

if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND role='user'");
    $row = $result->fetch_assoc();

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = "user";
        header("Location: index.php");
        exit();
    } else {
        $error = "❌ Invalid login!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow col-md-5 mx-auto p-4">
        <h3 class="mb-3">🔑 User Login</h3>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if(!empty($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <button name="login" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3">Don’t have an account? <a href="user_register.php">Register here</a></p>
    </div>
</div>
</body>
</html>
