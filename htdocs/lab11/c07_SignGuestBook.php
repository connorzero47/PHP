<!DOCTYPE html>
<html>
<head>
    <title>Guest Book</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
if (empty($_GET['first_name']) || empty($_GET['last_name'])) {
    die("<p>You must enter your first and last name! Click your browser's Back button to return to the Guest Book form.</p>");
}

$DBConnect = mysqli_connect("feenix-mariadb.swin.edu.au", "s104348322", "110502")
    or die("<p>Unable to connect to the database server.</p>"
    . "<p>Error code " . mysqli_connect_errno()
    . ": " . mysqli_connect_error() . "</p>");

$DBName = "s104348322_db";

if (!mysqli_select_db($DBConnect, $DBName)) {
    $SQLstring = "CREATE DATABASE $DBName";
    $QueryResult = mysqli_query($DBConnect, $SQLstring)
        or die("<p>Unable to execute the query.</p>"
        . "<p>Error code " . mysqli_errno($DBConnect)
        . ": " . mysqli_error($DBConnect) . "</p>");
    echo "<p>You are the first visitor!</p>";
    mysqli_select_db($DBConnect, $DBName);
}

$TableName = "visitors";

$SQLstring = "SELECT * FROM $TableName";
$QueryResult = mysqli_query($DBConnect, $SQLstring);

if (!$QueryResult) {
    $SQLstring = "CREATE TABLE $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, last_name VARCHAR(40), first_name VARCHAR(40))";
    $QueryResult = @mysqli_query($DBConnect, $SQLstring)
        or die("<p>Unable to create the table.</p>"
        . "<p>Error code " . mysqli_errno($DBConnect)
        . ": " . mysqli_error($DBConnect) . "</p>");
}

$LastName = addslashes($_GET['last_name']);
$FirstName = addslashes($_GET['first_name']);

$SQLstring = "INSERT INTO $TableName VALUES(NULL, '$LastName', '$FirstName')";
$QueryResult = mysqli_query($DBConnect, $SQLstring)
    or die("<p>Unable to execute the query.</p>"
    . "<p>Error code " . mysqli_errno($DBConnect)
    . ": " . mysqli_error($DBConnect) . "</p>");

echo "<h1>Thank you for signing our guest book!</h1>";
mysqli_close($DBConnect);
?>
</body>
</html>

