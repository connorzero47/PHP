<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="John Umali" />
<title>Task 2</title>
</head>
<body>
<h1>Web Programming Form – Lab06 Task 2</h1>
<h1>Guestbook Form</h1>
<form action="guestbooksave.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
	<br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
	<br>
    <input type="submit" value="Submit">
</form>
<p><a href="guestbookshow.php">View Guest Book</a></p>
</body>
</html>