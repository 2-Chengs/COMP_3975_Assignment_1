<?php 
include("inc_header.php");
?>
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
<body>
    <?php 
    include("inc_db.php");
    include("process_import.php");
    ?>
    
    <h1>Welcome to my home</h1>
    <a class='btn btn-small btn-primary' href='transactions.php'>Transaction List</a>
    <a class='btn btn-small btn-primary' href='buckets.php'>Buckets List</a>
    <a class='btn btn-small btn-primary' href='reports.php'>Reports</a>

    <form action="process_import.php" method="post" enctype="multipart/form-data">
    Select CSV File to Upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Submit" name="submit">
    </form>

    <p id="greeting">Loading...</p>

</body>
</html>
