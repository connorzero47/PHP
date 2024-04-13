<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Your Name" />
<title>Task 3</title>
</head>
<body>
<h1>Web Programming - Lab 4 Task 3</h1>

<?php 
if (isset ($_POST["num"]) && is_numeric($_POST["num"]) != 1){ 
	$std = $_POST["num"];
	$pld = preg_replace('/[^a-zA-Z]/', '', $std);
	$rev = strrev($pld);
	
	if (strcmp($pld , $rev) == 0){
		echo $std . " is a Standard Palindrome.";
	} else {
		echo $std . " is not a Standard Palindrome.";
	}
	
} else {
	echo "<p> Please use only letters. </p>";
}

?>
</body>
</html>