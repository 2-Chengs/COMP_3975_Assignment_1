<?php 
    session_start(); // Ensure session is started
    if (isset($_SESSION['user_id'])) { // Adjust 'user_id' to your session variable
        header('Location: home.php'); // Redirect them to their dashboard
        exit;
    }
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']); // Clear the message after displaying it
    }
    if (isset($_SESSION['success'])) {
        echo '<p style="color:green;">' . $_SESSION['success'] . '</p>';
        unset($_SESSION['success']); // Clear the message after displaying it
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body>
    <h1>Register Page</h1>
    <div class="form-container">
        <form id="registrationForm" action="process_register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
    
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8">
    
            <input type="submit" value="Register">
        </form>
        <!-- Add a login button or link below your form -->
        <div style="margin-top: 20px;">
            <p>Already have an account? <a href="login.php">Log in here</a>.</p>
        </div>
    </div>



</body>
</html>
