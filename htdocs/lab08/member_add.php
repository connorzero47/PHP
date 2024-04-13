<?php
require_once("settings.php");


$connection = mysqli_connect($host, $user, $pswd, $dbnm);


if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}



$sql = "CREATE DATABASE IF NOT EXISTS $dbnm";
if (mysqli_query($connection, $sql)) {
    echo "Database created successfully!<br>";
} else {
    echo "Error creating database: " . mysqli_error($connection);
}


//mysqli_select_db($connection, $dbnm);


$sql = "CREATE TABLE IF NOT EXISTS vipmembers (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(40),
    lname VARCHAR(40),
    gender VARCHAR(1),
    email VARCHAR(40),
    phone VARCHAR(20)
)";

if (mysqli_query($connection, $sql)) {
    echo "Table created successfully!<br>";
} else {
    echo "Error creating table: " . mysqli_error($connection);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO vipmembers (fname, lname, gender, email, phone) VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";
    if (mysqli_query($connection, $sql)) {
        echo "Member added successfully!<br>";
    } else {
        echo "Error adding member: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>
