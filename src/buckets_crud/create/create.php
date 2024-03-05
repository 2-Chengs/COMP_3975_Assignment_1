<?php include("../../inc_header.php"); ?>

<h1>Create New</h1>

<div class="row">
    <div class="col-md-4">
        <form action="create_process.php" method="post">

            <div class="form-group">
                <label for="Name" class="control-label">Name</label>
                <input for="Name" class="form-control" name="Name" id="Name" />
            </div>

            <div class="form-group">
                <label for="Category" class="control-label">Category</label>
                <input for="Category" class="form-control" name="Category" id="Category" />
            </div>


            <div class="form-group">
                <a href="../../buckets.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Create" name="create" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<br />