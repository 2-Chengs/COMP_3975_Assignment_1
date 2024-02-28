<?php include("../../inc_header.php"); ?>

<?php
if (isset($_GET['id'])) {
    include("../../inc_db.php");


    $id = $_GET['id'];

    /* create a prepared statement */
    if ($stmt = $db->prepare("SELECT * FROM buckets WHERE id=:id")) {

        /* bind parameters for markers */
        $stmt->bindValue(':id', $id, SQLITE3_TEXT);

        /* execute query */
        $result = $stmt->execute();

        /* bind variables to prepared statement */
        $result = $stmt->execute();

        /* fetch value */
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if ($row) {
            $Name = $row['entry_name'];
            $Category= $row['category'];
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
                <label for="Name" class="control-label">Name</label>
                <input for="Name" class="form-control" name="Name" id="Name" value="<?php echo $Name ?>"/>
            </div>

            <div class="form-group">
                <label for="Category" class="control-label">Category</label>
                <input for="Category" class="form-control" name="Category" id="Category" value="<?php echo $Category ?>"/>
            </div>

            <div class="form-group">
                <a href="../../buckets.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Update" name="update" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<br />