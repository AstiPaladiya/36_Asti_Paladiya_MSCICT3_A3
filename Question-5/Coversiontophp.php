<?php
$url = "http://localhost:3000/api/students"; // Express API endpoint

$options = [
    "http" => [
        "header" => "Content-type: application/json",
        "method" => "GET"
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === FALSE) {
    die("Error calling API");
}

$data = json_decode($response, true);
print_r($data);
?>
