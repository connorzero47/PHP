<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Add New VIP Member" />
    <meta name="keywords" content="VIP, Member, PHP, MySQL" />
    <meta name="author" content="Your Name" />
    <title>Add New VIP Member</title>
</head>
<body>
    <h1>Add New VIP Member</h1>
    <form method="post" action="member_add.php">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required><br>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br>

        <input type="submit" value="Add Member">
    </form>
</body>
</html>
