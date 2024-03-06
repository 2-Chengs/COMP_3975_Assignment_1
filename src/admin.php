<?php
session_start();

// Check if the user is logged in and is an admin.
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header('Location: 403.php'); // Redirect to the custom 403 Forbidden page.
    exit; // Stop script execution.
}

include("inc_db.php"); // Include your database connection.

// Retrieve all users from the database
$result = $db->query("SELECT id, username, is_admin, is_approved FROM users ORDER BY id");
$users = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $users[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<button onclick="location.href='home.php'">Return to Home</button>
    <h2>User List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Is Admin</th>
            <th>Is Approved</th>
            <th>Toggle Admin Status</th>
            <th>Approval Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
<tr>
    <td><?php echo htmlspecialchars($user['id']); ?></td>
    <td><?php echo htmlspecialchars($user['username']); ?></td>
    <td><?php echo $user['is_admin'] == 1 ? 'Yes' : 'No'; ?></td>
    <td><?php echo $user['is_approved'] == 1 ? 'Yes' : 'No'; ?></td>
    <td>
        <?php if ($user['username'] !== 'aa@aa.aa'): ?> <!-- Check if not super user -->
            <form action="toggle_admin.php" method="post" style="display:inline;">
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <input type="hidden" name="current_admin_status" value="<?php echo $user['is_admin']; ?>">
                <input type="submit" value="<?php echo $user['is_admin'] == 1 ? 'Revoke Admin' : 'Make Admin'; ?>">
            </form>
        <?php endif; ?>
    </td>
    <td>
        <?php if ($user['username'] !== 'aa@aa.aa'): ?> <!-- Check if not super user -->
            <form action="toggle_approval.php" method="post" style="display:inline;">
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <input type="hidden" name="current_status" value="<?php echo $user['is_approved']; ?>">
                <input type="submit" value="<?php echo $user['is_approved'] == 1 ? 'Revoke Approval' : 'Approve'; ?>">
            </form>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

    </table>
</body>
</html>


