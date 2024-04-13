<?php

$servername = "feenix-mariadb.swin.edu.au";
$username = "s104348322";
$password = "110502";
$database = "s104348322_db";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

// Get the user's ID from the session
$userID = $_SESSION["user_id"];

// Query to retrieve the user's profile name
$sqlProfileName = "SELECT profile_name FROM friends WHERE friend_id = ?";
if ($stmt = $conn->prepare($sqlProfileName)) {
    $stmt->bind_param("i", $userID);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $userProfileName = $row["profile_name"];
    }
    $stmt->close();
}

// Query to retrieve the user's friends
$sqlFriends = "SELECT f.friend_id, f.profile_name
               FROM friends AS f
               INNER JOIN myfriends AS mf ON f.friend_id = mf.friend_id2
               WHERE mf.friend_id1 = ?";

if ($stmt = $conn->prepare($sqlFriends)) {
    $stmt->bind_param("i", $userID);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
    }
    $stmt->close();
}

// Function to unfriend a user
function unfriendUser($conn, $userID, $friendID) {
    $sqlUnfriend = "DELETE FROM myfriends WHERE friend_id1 = ? AND friend_id2 = ?";
    if ($stmt = $conn->prepare($sqlUnfriend)) {
        $stmt->bind_param("ii", $userID, $friendID);
        if ($stmt->execute()) {
            return true;
        }
        $stmt->close();
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["unfriend"])) {
    $friendID = $_POST["unfriend"];
    if (unfriendUser($conn, $userID, $friendID)) {
        // Successfully unfriended, refresh the page
        header("location: friendlist.php");
    } else {
        echo "Error unfriending user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend List - My Friend System</title>
</head>
<body>
    <header>
        Friend List
    </header>
    <div class="container">
        <h2>Welcome, <?php echo $userProfileName; ?>!</h2>
        <h3>Your Friend List</h3>
        <table>
    <thead>
        <tr>
            <th>Profile Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['profile_name']}</td>";
                echo "<td>
                        <form method='post' action='friendlist.php'>
                            <input type='hidden' name='unfriend' value='{$row['friend_id']}'>
                            <button type='submit'>Unfriend</button>
                        </form>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>You don't have any friends yet.</td></tr>";
        }
        ?>
    </tbody>
</table>
		<center>
        <p><a href="friendadd.php">Add Friends</a> | <a href="logout.php">Log Out</a></p>
		</center>
    </div>
    <footer>
        &copy; My Friend System 2023
    </footer>
</body>
</html>




