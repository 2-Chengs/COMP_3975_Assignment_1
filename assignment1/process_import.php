<?php 
include("inc_db.php");

if (isset($_POST["submit"])) {
    $target_dir = "uploads/"; // Ensure this directory exists and is writable
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    // Attempt to upload file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        // Process the uploaded file
        if (($handle = fopen($target_file, "r")) !== FALSE) {
            // Skip the header row if your CSV file has one
            // fgetcsv($handle, 1000, ","); // Uncomment this line if your CSV has a header row
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $date = SQLite3::escapeString($data[0]);
                $name = SQLite3::escapeString($data[1]);
                $deduction = SQLite3::escapeString($data[2]);
                $increase = SQLite3::escapeString($data[3]);

                $deduction = floatval($deduction);
                $increase = floatval($increase);

                $SQLinsert = "INSERT INTO Transactions (date, name, deduction, increase)";
                $SQLinsert .= " VALUES ('$date', '$name', '$deduction', '$increase')";

                $db->exec($SQLinsert);
            }
            fclose($handle);
        
            // Rename file after successful import
            $newName = $target_file . ".imported";
            if(rename($target_file, $newName)) {
                echo "File has been renamed to " . $newName;
            } else {
                echo "Error renaming file to " . $newName;
            }

        }
        header('Location: home.php');
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
