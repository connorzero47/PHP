<?php
require_once("settings.php");


$connection = mysqli_connect($host, $user, $pswd, $dbnm);


if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT member_id, fname, lname FROM vipmembers";
$result = mysqli_query($connection, $sql);


if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}


echo "<h1>Member List</h1>";
echo "<table border='1'>";
echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["member_id"] . "</td><td>" . $row["fname"] . "</td><td>" . $row["lname"] . "</td></tr>";
}

echo "</table>";


mysqli_close($connection);
?>
