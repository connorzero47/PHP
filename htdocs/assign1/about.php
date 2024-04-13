<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="description" content="About Page">
    <title>About Page</title>
</head>
<body>
    <h1>About Page</h1>
    
    <h2>Answers to Questions:</h2>
    <ul>
        <li>What is the PHP version installed in Mercury?
            <?php
           
            $phpVersion = phpversion();
            echo "<strong>$phpVersion</strong>";
            ?>
        </li>
    
		<li> 
			What discussion points did you participate on in the unit’s discussion board for Assignment 1? <br>
			<img src="discussion1.jpg" alt="discussion board 1" width="400" height="200">
		</li>
	
		<li> 
		
			What tasks have you not attempted or not completed?
			<strong>All tasks have been created, tested, and executable in the mercury server.</strong>
		
		</li>
	
	</ul>
 

    <p><a href="index.php">Return to Home Page</a></p>
</body>
</html>
