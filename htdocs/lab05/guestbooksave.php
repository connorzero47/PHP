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
<h1>Web Programming - Lab 5 Task 2</h1>
<?php
$message = "Please enter a valid First Name and Last Name. <br><br> Use the 'Go Back' Button.";
if (($_POST["fname"]) && ($_POST["lname"])) { // check if both form data exists
	$first = ($_POST["fname"]);
	$last = ($_POST["lname"]) ;
	$pattern = "/\d+/";
	if (preg_match($pattern, $first) == 1 && preg_match($pattern, $last) == 1){
		echo '<p style="color: red;">'  . $message . '</p>';
	} else {
		$filename = "/home/students/accounts/s104348322/cos30020/www/data/lab05/guestbook.txt";
		$handle = fopen($filename, 'a'); 
		$data = "<br>" . $first . " " . $last ;
		fwrite($handle, $data); // write string to text file
		echo '<p style="color: green;"> Thank you for signing the Guest book </p>';
	}
} else {
	echo '<p style="color: red;">'  . $message . '</p>';
}
?>

<p> <a href="https://mercury.swin.edu.au/cos30020/s104348322/lab05/guestbookshow.php"> Show Guest Book </a></p>

</body>
</html>