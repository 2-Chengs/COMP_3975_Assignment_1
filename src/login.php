<?php 
    session_start();
    if (isset($_SESSION['user_id'])) { // Adjust 'user_id' to your session variable
        header('Location: home.php'); // Redirect them to their dashboard
        exit;
    }
    if(isset($_SESSION['message'])) {
        echo "<p style='color:blue;'>" . htmlspecialchars($_SESSION['message']) . "</p>";
        unset($_SESSION['message']); // Clear the message after displaying it
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Login Page</h1>
    <?php 
        if(isset($_SESSION['error'])) {
            echo "<p style='color:red;'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']); // Clear the error message after displaying it
        }
        if(isset($_SESSION['message'])) {
            echo "<p style='color:blue;'>".$_SESSION['message']."</p>";
            unset($_SESSION['message']); // Clear the message after displaying it
        }
    ?>
    <?php if (isset($_GET['success']) && $_GET['success'] == 'registration'): ?>
        <p>Registration successful! Please log in.</p>
    <?php endif; ?>
    <?php 
        if(isset($_GET['error'])) {
            echo "<p style='color:red;'>".$_GET['error']."</p>";
        }
    ?>
    <form id="loginForm" action="process_login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login">
    </form>
    <!-- Add a Register link below your form -->
    <div style="margin-top: 20px;">
        <p>Don't have an account? <a href="registration_form.php">Register here</a>.</p>
    </div>

</body>

</html>


