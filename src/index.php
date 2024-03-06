<?php 
session_start();
include("inc_header.php");
include("inc_db.php");
include("process_import.php");

 // Ensure session is started
if (isset($_SESSION['user_id'])) { // Adjust 'user_id' to your session variable
    header('Location: home.php'); // Redirect them to their dashboard
    exit;
}
?>
<h1>
    Welcome to my app
</h1>
<div>
    <a href="/login.php">Login</a>
    <a href="/registration_form.php">Register</a>
</div>


<?php 
include("inc_footer.php");
?>