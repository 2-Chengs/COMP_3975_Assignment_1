<?php include("../../inc_header.php"); ?>

<h1>Delete Bucket</h1>

<?php
    if (isset($_GET['id'])) {
    
        include("../../inc_db.php");

        $version = $db->querySingle('SELECT SQLITE_VERSION()');

        $id = $_GET['id'];
        $tableName = 'buckets';

        $checkDuplicateQuery = "SELECT COUNT(*) AS 'rowCount' FROM $tableName WHERE id = ?";
        $checkStmt = $db->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(1, $id, SQLITE3_TEXT);
        $result = $checkStmt->execute();
        $rowCount = $result->fetchArray(SQLITE3_NUM);
        $rowCount = $rowCount[0];


        if ($rowCount == 0) {
            // The specified ID doesn't exist in the database
            echo "<p class='alert alert-danger'>Bucket with ID $id does not exist.</p>";
            echo "<a href='../../index.php' class='btn btn-small btn-primary'>&lt;&lt; BACK</a>";
            exit;
        }

        // Fetch buckets details
        $fetchQuery = "SELECT * FROM $tableName WHERE id = ?";
        $fetchStmt = $db->prepare($fetchQuery);
        $fetchStmt->bindParam(1, $id, SQLITE3_TEXT);
        $result = $fetchStmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);

        // Assign values to variables
        $name = $row['entry_name'];
        $categpry = $row['category'];
    };

    $db->close();
?>

<table>
    <tr>
        <td>Name: </td>
        <td><?php echo $name ?></td>
    </tr>
    <tr>
        <td>Category: </td>
        <td><?php echo $categpry ?></td>
    </tr>
</table>
<br />
<form action="delete_process.php" method="post">
    <input type="hidden" value="<?php echo $id ?>" name="id" />
    <a href="../../buckets.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;
    <input type="submit" value="Delete" class="btn btn-danger" />
</form>

<br />
