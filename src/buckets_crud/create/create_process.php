<?php
if (isset($_POST['create'])) {

    include("../../inc_db.php");
    include("../../utils.php");


    extract($_POST);
    
    $Name = sanitize_input($Name);
    $Category = sanitize_input($Category);

    $sql = "INSERT INTO buckets (entry_name, category) VALUES (?, ?)";

    try {
        // Prepare statement
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(1, $Name);
        $stmt->bindParam(2, $Category);

        // Execute the statement
        $exec = $stmt->execute();

    } catch (PDOException $e) {
        // Catch and log any errors in the PDO operation
        error_log('PDO Exception: '.$e->getMessage());
    }

    header('Location: ../../buckets.php');
    exit;
}
?>