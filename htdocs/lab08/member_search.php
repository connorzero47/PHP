<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Search VIP Members" />
    <meta name="keywords" content="VIP, Member, PHP, MySQL" />
    <meta name="author" content="Your Name" />
    <title>Search VIP Members</title>
</head>
<body>
    <h1>Search VIP Members</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="lname">Search by Last Name:</label>
        <input type="text" id="lname" name="lname" required>
        <input type="submit" value="Search">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		require_once("settings.php");
        $search_lname = $_POST["lname"];
        $connection = mysqli_connect($host, $user, $pswd, $dbnm);

      
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

     
        $sql = "SELECT member_id, fname, lname, email FROM vipmembers WHERE lname LIKE '%$search_lname%'";
        $result = mysqli_query($connection, $sql);

   
        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        }

     
        echo "<h2>Search Results</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["member_id"] . "</td><td>" . $row["fname"] . "</td><td>" . $row["lname"] . "</td><td>" . $row["email"] . "</td></tr>";
        }

        echo "</table>";

      
        mysqli_close($connection);
    }
    ?>
</body>
</html>
