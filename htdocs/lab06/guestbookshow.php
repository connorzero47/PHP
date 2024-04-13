<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="Guestbook">
<title>Task 2</title>
</head>
<body>
<h1>Web Programming - Lab06 Task 2</h1>
<h1>Guestbook</h1>
<?php
$guestbook = file("/home/students/accounts/s104348322/cos30020/www/data/lab06/guestbook.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (empty($guestbook)) {
    echo "<p>No entries in the guestbook yet.</p>";
} else {
    // Sort the guestbook entries by name
    usort($guestbook, function($a, $b) {
        list($nameA, $emailA) = explode(",", $a);
        list($nameB, $emailB) = explode(",", $b);
        return strcasecmp($nameA, $nameB);
    });

    // Display the guestbook entries in a table
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Email</th></tr>";
    foreach ($guestbook as $entry) {
        list($name, $email) = explode(",", $entry);
        echo "<tr><td>$name</td><td>$email</td></tr>";
    }
    echo "</table>";
}
?>
<p><a href="guestbookform.php">Back to Guestbook Form</a></p>
</body>
</html>