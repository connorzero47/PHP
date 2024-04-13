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
$email = $profileName = $password = $confirmPassword = "";
$emailErr = $profileNameErr = $passwordErr = $confirmPasswordErr = "";
$registrationError = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
    }

    // Validate profile name
    if (empty($_POST["profileName"])) {
        $profileNameErr = "Profile name is required";
    } else {
        $profileName = $_POST["profileName"];
    }

    // Check if email and profile name already exist
    $checkQuery = "SELECT * FROM friends WHERE friend_email = ? OR profile_name = ?";
    if ($stmt = $conn->prepare($checkQuery)) {
        $stmt->bind_param("ss", $email, $profileName);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $registrationError = "Email or profile name already exists.";
            }
        }
        $stmt->close();
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    // Validate confirm password
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Please confirm the password";
    } else {
        $confirmPassword = $_POST["confirmPassword"];
        if ($password != $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    if (empty($emailErr) && empty($profileNameErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($registrationError)) {
        $sql = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)
                VALUES (?, ?, ?, CURDATE(), 0)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $param_email, $param_password, $param_profileName);
            $param_email = $email;
            $param_password = $password;
            $param_profileName = $profileName;

            if ($stmt->execute()) {          
                header("location: login.php");
            } else {
                $registrationError = "Registration failed. Please try again later.";
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
    <title>Sign Up - My Friend System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		Sign Up
	</header>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <div>
            <label for="profileName">Profile Name:</label>
            <input type="text" id="profileName" name="profileName" value="<?php echo $profileName; ?>">
            <span class="error"><?php echo $profileNameErr; ?></span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>
        <div>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword">
            <span class="error"><?php echo $confirmPasswordErr; ?></span>
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
        <p><?php echo $registrationError; ?></p>
    </form>
	<br>
    <p><a href="index.php">Back to Home</a></p>
	<br>
	<footer>
        &copy; My Friend System 2023
    </footer>
</body>
</html>


