<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="description" content="Search Job Vacancy Page">
    <title>Search Job Vacancy</title>
</head>
<body>
   <h1>Search Job Vacancy</h1>
   <form action="searchjobprocess.php" method="get">
        <label for="job_title">Job Title:</label>
        <input type="text" id="job_title" name="job_title">
        <br>
		<br>
		
        <label for="position_type">Position:</label>
        <select id="position_type" name="position_type">
            <option value="">Any</option>
            <option value="Full Time">Full Time</option>
            <option value="Part Time">Part Time</option>
        </select>
        <br>
		<br>

        <label for="contract_type">Contract:</label>
        <select id="contract_type" name="contract_type">
            <option value="">Any</option>
            <option value="On-going">On-going</option>
            <option value="Fixed term">Fixed term</option>
        </select>
        <br>
		<br>

        <label>Accept Application by:</label>
        <input type="checkbox" id="accept_post" name="accept_application[]" value="Post">
        <label for="accept_post">Post</label>
        <input type="checkbox" id="accept_email" name="accept_application[]" value="Email">
        <label for="accept_email">Email</label>
        <br>
		<br>

        <label for="location">Location:</label>
        <select id="location" name="location">
            <option value="">Any</option>
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

        <input type="submit" value="Search">
    </form>
    <p><a href="index.php">Return to Home Page</a></p>
</body>
</html>
