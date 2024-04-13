<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="description" content="Search Job Vacancy Page">
    <title>Search Job Vacancy</title>
</head>
<body>


<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $positionId = strtoupper(trim($_POST["position_id"]));
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $closingDate = trim($_POST["closing_date"]);
    $positionType = $_POST["position_type"];
    $contractType = $_POST["contract_type"];
    $acceptApplication = implode(", ", $_POST["accept_application"]);
    $location = $_POST["location"];
	
	$date = $closingDate ;
	if (preg_match('/^\d{2}\/\d{2}\/\d{2}$/', $date)) {
        list($day, $month, $year) = explode('/', $date);

      
        if (checkdate($month, $day, $year)) {
          
            $currentDate = date('d/m/y');

            
            if ($date < $currentDate){
				echo "<p>Please input a valid Closing Date</p>";
				echo "<p><a href='index.php'>Return to Home Page</a></p>";
				echo "<p><a href='postjobform.php'>Return to Post Job Page</a></p>";
				exit();
			}
			
        } else {
			echo "<p>Invalid date format. Please use dd/mm/yy format.</p>";
			echo "<p><a href='index.php'>Return to Home Page</a></p>";
			echo "<p><a href='postjobform.php'>Return to Post Job Page</a></p>";
			exit();
		}
    } else {
		echo "<p>Invalid date format. Please use dd/mm/yy format.</p>";
        echo "<p><a href='index.php'>Return to Home Page</a></p>";
        echo "<p><a href='postjobform.php'>Return to Post Job Page</a></p>";
        exit();
	}
	

	$jobFilePath = "/home/students/accounts/s104348322/cos30020/www/data/jobposts/jobs.txt"; //filepath
	$existingJobs = file($jobFilePath, FILE_IGNORE_NEW_LINES);
	foreach ($existingJobs as $existingJob) {
		$fields = explode("\t", $existingJob);
		$existingPositionId = $fields[0];
		if ($existingPositionId == $positionId) {
			echo "<p>Position ID already exists. Please choose a different one.</p>";
			echo "<p><a href='index.php'>Return to Home Page</a></p>";
			echo "<p><a href='postjobform.php'>Return to Post Job Page</a></p>";
			exit();
		}
	}

    $jobDirectory = dirname($jobFilePath);
    if (!file_exists($jobDirectory)) {
        mkdir($jobDirectory, 0777, true);
    }

    $jobRecord = "$positionId\t$title\t$description\t$closingDate\t$positionType\t$contractType\t$acceptApplication\t$location\n";

    file_put_contents($jobFilePath, $jobRecord, FILE_APPEND | LOCK_EX);

    echo "<p>Job vacancy has been successfully posted!</p>";
    echo "<p><a href='index.php'>Return to Home Page</a></p>";
} else {
    header("Location: index.php");
}

?>


</body>
</html>