<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header('Location: login.php'); // Redirect non-admins to the login page
    exit;
}

include("inc_db.php"); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'], $_POST['current_admin_status'])) {
    $userId = (int)$_POST['user_id'];
    $currentAdminStatus = (int)$_POST['current_admin_status'];
    $newAdminStatus = $currentAdminStatus === 1 ? 0 : 1; // Toggle the status

    // Fetch the username for the user_id to check if it's the super user
    $stmt = $db->prepare("SELECT username FROM users WHERE id = :userId");
    $stmt->bindValue(':userId', $userId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    // Prevent changes if it's the super user
    if ($user && $user['username'] === 'aa@aa.aa') {
        $_SESSION['error'] = "Cannot modify the super user's admin status.";
        header('Location: admin.php');
        exit;
    }

    // Prepare the update statement for changing admin status and automatically approving the user
    $stmt = $db->prepare("UPDATE users SET is_admin = :newAdminStatus, is_approved = 1 WHERE id = :userId");
    $stmt->bindValue(':newAdminStatus', $newAdminStatus, SQLITE3_INTEGER);
    $stmt->bindValue(':userId', $userId, SQLITE3_INTEGER);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['success'] = "User's admin status and approval updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update user's admin status and approval.";
    }
}

header('Location: admin.php'); // Redirect back to the admin page
exit;
?>

