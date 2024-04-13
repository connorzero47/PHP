<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Your Name" />
<title>Task 2</title>
</head>
<body>
<h1>Web Programming - Lab06 Task 2</h1>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    
    // Read existing entries from the guestbook.txt file into an array
    $guestbook = file("/home/students/accounts/s104348322/cos30020/www/data/lab06/guestbook.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    if(preg_match("/[^A-Za-z]/", $name)){
		echo "<p>Invalid name</p>";
	} else {
		// Check if the name or email already exists in the guestbook
		$duplicate = false;
		foreach ($guestbook as $entry) {
        list($entryName, $entryEmail) = explode(",", $entry);
			if ($entryName == $name || $entryEmail == $email) {
				$duplicate = true;
				break;
			}
		}
		
		if (!$duplicate) {
			// Append the new entry to the guestbook
			$entry = "$name,$email\n";
			file_put_contents("/home/students/accounts/s104348322/cos30020/www/data/lab06/guestbook.txt", $entry, FILE_APPEND | LOCK_EX);
			echo "<p>Thank you for signing the guestbook!</p>";
		} else {
			echo "<p>Sorry, this name or email already exists in the guestbook.</p>";
		}
	}
	
    
} else {
    header("Location: guestbookform.php");
}
?>
<p><a href="guestbookform.php">Back to Guestbook Form</a></p>

</body>
</html>

