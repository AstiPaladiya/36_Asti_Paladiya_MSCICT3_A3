<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "shoppingcart";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Load XML
$xml = simplexml_load_file('student.xml') or die("Error: Cannot load XML file");

// Insert into MySQL
$stmt = $conn->prepare("INSERT INTO students (id, name, age) VALUES (?, ?, ?)");

foreach ($xml->student as $student) {
    $id = (int)$student->id;
    $name = (string)$student->name;
    $age = (int)$student->age;
    $stmt->bind_param("isi", $id, $name, $age);
    $stmt->execute();
}

echo "Data inserted successfully!";
$stmt->close();
$conn->close();
?>
