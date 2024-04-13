<!DOCTYPE html>
<html>
<head>
    <title>Guest Book</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
$DBConnect = mysqli_connect("feenix-mariadb.swin.edu.au", "s104348322", "110502")
    or die("<p>Unable to connect to the database server.</p>"
    . "<p>Error code " . mysqli_connect_errno()
    . ": " . mysqli_connect_error() . "</p>");

$DBName = "s104348322_db";

if (!mysqli_select_db($DBConnect, $DBName)) {
    die("<p>There are no entries in the guest book!</p>");
}

$TableName = "visitors";
$SQLstring = "SELECT * FROM $TableName";
$QueryResult = mysqli_query($DBConnect, $SQLstring);

if (!$QueryResult) {
    die("<p>There are no entries in the guest book!</p>");
}

echo "<p>The following visitors have signed our guest book:</p>";
echo "<table width='100%' border='1'>";
echo "<tr><th>First Name</th><th>Last Name</th></tr>";

while ($Row = mysqli_fetch_assoc($QueryResult)) {
    echo "<tr><td>{$Row['first_name']}</td>";
    echo "<td>{$Row['last_name']}</td></tr>";
}

mysqli_free_result($QueryResult);
mysqli_close($DBConnect);
?>
</body>
</html>

