<?php 
include("inc_header.php");
?>
    <h1>
        Reports
    </h1>
    <a class='btn btn-small btn-primary' href='home.php'>Home</a>
    <a class='btn btn-small btn-primary' href='transactions.php'>Transactions</a>
    <a class='btn btn-small btn-primary' href='buckets.php'>Buckets</a>

    <?php 
    include("inc_db.php");
    $transactionsExists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='transactions'");
    $bucketsExists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='buckets'");
    if ($bucketsExists && $transactionsExists) {
        // Assuming 'amount' is a column in 'transactions' table representing the money spent
        // and 'category' is a column in 'buckets' table that needs to be matched.
        $query = "
            SELECT b.category, SUM(t.deduction) AS total_spent
            FROM transactions t
            JOIN buckets b ON t.name LIKE b.entry_name || '%'
            GROUP BY b.category        
        ";
        $res = $db->query($query);
        if ($res) {
            echo "<table width='100%' class='table table-striped'>\n";
            echo "<tr><th>Category</th><th>Spent</th></tr>\n";
            while ($row = $res->fetchArray()) {
                echo "<tr><td>{$row['category']}</td><td>{$row['total_spent']}</td></tr>\n";
            }
            echo "</table>\n";
        } else {
            echo "<p>No data found</p>";
        }
    } else {
        echo "<p>Required tables do not exist.</p>";
    }
    ?>
</body>
