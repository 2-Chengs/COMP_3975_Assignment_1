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
    <!-- Check if the query parameter 'success' is set in the URL -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 'registration'): ?>
        <p>Registration successful! Please log in.</p>
    <?php endif; ?>
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


