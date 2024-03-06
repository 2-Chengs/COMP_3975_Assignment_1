<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header('Location: login.php'); // Redirect non-admins to the login page
    exit;
}

include("inc_db.php"); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'], $_POST['current_status'])) {
    $userId = (int)$_POST['user_id'];
    $currentStatus = (int)$_POST['current_status'];
    $newStatus = $currentStatus === 1 ? 0 : 1; // Toggle the status

    // Prepare the update statement
    $stmt = $db->prepare("UPDATE users SET is_approved = :newStatus WHERE id = :userId");
    $stmt->bindValue(':newStatus', $newStatus, SQLITE3_INTEGER);
    $stmt->bindValue(':userId', $userId, SQLITE3_INTEGER);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['success'] = "User's approval status updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update user's approval status.";
    }
}

header('Location: admin.php'); // Redirect back to the admin page
exit;
?>
