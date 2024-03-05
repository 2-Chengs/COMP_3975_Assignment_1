<?php 
include("../inc_header.php");
?>
    <h1>
        Reports
    </h1>
    <a class='btn btn-small btn-primary' href='../home.php'>Home</a>
    <a class='btn btn-small btn-primary' href='../transactions.php'>Transactions</a>
    <a class='btn btn-small btn-primary' href='../buckets.php'>Buckets</a>

    <?php 
    if (isset($_POST['Enter'])) {
        include("../inc_db.php");
        include("../utils.php");

        extract($_POST);

        $dataPoints = [];
        $transactionsExists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='transactions'");
        $bucketsExists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='buckets'");
        if ($bucketsExists && $transactionsExists) {
            // Assuming 'amount' is a column in 'transactions' table representing the money spent
            // and 'category' is a column in 'buckets' table that needs to be matched.
            $query = "SELECT b.category, SUM(t.deduction) AS total_spent
            FROM transactions t
            JOIN buckets b ON t.name LIKE b.entry_name || '%'
            WHERE strftime('%Y', substr(t.date, 7, 4) || '-' || substr(t.date, 1, 2) || '-' || substr(t.date, 4, 2)) = '$Year'
            GROUP BY b.category
            ";
            $res = $db->query($query);

            while ($row = $res->fetchArray()) {
                $arrayItem = array("label" => $row['category'], "y" => $row['total_spent']);
                array_push($dataPoints, $arrayItem);
            }

        ?>
            
        <script>
            window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {
                     animationEnabled: true,
                     title: {
                          text: "Report"
                     },
                     data: [{
                          type: "pie",
                          yValueFormatString: "#,##0.00\"\"",
                          indexLabel: "{label} ({y})",
                          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                     }]
                });
                chart.render();
      
           }

        </script>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <?php
            
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
    }

    include("../inc_footer.php");
    ?>


