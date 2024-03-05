<?php include("../inc_header.php"); 
    $error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>

<h1>Enter  Year</h1>

<div class="row">
    <div class="col-md-4">
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        <form action="reports_process.php" method="post">
            <div class="form-group">
                <label for="Year" class="control-label">Report Year</label>
                <input type="number"  for="Year" class="form-control" name="Year" id="Year" required/>
            </div>

            <div class="form-group">
                <a href="../home.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Submit" name="Enter" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<?php include("../inc_footer.php"); ?>