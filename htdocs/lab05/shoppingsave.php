<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Your Name" />
<title>Task 1</title>
</head>
<body>
<h1>Web Programming - Lab 5 Task 1</h1>
<?php // read the comments for hints on how to answer each item
if (($_POST["num"])) { // check if both form data exists
$item = preg_replace("/[^a-zA-Z]/", "" , ($_POST["num"])); // obtain the form item data
$qty = preg_replace("/[^0-9]/", "" , ($_POST["num"])); // obtain the form quantity data
$filename = "/home/students/accounts/s104348322/cos30020/www/data/shop.txt"; // assumes php file is inside lab05
$handle = fopen($filename, 'a'); // open the file in append mode
$data = "<br>" . $item . " , " . $qty ; // concatenate item and qty delimited by comma
fwrite($handle, $data); // write string to text file
//fclose($filename); // close the text file
echo "<p>Shopping List</p> "; // generate shopping list
$handle = fopen($filename, "r"); // open the file in read mode
while (!feof($handle)) { // loop while not end of file
$data = fgets($handle); // read a line from the text file
echo "<p>", $data, "</p>"; // generate HTML output of the data
}
//fclose($filename); // close the text file
} else { // no input
echo "<p>Please enter item and quantity in the input form.</p>";
}
?>
</body>
</html>
