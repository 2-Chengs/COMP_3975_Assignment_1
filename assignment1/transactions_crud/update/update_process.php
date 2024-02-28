<?php
if (isset($_POST['update'])) {

    include("../../inc_db.php");
    include("../../utils.php");
    if ($db !== false) {
        extract($_POST);

 
        $dateObject = new DateTime($Date);
        $formattedDate = $dateObject->format('m/d/Y');
        
        $Name = sanitize_input($Name);
        $Deduction = sanitize_input($Deduction);
        $Increase = sanitize_input($Increase);

        $sql = "UPDATE transactions SET date = ?, name = ?, deduction = ?, increase = ? WHERE id = ?";

        // Create a prepared statement
        $stmt = $db->prepare($sql);

        if ($stmt) {
            // Bind parameters for markers
            // SQLite3 uses bindValue method, and you need to manually specify the parameter number starting with 1
            $stmt->bindValue(1, $formattedDate);
            $stmt->bindValue(2, $Name);
            $stmt->bindValue(3, $Deduction);
            $stmt->bindValue(4, $Increase);
            $stmt->bindValue(5, $Id);

            // Execute query
            $exec = $stmt->execute(); // This returns an SQLite3Result object for SELECT, for other types of queries it returns TRUE/FALSE

            if ($exec === false) {
                error_log('SQLite execute() failed: ');
                error_log(print_r($db->lastErrorMsg(), true));
            } else {
                // Since execute() for UPDATE, DELETE, INSERT returns TRUE on success, finalize if needed
                // No result set to fetch for UPDATE, so we can directly check for redirection
                header('Location: ../../transactions.php');
                exit;
            }
        } else {
            error_log('SQLite prepare() failed: ');
            error_log(print_r($db->lastErrorMsg(), true));
        }
    }
}