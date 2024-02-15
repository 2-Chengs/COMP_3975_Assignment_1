<?php
session_start();

header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
if (isset($_SESSION['test_two'])) {
    echo $_SESSION['test_two'];
} else {
    echo 'Session is not working';
}
// Your existing PHP code...
if (isset($_SESSION['user_id'])) {
    echo 'Session ID: ' . session_id() . '<br>';
    echo json_encode(['isLoggedIn' => true]);
} else {
    echo 'Session ID: ' . session_id() . '<br>';
    echo json_encode(['isLoggedIn' => false]);
}

// if (isset($_SESSION['test'])) {
//     echo $_SESSION['test'];
// } else {
//     echo 'Session is not working';
// }

// Check if the user is logged in
// if (isset($_SESSION['username'])) {  
//     echo json_encode([
//         'isLoggedIn' => true,
//         'username' => $_SESSION['username']
//     ]);
// } else {
//     echo json_encode(['isLoggedIn' => false]);
// }
?>

