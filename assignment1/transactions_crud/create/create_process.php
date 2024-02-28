<?php
if (isset($_POST['create'])) {

    include("../../inc_db.php");
    include("../../utils.php");


    extract($_POST);

    $dateObject = new DateTime($Date);
    $formattedDate = $dateObject->format('m/d/Y');
    
    $Name = sanitize_input($Name);
    $Deduction = sanitize_input($Deduction);
    $Increase = sanitize_input($Increase);

    $sql = "INSERT INTO transactions (date, name, deduction, increase) VALUES (?, ?, ?, ?)";

    try {
        // Prepare statement
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(1, $formattedDate);
        $stmt->bindParam(2, $Name);
        $stmt->bindParam(3, $Deduction);
        $stmt->bindParam(4, $Increase);

        // Execute the statement
        $exec = $stmt->execute();

    } catch (PDOException $e) {
        // Catch and log any errors in the PDO operation
        error_log('PDO Exception: '.$e->getMessage());
    }

    header('Location: ../../transactions.php');
    exit;
}
?>