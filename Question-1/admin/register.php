<?php
session_start();
$conn = new mysqli("localhost","root","root","shoppingcart"); // adjust password if needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration
if (isset($_POST['register'])) {
    if ($_POST['captcha'] != $_SESSION['captcha']) {
        echo "❌ Captcha invalid!";
    } else {
        $username = $conn->real_escape_string($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users(username,password,role) VALUES('$username','$password','admin')";
        if ($conn->query($sql)) {
            echo "✅ User registered successfully!";
            // Start session
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "admin";

            // Redirect to login page
            header("Location:admin_login.php");
        } else {
            echo "❌ Error: " . $conn->error;
        }
    }
}

// Generate captcha only if not posted
if (!isset($_SESSION['captcha']) || isset($_GET['refresh'])) {
    $_SESSION['captcha'] = rand(1000,9999);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height:100vh;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Admin Registration</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enter Captcha:</label>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3"><?= $_SESSION['captcha'] ?></span>
                                <a href="?refresh=1" class="btn btn-outline-secondary btn-sm">Refresh</a>
                            </div>
                            <input type="text" name="captcha" class="form-control mt-2" placeholder="Enter captcha here" required>
                        </div>
                        <button name="register" class="btn btn-dark w-100">Register</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="admin_login.php">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
