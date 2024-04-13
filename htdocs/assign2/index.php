<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Friend System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		Assignment Home Page
	</header>
	<br>
    <p>Name: John Rafael Umali</p>
    <p>Email: 104348322@student.swin.edu.au</p>
    <p>Student ID: 104348322</p> <br>
    <p>I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student’s work or from any other source.</p><br>

    <?php
   
    $servername = "feenix-mariadb.swin.edu.au";
    $username = "s104348322";
    $password = "110502";
    $database = "s104348322_db";

    $conn = new mysqli($servername, $username, $password, $database);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	
	/*
    // Create the 'friends' table
	$sqlCreateFriendsTable = "CREATE TABLE IF NOT EXISTS friends (
		friend_id INT AUTO_INCREMENT PRIMARY KEY,
		friend_email VARCHAR(50) NOT NULL,
		password VARCHAR(20) NOT NULL,
		profile_name VARCHAR(30) NOT NULL,
		date_started DATE NOT NULL,
		num_of_friends INT UNSIGNED
	)";

	if ($conn->query($sqlCreateFriendsTable) === TRUE) {
		echo "<p>'friends' table created successfully.</p>";
	} else {
		echo "<p>Error creating 'friends' table: " . $conn->error . "</p>";
	}

	// Create the 'myfriends' table
	$sqlCreateMyFriendsTable = "CREATE TABLE IF NOT EXISTS myfriends (
		friend_id1 INT NOT NULL,
		friend_id2 INT NOT NULL,
		CONSTRAINT fk_friend1 FOREIGN KEY (friend_id1) REFERENCES friends(friend_id),
		CONSTRAINT fk_friend2 FOREIGN KEY (friend_id2) REFERENCES friends(friend_id),
		UNIQUE(friend_id1, friend_id2)
	)";

	if ($conn->query($sqlCreateMyFriendsTable) === TRUE) {
		echo "<p>'myfriends' table created successfully.</p>";
	} else {
		echo "<p>Error creating 'myfriends' table: " . $conn->error . "</p>";
	}

	// Insert sample data into the 'friends' table
	$sqlInsertFriendsData = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)
	VALUES
	('user1@example.com', 'password1', 'User One', '2023-10-01', 5),
	('user2@example.com', 'password2', 'User Two', '2023-10-02', 10),
	('user3@example.com', 'password3', 'User Three', '2023-10-03', 7),
	('user4@example.com', 'password4', 'User Four', '2023-10-04', 2),
	('user5@example.com', 'password5', 'User Five', '2023-10-05', 8),
	('user6@example.com', 'password6', 'User Six', '2023-10-06', 4),
	('user7@example.com', 'password7', 'User Seven', '2023-10-07', 9),
	('user8@example.com', 'password8', 'User Eight', '2023-10-08', 6),
	('user9@example.com', 'password9', 'User Nine', '2023-10-09', 3),
	('user10@example.com', 'password10', 'User Ten', '2023-10-10', 1)
	";

	if ($conn->query($sqlInsertFriendsData) === TRUE) {
		echo "<p>Sample records inserted into 'friends' table.</p>";
	} else {
		echo "<p>Error inserting sample records into 'friends' table: " . $conn->error . "</p>";
	}

	// Insert sample data into the 'myfriends' table
	$sqlInsertMyFriendsData = "INSERT INTO myfriends (friend_id1, friend_id2)
	VALUES
	(1, 2),
	(1, 3),
	(2, 3),
	(4, 5),
	(4, 6),
	(5, 6),
	(7, 8),
	(7, 9),
	(8, 9),
	(10, 1),
	(10, 2),
	(3, 4),
	(6, 7),
	(9, 10),
	(5, 10),
	(2, 5),
	(8, 1),
	(7, 3),
	(4, 9),
	(6, 10)
	";

	if ($conn->query($sqlInsertMyFriendsData) === TRUE) {
		echo "<p>Sample records inserted into 'myfriends' table.</p>";
	} else {
		echo "<p>Error inserting sample records into 'myfriends' table: " . $conn->error . "</p>";
	}
	
	*/
	

    $conn->close();
    ?>

    <p><center>
        <a href="signup.php">Sign up</a> |
        <a href="login.php">Log in</a> |
        <a href="about.php">About</a>
		
    </p></center>
		<br>
	<footer>
        &copy; My Friend System 2023
    </footer>
</body>
</html>
