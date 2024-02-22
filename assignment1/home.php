<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('http://localhost:8888/get_user_info.php', { credentials: 'include' }) // Include credentials for session cookies
                .then(response => response.json())
                .then(data => {
                    if (data.isLoggedIn) {
                        document.getElementById('greeting').textContent = 'Hello, ' + data.username + '!';
                    } else {
                        // Handle not logged in state, perhaps redirect to login page
                        // window.location.href = '/login.html';
                        console.log("youre not logged in");
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
        
    
</head>
<body>
    <?php 
    include("inc_db.php");
    include("process_import.php");
    ?>
    <h1>Welcome to my home</h1>
    <form action="process_import.php" method="post" enctype="multipart/form-data">
    Select CSV File to Upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Submit" name="submit">
    </form>

    <p id="greeting">Loading...</p>

</body>
</html>
