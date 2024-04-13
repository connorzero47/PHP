<?php

$servername = "feenix-mariadb.swin.edu.au";
$username = "s104348322";
$password = "110502";
$database = "s104348322_db";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables and initialize with empty values
$email = $password = "";
$emailErr = $passwordErr = "";
$loginError = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    // If both email and password are provided, attempt to log in
    if (empty($emailErr) && empty($passwordErr)) {
        // Prepare a SQL query to check if the user exists
        $sql = "SELECT * FROM friends WHERE friend_email = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = $email;

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $stored_password = $row["password"];

                    // Compare the provided password with the stored plain-text password
                    if ($password === $stored_password) {
                        session_start();

                        // Store data in session variables
                        $_SESSION["user_id"] = $row["friend_id"];
                        $_SESSION["user_email"] = $email;

                        // Redirect to the friendlist.php page
                        header("location: friendlist.php");
                    } else {
                        // Password is incorrect
                        $loginError = "Invalid password";
                    }
                } else {
                    // User with the provided email does not exist
                    $loginError = "No account found with that email";
                }
            } else {
                echo "Error executing the SQL query: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - My Friend System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		Login
	</header>
	<br>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
        <p><?php echo $loginError; ?></p>
    </form>
    <br>
	<p><a href="index.php">Back to Home</a></p>
	<br>
	<footer>
        &copy; My Friend System 2023
    </footer>
</body>
</html>

