<?php
$conn = new mysqli("localhost", "root", "root", "shoppingcart");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM students");

$xml = new SimpleXMLElement("<students></students>");

while ($row = $result->fetch_assoc()) {
    $student = $xml->addChild("student");
    $student->addChild("id", $row['id']);
    $student->addChild("name", $row['name']);
    $student->addChild("age", $row['age']);
}

$xml->asXML("students_from_db.xml");
echo "XML file created successfully!";
$conn->close();
?>
