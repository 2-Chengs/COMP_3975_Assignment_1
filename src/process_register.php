<?php
session_start(); // Start the session at the beginning of the script
include("inc_db.php"); // Make sure this path correctly points to your database connection script

// Define admin credentials
$adminUsername = 'aa@aa.aa';
$adminPassword = 'P@$$w0rd';

// Only process the script for POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Basic validation
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Username and password are required'; // Use session to store error message
        header("Location: registration_form.php");
        exit;
    }

    // Check for unauthorized admin registration
    if ($username === $adminUsername && $password !== $adminPassword) {
        $_SESSION['error'] = 'Unauthorized user'; // Use session to store error message
        header("Location: registration_form.php");
        exit;
    }

    // Check if the username already exists
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $existingUser = $result->fetchArray();

    if ($existingUser) {
        $_SESSION['error'] = 'User already exists'; // Use session to store error message
        header("Location: registration_form.php");
        exit;
    } else {
        // Determine if the user is admin based on credentials
        $is_admin = ($username === $adminUsername && $password === $adminPassword) ? 1 : 0;

        // Insert the new user without hashing the password
        try {
            $stmt = $db->prepare("INSERT INTO users (username, password, is_admin) VALUES (:username, :password, :is_admin)");
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $stmt->bindValue(':password', $password, SQLITE3_TEXT); // Storing the password in plaintext
            $stmt->bindValue(':is_admin', $is_admin, SQLITE3_INTEGER);

            if ($stmt->execute()) {
                // Set a message indicating that the account awaits admin approval
                $_SESSION['message'] = 'Your account has been created but is not yet approved. Please wait for the administrator to grant you access.';
                header("Location: login.php"); // Redirect to login page
                exit;
            } else {
                $_SESSION['error'] = 'An error occurred during the registration process'; // Store error message in session
                header("Location: registration_form.php");
                exit;
            }
            
        } catch (Exception $e) {
            $_SESSION['error'] = 'An error occurred: ' . $e->getMessage(); // Store error message in session
            header("Location: registration_form.php");
            exit;
        }
    }
} else {
    $_SESSION['error'] = 'Invalid request'; // Use session to store error message if not a POST request
    header("Location: registration_form.php");
    exit;
}
?>


