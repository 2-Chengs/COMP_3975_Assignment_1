<?php include("../../inc_header.php"); ?>

<h1>Delete Transaction</h1>

<?php
    if (isset($_GET['id'])) {
    
        include("../../inc_db.php");

        $version = $db->querySingle('SELECT SQLITE_VERSION()');

        $id = $_GET['id'];
        $tableName = 'transactions';

        $checkDuplicateQuery = "SELECT COUNT(*) AS 'rowCount' FROM $tableName WHERE id = ?";
        $checkStmt = $db->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(1, $id, SQLITE3_TEXT);
        $result = $checkStmt->execute();
        $rowCount = $result->fetchArray(SQLITE3_NUM);
        $rowCount = $rowCount[0];


        if ($rowCount == 0) {
            // The specified ID doesn't exist in the database
            echo "<p class='alert alert-danger'>Trasaction with ID $id does not exist.</p>";
            echo "<a href='../../index.php' class='btn btn-small btn-primary'>&lt;&lt; BACK</a>";
            exit;
        }

        // Fetch transactions details
        $fetchQuery = "SELECT * FROM $tableName WHERE id = ?";
        $fetchStmt = $db->prepare($fetchQuery);
        $fetchStmt->bindParam(1, $id, SQLITE3_TEXT);
        $result = $fetchStmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);

        // Assign values to variables
        $date = $row['date'];
        $name = $row['name'];
        $deduction = $row['deduction'];
        $increase = $row['increase'];
    };

    $db->close();
?>

<table>
    <tr>
        <td>Date: </td>
        <td><?php echo $date ?></td>
    </tr>
    <tr>
        <td>Name: </td>
        <td><?php echo $name ?></td>
    </tr>
    <tr>
        <td>Deduction: </td>
        <td><?php echo $deduction ?></td>
    </tr>
    <tr>
        <td>Increase: </td>
        <td><?php echo $increase ?></td>
    </tr>
</table>
<br />
<form action="delete_process.php" method="post">
    <input type="hidden" value="<?php echo $id ?>" name="id" />
    <a href="../../transactions.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;
    <input type="submit" value="Delete" class="btn btn-danger" />
</form>

<br />
<?php 
include("../../inc_footer.php");
?>