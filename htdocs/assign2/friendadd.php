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


if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}


$userID = $_SESSION["user_id"];

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

// Define the number of items to display per page
$itemsPerPage = 5;

// Get the current page number from the URL
if (isset($_GET["page"])) {
    $currentPage = $_GET["page"];
} else {
    $currentPage = 1;
}

// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $itemsPerPage;

// Query to retrieve the user's friends
$sqlFriends = "SELECT f.friend_id
               FROM friends AS f
               INNER JOIN myfriends AS mf ON f.friend_id = mf.friend_id2
               WHERE mf.friend_id1 = ?";

if ($stmt = $conn->prepare($sqlFriends)) {
    $stmt->bind_param("i", $userID);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $friendIDs = [];
        while ($row = $result->fetch_assoc()) {
            $friendIDs[] = $row['friend_id'];
        }
    }
    $stmt->close();
}

// Query to retrieve all registered users except friends of the current user
if (!empty($friendIDs)) {
    $friendIDsStr = implode(',', $friendIDs);
    $sqlRegisteredUsers = "SELECT friend_id, profile_name
                           FROM friends
                           WHERE friend_id NOT IN ($friendIDsStr) AND friend_id != ?
                           LIMIT ?, ?";
} else {
    $sqlRegisteredUsers = "SELECT friend_id, profile_name
                           FROM friends
                           WHERE friend_id != ?
                           LIMIT ?, ?";
}

if ($stmt = $conn->prepare($sqlRegisteredUsers)) {
    $stmt->bind_param("iii", $userID, $offset, $itemsPerPage);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
    }
    $stmt->close();
}

// Function to add a friend
function addFriend($conn, $userID, $friendID) {
    $sqlAddFriend = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sqlAddFriend)) {
        $stmt->bind_param("ii", $userID, $friendID);
        if ($stmt->execute()) {
            return true;
        }
        $stmt->close();
    }
    return false;
}

// Function to get the mutual friend count for a user
function getMutualFriendCount($conn, $userID, $friendID) {
    $sqlMutualFriendCount = "SELECT COUNT(*) AS count
                             FROM myfriends AS mf1
                             INNER JOIN myfriends AS mf2 ON mf1.friend_id2 = mf2.friend_id2
                             WHERE mf1.friend_id1 = ? AND mf2.friend_id1 = ?";
    if ($stmt = $conn->prepare($sqlMutualFriendCount)) {
        $stmt->bind_param("ii", $userID, $friendID);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                return $row["count"];
            }
        }
        $stmt->close();
    }
    return 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addfriend"])) {
    $friendID = $_POST["addfriend"];
    if (addFriend($conn, $userID, $friendID)) {
        // Successfully added as a friend, refresh the page
        header("location: friendadd.php?page=$currentPage");
    } else {
        echo "Error adding friend.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Friend List - My Friend System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        Add Friends
    </header>
    <div class="container">
        <h2>Welcome, <?php echo $userProfileName; ?>!</h2>
        <h3>People You Can Add as Friends</h3>
        <ul>
            <?php
            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $friendID = $row['friend_id'];
                    $friendProfileName = $row['profile_name'];
                    $mutualFriendCount = getMutualFriendCount($conn, $userID, $friendID);
                    echo "<li>";
                    echo "<span><strong>$friendProfileName</strong></span>";
                    echo "<span> (Mutual Friends: $mutualFriendCount)</span>";
                    echo "<form method='post' action='friendadd.php?page=$currentPage'>";
                    echo "<input type='hidden' name='addfriend' value='$friendID'>";
                    echo "<input type='submit' value='Add Friend'>";
                    echo "</form>";
                    echo "</li>";
                }
            } else {
                echo "<li>No users available to add as friends.</li>";
            }
            ?>
        </ul>
        <?php
        // Pagination links
        $prevPage = $currentPage - 1;
        $nextPage = $currentPage + 1;

        if ($currentPage > 1) {
            echo "<a href='friendadd.php?page=$prevPage'>Previous</a>";
        }

        if ($result->num_rows == $itemsPerPage) {
            echo "<a href='friendadd.php?page=$nextPage'>Next</a>";
        }
        ?>
		<center>
        <p><a href="friendlist.php">Friend List</a> | <a href="logout.php">Log Out</a></p>
		</center>
    </div>
    <footer>
        &copy; My Friend System 2023
    </footer>
</body>
</html>

