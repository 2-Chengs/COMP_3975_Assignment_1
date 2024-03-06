<?php
session_start();

header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
header("Content-Type: application/json");

if (is_writable(session_save_path())) {
    $_SESSION['test'] = 'session is wdsdforking';
    echo 'Session ID: ' . session_id() . '<br>';
    echo 'Session path "'.session_save_path().'" is writable for PHP!';
}

if (isset($_SESSION['user_id'])) {
    echo json_encode(['loggedIn' => true]);
} else {
    echo json_encode(['loggedIn' => false]);
}
?>


