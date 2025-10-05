<?php
session_start();
$conn = new mysqli("localhost","root","root","shoppingcart");

if ($conn->connect_error) {
    die("DB Error: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    if ($_POST['captcha'] != $_SESSION['captcha']) {
        $error = "❌ Captcha invalid!";
    } else {
        $username = $conn->real_escape_string($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $conn->query("INSERT INTO users(username,password,role) VALUES('$username','$password','user')");
        $_SESSION['success'] = "✅ Registration successful! Please login.";
        header("Location: user_login.php");
        exit();
    }
}

$_SESSION['captcha'] = rand(1000,9999);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow col-md-5 mx-auto p-4">
        <h3 class="mb-3">📝 User Registration</h3>

        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <p>Captcha: <b><?= $_SESSION['captcha'] ?></b></p>
            <input type="text" name="captcha" class="form-control mb-2" required placeholder="Enter captcha">
            <button name="register" class="btn btn-success w-100">Register</button>
        </form>
        <p class="mt-3">Already have account? <a href="user_login.php">Login here</a></p>
    </div>
</div>
</body>
</html>
