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
<h1>Web Programming - Lab 4 Task 2</h1>

<?php 
if (isset ($_POST["num"]) && is_numeric($_POST["num"]) != 1){ 
	$pld = $_POST["num"]; 
	$rev = strrev($pld);
	
	if (strcmp($pld , $rev) == 0){
		echo $pld . " is a Perfect Palindrome.";
	} else {
		echo $pld . " is not a Perfect Palindrome.";
	}
	
} else {
	echo "<p> Please use only letters. </p>";
}

?>
</body>
</html>