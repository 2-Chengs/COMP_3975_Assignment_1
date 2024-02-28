<?php include("../../inc_header.php"); ?>

<?php
if (isset($_GET['id'])) {
    include("../../inc_db.php");


    $id = $_GET['id'];

    /* create a prepared statement */
    if ($stmt = $db->prepare("SELECT * FROM transactions WHERE id=:id")) {

        /* bind parameters for markers */
        $stmt->bindValue(':id', $id, SQLITE3_TEXT);

        /* execute query */
        $result = $stmt->execute();

        /* bind variables to prepared statement */
        $result = $stmt->execute();

        /* fetch value */
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if ($row) {
            $Date = new DateTime($row['date']);
            $formattedDate = $Date->format('Y-m-d');
            $Name = $row['name'];
            $Deduction = $row['deduction'];
            $Increase = $row['increase'];
        }    
    }
}
?>

<h1>Update</h1>

<div class="row">
    <div class="col-md-4">
        <form action="update_process.php" method="post">
            <div class="form-group">
                <label for="Id" class="control-label">Id</label>
                <input for="Id" class="form-control" name="Id" id="Id" value="<?php echo $id ?>" readonly/>
            </div>

            <div class="form-group">
                <label for="Date" class="control-label">Date</label>
                <input for="Date" class="form-control" name="Date" id="Date" type="date" value="<?php echo $formattedDate ?>"/>
            </div>

            <div class="form-group">
                <label for="Name" class="control-label">Name</label>
                <input for="Name" class="form-control" name="Name" id="Name" value="<?php echo $Name ?>"/>
            </div>

            <div class="Deduction">
                <label for="Deduction" class="control-label">Deduction</label>
                <input for="Deduction" class="form-control" step="any" name="Deduction" id="Deduction" type="number" value="<?php echo $Deduction?>"/>
            </div>

            <div class="Increase">
                <label for="Increase" class="control-label">Increase</label>
                <input for="Increase" class="form-control" step="any" name="Increase" id="Increase" type="number" value="<?php echo $Increase ?>"/>
            </div>

            <div class="form-group">
                <a href="../../transactions.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Update" name="update" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<br />