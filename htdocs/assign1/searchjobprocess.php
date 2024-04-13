<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="description" content="Filtered Job Vacancy Search Results">
    <title>Job Vacancy Search Results</title>
</head>
<body>
    <h1>Job Vacancy Search Results</h1>
    
    <?php
    $jobFilePath = "/home/students/accounts/s104348322/cos30020/www/data/jobposts/jobs.txt"; //filepath
    if (!file_exists($jobFilePath)) {
        echo "<p>Job vacancy data file not found. Please try again later.</p>";
        echo "<p><a href='index.php'>Return to Home Page</a></p>";
        echo "<p><a href='searchjobform.php'>Return to Search Job Vacancy Page</a></p>";
        exit();
    }

    $jobRecords = file($jobFilePath, FILE_IGNORE_NEW_LINES);

    $jobTitleFilter = isset($_GET['job_title']) ? trim($_GET['job_title']) : '';
    $positionTypeFilter = isset($_GET['position_type']) ? $_GET['position_type'] : '';
    $contractTypeFilter = isset($_GET['contract_type']) ? $_GET['contract_type'] : '';
    $acceptApplicationFilter = isset($_GET['accept_application']) ? $_GET['accept_application'] : [];
    $locationFilter = isset($_GET['location']) ? $_GET['location'] : '';
	
	//$currentDate = date('d/m/y');
    foreach ($jobRecords as $jobRecord) {
        $fields = explode("\t", $jobRecord);

        if (count($fields) == 8) {
            $positionId = $fields[0];
            $title = $fields[1];
            $description = $fields[2];
            $closingDate = $fields[3];
            $positionType = $fields[4];
			$contractType = $fields[5];
            $acceptApplications = explode(', ', $fields[6]);
            $location = $fields[7];

			$closingDateTime = DateTime::createFromFormat('d/m/y', $closingDate);
            $currentDateTime = new DateTime();
			
			if ($closingDateTime >= $currentDateTime) {
				
				$matchesFilters =
					(empty($jobTitleFilter) || stripos($title, $jobTitleFilter) !== false) &&
                    (empty($positionTypeFilter) || $positionType === $positionTypeFilter) &&
                    (empty($contractTypeFilter) || stripos($contractType, $contractTypeFilter) !== false) &&
                    (empty($acceptApplicationFilter) || count(array_intersect($acceptApplications, $acceptApplicationFilter)) > 0) &&
                    (empty($locationFilter) || $location === $locationFilter);
			
				if ($matchesFilters) {
					echo "<p><strong>Job Title:</strong> $title</p>";
					echo "<p><strong>Description:</strong> $description</p>";
					echo "<p><strong>Closing Date:</strong> $closingDate</p>";
					echo "<p><strong>Position Type:</strong> $positionType</p>";
					echo "<p><strong>Contract Type:</strong> $contractType</p>";
					echo "<p><strong>Accept Application by (Post, Email):</strong> " . implode(', ', $acceptApplications) . "</p>";
					echo "<p><strong>Location:</strong> $location</p>";
					echo "<hr>";
				}
				
			}
        }
    }

    echo "<p><a href='index.php'>Return to Home Page</a></p>";
    echo "<p><a href='searchjobform.php'>Return to Search Job Vacancy Page</a></p>";
    ?>
</body>
</html>












