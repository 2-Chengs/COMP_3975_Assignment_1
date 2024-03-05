<?php 
session_start();
var_dump($_SESSION);
include("inc_header.php");
include("inc_db.php"); // Make sure this path correctly points to your database connection script
 // Start the session to access session variables

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Assuming you store the username in session when logging in
} else {
    // Optionally, redirect to login page if not logged in
    // header("Location: login.php");
    // exit;
    $username = null; // No user logged in
}
?>
<body>
    <?php include("process_import.php"); ?>
    
    <h1>Welcome to my home</h1>
    <?php if ($username): ?>
        <h2 id="greeting">Hello, <?php echo htmlspecialchars($username); ?>!</h2>
        <a href="process_logout.php" class='btn btn-small btn-primary'>Logout</a>
    <?php else: ?>
        <p id="greeting">Please <a href="login.php">log in</a>.</p>
    <?php endif; ?>
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
    <a class='btn btn-small btn-primary' href='admin.php'>Admin Panel</a>
<?php endif; ?>

    <a class='btn btn-small btn-primary' href='transactions.php'>Transaction List</a>
    <a class='btn btn-small btn-primary' href='buckets.php'>Buckets List</a>
    <a class='btn btn-small btn-primary' href='reports/reports.php'>Reports</a>

    <form action="process_import.php" method="post" enctype="multipart/form-data">
        Select CSV File to Upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Submit" name="submit">
    </form>



<?php 
include("inc_footer.php");
?>

