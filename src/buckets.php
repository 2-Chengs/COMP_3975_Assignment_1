<?php 
session_start();
include("inc_header.php");
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Assuming you store the username in session when logging in
} else {
    header("Location: login.php");
    exit;
    $username = null; // No user logged in
}
?>
    <h1>
        Buckets
    </h1>
    <a class='btn btn-small btn-success' href='/buckets_crud/create/create.php'>Create Buckets</a>
    <a class='btn btn-small btn-primary' href='home.php'>Home</a>
    <a class='btn btn-small btn-primary' href='transactions.php'>Transactions List</a>
    <a class='btn btn-small btn-primary' href='reports/reports.php'>Reports</a>

    <?php 
    include("inc_db.php");
    include("process_import.php");
    $tableExists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='buckets'");
    if ($tableExists) {
        $res = $db->query('SELECT * FROM buckets');
    
        if ($res) {
            echo "<table width='100%' class='table table-striped'>\n";
            echo "<tr><th>Date</th>". 
                "<th>Name</th>".
                "<th>Category</th>";
            while ($row = $res->fetchArray()) {
                echo "<tr><td>{$row['entry_name']}</td>";
                echo "<td>{$row['category']}</td>";
                echo "<td>";
                echo "<a class='btn btn-small btn-warning' href='/buckets_crud/update/update.php?id={$row['id']}'>upd</a>";
                echo "&nbsp;";
                echo "<a class='btn btn-small btn-danger' href='/buckets_crud/delete/delete.php?id={$row['id']}'>del</a>";
                echo "</td></tr>\n";
            };
            echo "</table>\n";
        }
    } else {

    }
    ?>
<?php 
include("inc_footer.php");
?>