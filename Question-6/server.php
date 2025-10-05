<?php
header("Content-Type: application/json");

// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "shoppingcart";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

// Fetch students
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$students = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode($students);

$conn->close();
?>
