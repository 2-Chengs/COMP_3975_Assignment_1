<?php include("../../inc_header.php"); ?>

<h1>Create New</h1>

<div class="row">
    <div class="col-md-4">
        <form action="create_process.php" method="post">
            <div class="form-group">
                <label for="Date" class="control-label">Date</label>
                <input for="Date" class="form-control" name="Date" id="Date" type="date"/>
            </div>

            <div class="form-group">
                <label for="Name" class="control-label">Name</label>
                <input for="Name" class="form-control" name="Name" id="Name" />
            </div>

            <div class="Deduction">
                <label for="Deduction" class="control-label">Deduction</label>
                <input for="Deduction" value="0" step="any" class="form-control" name="Deduction" id="Deduction" type="number"/>
            </div>

            <div class="Increase">
                <label for="Increase" class="control-label">Increase</label>
                <input for="Increase" value="0" step="any" class="form-control" name="Increase" id="Increase" type="number"/>
            </div>

            <div class="form-group">
                <a href="../../transactions.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Create" name="create" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<br />