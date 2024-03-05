<?php
session_start();

header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

// echo 'Testing';
// Your existing PHP code...
if (isset($_SESSION['user_id'])) {
    echo 'Session ID: ' . session_id() . '<br>';
    echo json_encode(['isLoggedIn' => true]);
} else {
    echo 'Session ID: ' . session_id() . '<br>';
    echo json_encode(['isLoggedIn' => false]);
}
?>

