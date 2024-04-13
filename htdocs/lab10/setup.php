<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $host = "feenix-mariadb.swin.edu.au";
    $user = $_POST["user"];
    $pswd = $_POST["pswd"];
    $dbnm = $_POST["dbnm"];

    // Create a directory to store the connection details
    //mkdir("/home/students/accounts/s104348322/cos30020/www/data/lab10");

    // Store connection details in a file
    $connectionDetails = [
        'host' => $host,
        'user' => $user,
        'pswd' => $pswd,
        'dbnm' => $dbnm
    ];

    file_put_contents("/home/students/accounts/s104348322/cos30020/www/data/lab10/mykeys.inc.php", '<?php return ' . var_export($connectionDetails, true) . ';');

    // Connect to the database and create the hitcounter table
    $conn = mysqli_connect($host, $user, $pswd, $dbnm);

    if ($conn) {
        $createTableQuery = "CREATE TABLE `hitcounter` (
            `id` SMALLINT NOT NULL PRIMARY KEY,
            `hits` SMALLINT NOT NULL
        );";

        mysqli_query($conn, $createTableQuery);

        // Insert an initial value into the table
        $insertQuery = "INSERT INTO hitcounter VALUES (1,0);";
        mysqli_query($conn, $insertQuery);

        echo "Setup completed successfully.";
        mysqli_close($conn);
    } else {
        echo "Connection failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Hit Counter Setup</title>
</head>
<body>
    <h1>Hit Counter Setup</h1>
    <form method="post">
        User: <input type="text" name="user"><br><br>
        Password: <input type="password" name="pswd"><br><br>
        Database Name: <input type="text" name="dbnm"><br><br>
        <input type="submit" name="submit" value="Set Up"><br><br>
    </form>
	
<a href="countvisits.php">Hit Count Page</a>

</body>
</html>

