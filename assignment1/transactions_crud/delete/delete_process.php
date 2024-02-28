<?php
if (isset($_POST['id'])) {
    include("../../inc_db.php");

    $id = $_POST['id'];

    try {
        
        /* create a prepared statement */
        $stmt = $db->prepare("DELETE FROM transactions WHERE id = :id");
    
        /* bind parameters for markers */
        $stmt->bindParam(':id', $id, SQLITE3_TEXT);
    
        /* execute query */
        $exec = $stmt->execute();

    
    } catch (PDOException $e) {
        error_log('Connection failed: ' . $e->getMessage());
    }

    header('Location: ../../transactions.php');
    exit;
    
}
?>
