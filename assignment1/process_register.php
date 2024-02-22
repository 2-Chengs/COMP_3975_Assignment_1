<?php
include("inc_db.php");
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");



// Immediately return 200 for OPTIONS method, used in CORS preflight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200); // OK
    exit;
}


// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// Retrieve data from POST request
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
// Log the raw input to see what is being received
$rawData = file_get_contents('php://input');
error_log($rawData); // Check your error log to see if the data is correct


// Basic validation
if (empty($username) || empty($password)) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Username and password are required']);
    exit;
}

try {
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $passwordHash, SQLITE3_TEXT);

    if($stmt->execute()) {
        http_response_code(201);
        echo json_encode(['message' => 'User registered successfully']);
    } else {
        throw new Exception("An error occurred during the registration process.");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
}