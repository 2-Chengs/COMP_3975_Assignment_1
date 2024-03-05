<?php
session_start();
include("inc_db.php");
if (isset($_SESSION['user_id'])) {
    // Session variable exists, user is already logged in
    header("Location: home.php"); // Redirect to the home page or dashboard
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirect back to the login page with an error if the method is not POST
    $_SESSION['error'] = 'Method Not Allowed';
    header("Location: login.php");
    exit;
}
 // Ensure correct path to your database connection script

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    $_SESSION['error'] = 'Username and password are required';
    header("Location: login.php");
    exit;
}

$stmt = $db->prepare('SELECT id, username, password, is_admin FROM users WHERE username = :username');
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute();

$record = $result->fetchArray(SQLITE3_ASSOC);

if ($record) {
    if ($password === $record['password']) { // Direct comparison without password_verify()
        // Login successful, set session variables
        $_SESSION['user_id'] = $record['id']; // Assuming 'id' is the unique user identifier in your database
        $_SESSION['username'] = $record['username']; // Store the username in session
        $_SESSION['is_admin'] = $record['is_admin'];

        header("Location: home.php"); // Redirect to home page after successful login
        exit;
    } else {
        // Password does not match
        $_SESSION['error'] = 'Invalid username or password';
        header("Location: login.php");
        exit;
    }
} else {
    // No user found with the given username
    $_SESSION['error'] = 'User not found';
    header("Location: login.php");
    exit;
}
?>


