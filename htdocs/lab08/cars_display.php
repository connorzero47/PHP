<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="John Umali" />
<title>Car Display</title>
</head>
<body>
<h1>Web Programming - Lab08</h1>
<?php
require_once ("settings.php");

$connection = mysqli_connect($host, $user, $pswd, $dbnm);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT car_id, make, model, price FROM cars";
$result = mysqli_query($connection, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

echo "<table border='1'>";
echo "<tr><th>Car ID</th><th>Make</th><th>Model</th><th>Price</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["car_id"] . "</td><td>" . $row["make"] . "</td><td>" . $row["model"] . "</td><td>" . $row["price"] . "</td></tr>";
}

echo "</table>";

mysqli_close($connection);

// complete your answer based on Lecture 8 slides 26 and 44


?>
</body>
</html>