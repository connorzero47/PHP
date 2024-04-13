<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="description" content="Post Job Page">
    <title>Post Job Form</title>
</head>
<body>
    <h1>Post a Job Vacancy </h1>
	<?php echo "Date Today: " . date('d/m/y'); ?>
    <form action="postjobprocess.php" method="post">
        <label for="position_id">Position ID (e.g., PID0001):</label>
        <input type="text" id="position_id" name="position_id" required pattern="^PID\d{4}$">
        <br>
		<br>
		
        <label for="title">Title (max 20 alphanumeric characters):</label>
        <input type="text" id="title" name="title" required maxlength="20" pattern="[A-Za-z0-9\s,\.!]+">
        <br>
		<br>
		
        <label for="description">Description (max 250 characters):</label>
        <textarea id="description" name="description" required maxlength="250"></textarea>
        <br>
		<br>

        <label for="closing_date">Closing Date (dd/mm/yy):</label>
        <input type="text" id="closing_date" name="closing_date" required pattern="^\d{2}/\d{2}/\d{2}$" value="<?php echo date('d/m/y'); ?>">
        <br>

        <label>Position:</label>
        <input type="radio" id="full_time" name="position_type" value="Full Time" required>
        <label for="full_time">Full Time</label>
        <input type="radio" id="part_time" name="position_type" value="Part Time" required>
        <label for="part_time">Part Time</label>
        <br>

        <label>Contract:</label>
        <input type="radio" id="on_going" name="contract_type" value="On-going" required>
        <label for="on_going">On-going</label>
        <input type="radio" id="fixed_term" name="contract_type" value="Fixed term" required>
        <label for="fixed_term">Fixed term</label>
        <br>

        <label>Accept Application by:</label>
        <input type="checkbox" id="accept_post" name="accept_application[]" value="Post">
        <label for="accept_post">Post</label>
        <input type="checkbox" id="accept_email" name="accept_application[]" value="Email" required>
        <label for="accept_email">Email</label>
        <br>

        <label for="location">Location:</label>
        <select id="location" name="location" required>
			<option value="Any">---</option>
            <option value="ACT">ACT</option>
            <option value="NSW">NSW</option>
            <option value="NT">NT</option>
            <option value="QLD">QLD</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="VIC">VIC</option>
            <option value="WA">WA</option>
        </select>
        <br>

        <input type="submit" value="Submit">
    </form>
    <p><a href="index.php">Return to Home Page</a></p>
</body>
</html>
