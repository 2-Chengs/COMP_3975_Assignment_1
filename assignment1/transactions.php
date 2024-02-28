<?php 
include("inc_header.php");
?>
    <h1>
        Transactions
    </h1>
    <a class='btn btn-small btn-primary' href='/transactions_crud/create/create.php'>Create Transaction</a>
    <a class='btn btn-small btn-primary' href='home.php'>Home</a>
    <a class='btn btn-small btn-primary' href='buckets.php'>Buckets List</a>
    <a class='btn btn-small btn-primary' href='reports.php'>Reports</a>

    <?php 
    include("inc_db.php");
    include("process_import.php");
    $tableExists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='transactions'");
    $balance = 5879.57;
    if ($tableExists) {
        $res = $db->query('SELECT * FROM transactions ORDER BY date ASC');
    
        if ($res) {
            echo "<table width='100%' class='table table-striped'>\n";
            echo "<tr><th>Date</th>". 
                "<th>Name</th>".
                "<th>Deduction</th>".
                "<th>Increase</th>".
                "<th>Balance</th>\n";
                "<th>&nbsp;</th></tr>\n";
            while ($row = $res->fetchArray()) {
                $balance = $balance  + $row['increase'] - $row['deduction'];
                echo "<tr><td>{$row['date']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['deduction']}</td>";
                echo "<td>{$row['increase']}</td>";
                echo "<td>{$balance}</td>";
                echo "<td>";
                echo "<a class='btn btn-small btn-warning' href='/transactions_crud/update/update.php?id={$row['id']}'>upd</a>";
                echo "&nbsp;";
                echo "<a class='btn btn-small btn-danger' href='/transactions_crud/delete/delete.php?id={$row['id']}'>del</a>";
                echo "</td></tr>\n";
            };
            echo "</table>\n";
        }
    } else {

    }
    ?>
</body>