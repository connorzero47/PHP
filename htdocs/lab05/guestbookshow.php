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
Echo "<p> Guest List </p> " ;
$filename = "/home/students/accounts/s104348322/cos30020/www/data/lab05/guestbook.txt";
$handle = fopen($filename, "r");
while (!feof($handle)) { 
$data = fgets($handle); 
echo "<p>", $data, "</p>"; 
}
?>
</body>
</html>